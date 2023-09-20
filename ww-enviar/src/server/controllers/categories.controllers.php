<?php
require_once "path/to/your/ICreateCategoryRequestDTO.php";
require_once "path/to/your/CategoriesRepository.php";
require_once "path/to/your/CategoriesServices.php";
require_once "path/to/your/LocalStorageProvider.php";
require_once "path/to/your/ServicesServices.php";
require_once "path/to/your/ServicesRepository.php";
require_once "path/to/your/ServicesImagesRepository.php";
require_once "path/to/your/ServiceOrderOptions.php";

$storageProvider = new LocalStorageProvider();

$servicesRepository = new ServicesRepository();
$servicesImagesRepository = new ServicesImagesRepository();

$servicesServices = new ServicesServices(
    $servicesRepository,
    $servicesImagesRepository,
    $storageProvider
);

$categoriesRepository = new CategoriesRepository();
$categoriesServices = new CategoriesServices(
    $categoriesRepository,
    $storageProvider
);

class CategoriesControllers {
    public function findAll($req, $res) {
        $all = $categoriesServices->find();
        return $res->json($all);
    }

    public function findOneByIdWithServicesAndServicesImages($req, $res) {
        $id = $req->params['id'];
        $page = (int) $req->query['page'];
        $limit = (int) $req->query['limit'];
        $order = (int) $req->query['order'];
        $cep = $req->query['cep'];

        $category = $categoriesServices->findOneById($id);
        $services = $servicesServices->findByCategoryIdWithServicesImages(
            $id,
            $page,
            $limit,
            $order,
            $cep
        );

        $category->services = $services;
        return $res->json($category);
    }

    public function findWithServicesAndServicesImages($req, $res) {
        $categories = $categoriesServices->find(1, 6);

        foreach ($categories as $category) {
            $services = $servicesServices->findByCategoryIdWithServicesImages(
                $category->id,
                1,
                8
            );

            $category->services = $services;
        }

        return $res->json($categories);
    }

    public function create($req, $res) {
        $categoryDTO = $req->getBody();
        $categoriesServices->create($categoryDTO);
        return $res->status(201)->send();
    }

    public function delete($req, $res) {
        $id = $req->params['id'];
        $categoriesServices->delete($id);
        return $res->status(204)->send();
    }

    public function createIcon($req, $res) {
        $id = $req->params['id'];
        $filename = $req->file['filename'];
        $categoriesServices->createIcon($id, $filename);
        return $res->status(204)->send();
    }

    public function deleteIcon($req, $res) {
        $id = $req->params['id'];
        $categoriesServices->deleteIcon($id);
        return $res->status(204)->send();
    }
}
?>
