<?php

namespace App\Services;

use App\Interfaces\UsersRepositoryInterface;
use App\Interfaces\UsersTokensRepositoryInterface;
use App\Interfaces\DateProviderInterface;
use App\Interfaces\EmailProviderInterface;
use App\Exceptions\AppError;
use App\Configs\AuthConfig;
use App\Utils\Validation\ValidateEmailFormat;
use App\Utils\Validation\ValidatePasswordFormat;
use App\Utils\Validation\ValidatePasswordChangeCode;
use App\Mappers\UserMapper;
use App\Utils\GenerateHtmlForPasswordChange;
use Carbon\Carbon;

class AuthenticationServices
{
    private $usersRepository;
    private $usersTokensRepository;
    private $dateProvider;
    private $emailProvider;

    public function __construct(
        UsersRepositoryInterface $usersRepository,
        UsersTokensRepositoryInterface $usersTokensRepository,
        DateProviderInterface $dateProvider,
        EmailProviderInterface $emailProvider
    ) {
        $this->usersRepository = $usersRepository;
        $this->usersTokensRepository = $usersTokensRepository;
        $this->dateProvider = $dateProvider;
        $this->emailProvider = $emailProvider;
    }

    private function createResponse($user)
    {
        $tokens = $this->createTokens($user->id);
        $userDTO = UserMapper::toDTO($user);
        return [
            'user' => $userDTO,
            'token' => $tokens['token'],
            'refreshToken' => $tokens['refreshToken'],
        ];
    }

    private function createPasswordExchangeCode()
    {
        $codeLength = 6;
        $code = "";

        for ($i = 0; $i < $codeLength; $i++) {
            $digit = rand(0, 9);
            $code .= strval($digit);
        }

        return $code;
    }

    private function createTokens($subject)
    {
        $token = jwt::encode(
            ['sub' => $subject],
            AuthConfig::SECRET_TOKEN,
            'HS256'
        );

        $refreshToken = jwt::encode(
            ['sub' => $subject],
            AuthConfig::SECRET_REFRESH_TOKEN,
            'HS256'
        );

        $expiresInRefreshTokenNumber = (int) preg_replace('/\D/', '', AuthConfig::EXPIRES_IN_REFRESH_TOKEN);
        $expiresDate = $this->dateProvider->addDays($expiresInRefreshTokenNumber);

        $this->usersTokensRepository->create([
            'refresh_token' => $refreshToken,
            'expires_date' => $expiresDate,
            'user_id' => $subject,
        ]);

        return [
            'token' => $token,
            'refreshToken' => $refreshToken,
        ];
    }

    public function validatePasswordChangeCode($email, $code)
    {
        ValidateEmailFormat::validate($email);
        ValidatePasswordChangeCode::validate($code);

        $userWithEmail = $this->usersRepository->findOneByEmail($email);

        if (!$userWithEmail) {
            throw new AppError("User does not exist", 404);
        }

        $userToken = $this->usersTokensRepository->findOneByUserIdAndRefreshTokenWithUser(
            $userWithEmail->id,
            $code
        );

        if (!$userToken) {
            throw new AppError("Incorrect password change code", 400);
        }

        $this->usersTokensRepository->delete($userToken->id);

        if (!$this->dateProvider->isValidDate($userToken->expires_date)) {
            throw new AppError("Expired password change code", 400);
        }

        return $this->createResponse($userToken->user);
    }

    public function validatePasswordChange($email)
    {
        ValidateEmailFormat::validate($email);

        $userWithEmail = $this->usersRepository->findOneByEmail($email);

        if (!$userWithEmail) {
            throw new AppError("User does not exist", 404);
        }

        $expiresDate = $this->dateProvider->addMinutes(3);
        $passwordExchangeCode = $this->createPasswordExchangeCode();

        $this->usersTokensRepository->create([
            'refresh_token' => $passwordExchangeCode,
            'expires_date' => $expiresDate,
            'user_id' => $userWithEmail->id,
        ]);

        $html = GenerateHtmlForPasswordChange::generate($passwordExchangeCode);

        $this->emailProvider->sendEmail($email, "Recuperação de senha", $html);
    }

    public function authenticateUser($authenticationUserDTO)
    {
        ValidateEmailFormat::validate($authenticationUserDTO['email']);
        ValidatePasswordFormat::validate($authenticationUserDTO['password']);

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

    public function refreshToken($refreshToken)
    {
        try {
            $decoded = jwt::decode($refreshToken, AuthConfig::SECRET_REFRESH_TOKEN, ['HS256']);
            $sub = $decoded->sub;
        } catch (\Exception $e) {
            throw new AppError("Invalid refresh token", 400);
        }

        if (!is_string($sub)) {
            throw new AppError("Invalid subject", 400);
        }

        $userToken = $this->usersTokensRepository->findOneByUserIdAndRefreshTokenWithUser(
            $sub,
            $refreshToken
        );

        if (!$userToken) {
            throw new AppError("Refresh token does not exist", 400);
        }

        $this->usersTokensRepository->delete($userToken->id);

        return $this->createResponse($userToken->user);
    }
}

?>
