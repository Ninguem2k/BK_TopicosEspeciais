<?php
// Importando as classes correspondentes
require_once 'express_router.php';
require_once '../controllers/authentication_controllers.php';

// Criando uma instância da rota
$authenticationRoutes = new ExpressRouter();
$usersControllers = new AuthenticationControllers();

// Definindo as rotas e associando aos métodos correspondentes
$authenticationRoutes->post("/sessions", [$usersControllers, "createSession"]);
$authenticationRoutes->post("/sessions_with_code", [$usersControllers, "createSessionWithCode"]);
$authenticationRoutes->post("/refresh_token", [$usersControllers, "refreshToken"]);
$authenticationRoutes->post("/recover_password", [$usersControllers, "recoverPassword"]);

// Exportando a rota
return $authenticationRoutes;
?>
