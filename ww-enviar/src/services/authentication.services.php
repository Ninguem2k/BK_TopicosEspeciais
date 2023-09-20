<?php
use Firebase\JWT\JWT;

class AuthenticationServices {
    private $usersRepository;
    private $usersTokensRepository;
    private $dateProvider;
    private $emailProvider;

    public function __construct($usersRepository, $usersTokensRepository, $dateProvider, $emailProvider) {
        $this->usersRepository = $usersRepository;
        $this->usersTokensRepository = $usersTokensRepository;
        $this->dateProvider = $dateProvider;
        $this->emailProvider = $emailProvider;
    }

    private function createResponse($user) {
        $tokens = $this->createTokens($user->id);
        $userDTO = UserMapper::toDTO($user);
        return [
            'user' => $userDTO,
            'token' => $tokens['token'],
            'refreshToken' => $tokens['refreshToken']
        ];
    }

    private function createPasswordExchangeCode() {
        $codeLength = 6;
        $code = "";

        for ($i = 0; $i < $codeLength; $i++) {
            $digit = rand(0, 9);
            $code .= $digit;
        }

        return $code;
    }

    private function createTokens($subject) {
        $token = JWT::encode([], authConfig['secret_token'], [
            'subject' => $subject,
            'expiresIn' => authConfig['expires_in_token']
        ]);

        $refreshToken = JWT::encode([], authConfig['secret_refresh_token'], [
            'subject' => $subject,
            'expiresIn' => authConfig['expires_in_refresh_token']
        ]);

        $expiresInRefreshTokenNumber = (int)preg_replace('/\D/', '', authConfig['expires_in_refresh_token']);
        $expiresDate = date('Y-m-d H:i:s', strtotime('+' . $expiresInRefreshTokenNumber . ' days'));

        // Criar entidade users_tokens
        $this->usersTokensRepository->create([
            'refresh_token' => $refreshToken,
            'expires_date' => $expiresDate,
            'user_id' => $subject
        ]);

        return [
            'token' => $token,
            'refreshToken' => $refreshToken
        ];
    }

    public function validatePasswordChangeCode($email, $code) {
        validateEmailFormat($email);
        validatePasswordChangeCode($code);

        $userWithEmail = $this->usersRepository->findOneByEmail($email);

        if (!$userWithEmail) {
            throw new AppError("User does not exist", 404);
        }

        $userToken = $this->usersTokensRepository->findOneByUserIdAndRefreshTokenWithUser($userWithEmail->id, $code);

        if (!$userToken) {
            throw new AppError("Incorrect password change code", 400);
        }

        $this->usersTokensRepository->delete($userToken->id);

        if (!$this->dateProvider->isValidDate($userToken->expires_date)) {
            throw new AppError("Expired password change code", 400);
        }

        return $this->createResponse($userToken->user);
    }

    public function validatePasswordChange($email) {
        validateEmailFormat($email);

        $userWithEmail = $this->usersRepository->findOneByEmail($email);

        if (!$userWithEmail) {
            throw new AppError("User does not exist", 404);
        }

        $expiresDate = $this->dateProvider->addMinutes(3);
        $passwordExchangeCode = $this->createPasswordExchangeCode();

        $this->usersTokensRepository->create([
            'refresh_token' => $passwordExchangeCode,
            'expires_date' => $expiresDate,
            'user_id' => $userWithEmail->id
        ]);

        $html = generateHtmlForPasswordChange($passwordExchangeCode);

        $this->emailProvider->sendEmail($email, "Recuperação de senha", $html);
    }

    public function authenticateUser($authenticationUserDTO) {
        validateEmailFormat($authenticationUserDTO['email']);
        validatePasswordFormat($authenticationUserDTO['password']);

        $userWithEmail = $this->usersRepository->findOneByEmail($authenticationUserDTO['email']);
        if (!$userWithEmail) {
            throw new AppError("Email or Password incorrect!", 400);
        }

        $passwordsMatch = password_verify($authenticationUserDTO['password'], $userWithEmail->password);
        if (!$passwordsMatch) {
            throw new AppError("Email or Password incorrect!", 400);
        }

        return $this->createResponse($userWithEmail);
    }

    public function refreshToken($refreshToken) {
        try {
            $decoded = JWT::decode($refreshToken, authConfig['secret_refresh_token'], ['HS256']);
            $sub = $decoded->sub;
        } catch (Exception $e) {
            throw new AppError("Invalid refresh token", 400);
        }

        if (!is_string($sub)) {
            throw new AppError("Invalid subject", 400);
        }

        $userToken = $this->usersTokensRepository->findOneByUserIdAndRefreshTokenWithUser($sub, $refreshToken);

        if (!$userToken) {
            throw new AppError("Refresh token does not exist", 400);
        }

        $this->usersTokensRepository->delete($userToken->id);

        return $this->createResponse($userToken->user);
    }
}

?>
