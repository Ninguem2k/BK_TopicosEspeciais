<?php
// Importando classes e configurando o upload
require_once 'express_router.php';
require_once 'multer.php'; // Simulando o uso do multer
require_once '../controllers/categories_controllers.php';
require_once '../middlewares/ensure_authentication.php';
require_once '../../configs/upload_config.php';

// Criando instâncias
$categoriesRoutes = new ExpressRouter();
$categoriesControllers = new CategoriesControllers();

$imageUpload = new Multer($multerConfig);

// Definindo rotas
$categoriesRoutes->get("/", [$categoriesControllers, "findAll"]);
$categoriesRoutes->get("/home", [$categoriesControllers, "findWithServicesAndServicesImages"]);
$categoriesRoutes->get("/:id", [$categoriesControllers, "findOneByIdWithServicesAndServicesImages"]);

// Utilizando middleware para autenticação
$categoriesRoutes->use([$ensureAuthentication, "middlewareFunction"]);

$categoriesRoutes->put("/icon/:id", [$imageUpload, "uploadSingleImage"], [$categoriesControllers, "createIcon"]);
$categoriesRoutes->post("/", [$categoriesControllers, "create"]);
$categoriesRoutes->delete("/icon/:id", [$categoriesControllers, "deleteIcon"]);
$categoriesRoutes->delete("/:id", [$categoriesControllers, "delete"]);

// Exportando a rota
return $categoriesRoutes;
?>
