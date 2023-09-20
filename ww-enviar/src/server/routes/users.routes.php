<?php
// Importando classes e configurando o upload
require_once 'express_router.php';
require_once 'multer.php'; // Simulando o uso do multer
require_once '../controllers/users_controllers.php';
require_once '../middlewares/ensure_authentication.php';
require_once '../../configs/upload_config.php';

// Criando instâncias
$usersRoutes = new ExpressRouter();
$usersControllers = new UsersControllers();

$imageUpload = new Multer($multerConfig);

// Definindo rotas
$usersRoutes->get("/:id", [$usersControllers, "findOneByIdWithServicesAndServicesImages"]);
$usersRoutes->post("/", [$usersControllers, "create"]);

// Utilizando middleware para autenticação
$usersRoutes->use([$ensureAuthentication, "middlewareFunction"]);

$usersRoutes->put("/avatar", [$imageUpload, "uploadSingleImage"], [$usersControllers, "createAvatar"]);
$usersRoutes->delete("/avatar", [$usersControllers, "deleteAvatar"]);
$usersRoutes->put("/", [$usersControllers, "update"]);
$usersRoutes->delete("/:id", [$usersControllers, "delete"]);

// Exportando a rota
return $usersRoutes;
?>
