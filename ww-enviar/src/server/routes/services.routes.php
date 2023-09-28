<?php
// Importando classes e configurando o upload
require_once 'express_router.php';
require_once 'multer.php'; // Simulando o uso do multer
require_once '../controllers/services_controllers.php';
require_once '../middlewares/ensure_authentication.php';
require_once '../../configs/upload_config.php';

// Criando instâncias
$servicesRoutes = new ExpressRouter();
$servicesControllers = new ServicesControllers();

$imageUpload = new Multer($multerConfig);

// Definindo rotas
$servicesRoutes->get("/search/:searchText", [$servicesControllers, "findBySearchTextWithServicesImages"]);
$servicesRoutes->get("/user/:id", [$servicesControllers, "findByUserIdWithServicesImages"]);
$servicesRoutes->get("/:id", [$servicesControllers, "findOneByIdWithServicesImagesAndUser"]);

// Utilizando middleware para autenticação
$servicesRoutes->use([$ensureAuthentication, "middlewareFunction"]);

$servicesRoutes->post("/", [$servicesControllers, "create"]);
$servicesRoutes->put("/", [$servicesControllers, "update"]);
$servicesRoutes->delete("/:id", [$servicesControllers, "delete"]);
$servicesRoutes->put("/images/:id", [$imageUpload, "uploadArrayImages"], [$servicesControllers, "createImages"]);
$servicesRoutes->delete("/images/:id", [$servicesControllers, "deleteImage"]);

// Exportando a rota
return $servicesRoutes;
?>
