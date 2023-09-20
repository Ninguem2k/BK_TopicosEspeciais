<?php
require_once "path/to/your/UsersRepository.php";
require_once "path/to/your/UsersTokensRepository.php";
require_once "path/to/your/AuthenticationServices.php";
require_once "path/to/your/IAuthenticationUserDTO.php";
require_once "path/to/your/DateProvider.php";
require_once "path/to/your/EmailProvider.php";
require_once "path/to/your/email.config.php";

$usersRepository = new UsersRepository();
$usersTokensRepository = new UsersTokensRepository();
$dateProvider = new DateProvider();
$emailProvider = new EmailProvider(
    $emailConfig['email'] ?? "",
    $emailConfig['password'] ?? ""
);
$authenticationServices = new AuthenticationServices(
    $usersRepository,
    $usersTokensRepository,
    $dateProvider,
    $emailProvider
);

class AuthenticationControllers {
    public function createSession($req, $res) {
        $authenticationUserDTO = $req->getBody();
        $token = $authenticationServices->authenticateUser($authenticationUserDTO);
        return $res->json($token);
    }

    public function createSessionWithCode($req, $res) {
        $requestData = $req->getBody();
        $email = $requestData['email'];
        $password = $requestData['password'];
        $token = $authenticationServices->validatePasswordChangeCode($email, $password);
        return $res->json($token);
    }

    public function recoverPassword($req, $res) {
        $requestData = $req->getBody();
        $email = $requestData['email'];
        $authenticationServices->validatePasswordChange($email);
        return $res->status(204)->send();
    }

    public function refreshToken($req, $res) {
        $requestData = $req->getBody();
        $refreshToken = $requestData['refreshToken'];
        $token = $authenticationServices->refreshToken($refreshToken);
        return $res->json($token);
    }
}
?>
