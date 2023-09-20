<?php
// Importando classes e rotas correspondentes
require_once 'express_router.php';
require_once 'categories_routes.php';
require_once 'users_routes.php';
require_once 'services_routes.php';
require_once 'authentication_routes.php';

// Criando uma instância do roteador
$router = new ExpressRouter();

// Definindo e associando as rotas
$router->use("/categories", (new CategoriesRoutes())->getRoutes());
$router->use("/users", (new UsersRoutes())->getRoutes());
$router->use("/services", (new ServicesRoutes())->getRoutes());
$router->use("/", (new AuthenticationRoutes())->getRoutes());

// Exportando o roteador
return $router;
?>
