<?php
require_once "path/to/your/ICreateServiceRequestDTO.php";
require_once "path/to/your/IUpdateServiceRequestDTO.php";
require_once "path/to/your/ServicesRepository.php";
require_once "path/to/your/ServicesServices.php";
require_once "path/to/your/ServicesImagesRepository.php";
require_once "path/to/your/LocalStorageProvider.php";
require_once "path/to/your/ServiceOrderOptions.php";

$servicesRepository = new ServicesRepository();
$servicesImagesRepository = new ServicesImagesRepository();
$storageProvider = new LocalStorageProvider();

$servicesServices = new ServicesServices(
    $servicesRepository,
    $servicesImagesRepository,
    $storageProvider
);

class ServicesControllers {
    public function findOneByIdWithServicesImagesAndUser($req, $res) {
        $id = $req->params['id'];
        $service = $servicesServices->findOneByIdWithServicesImagesAndUser($id);
        return $res->json($service);
    }

    public function findByUserIdWithServicesImages($req, $res) {
        $id = $req->params['id'];
        $services = $servicesServices->findByUserIdWithServicesImages($id);
        return $res->json($services);
    }

    public function findBySearchTextWithServicesImages($req, $res) {
        $searchText = $req->params['searchText'];
        $page = (int) $req->query['page'];
        $limit = (int) $req->query['limit'];
        $order = (int) $req->query['order'];
        $cep = $req->query['cep'];

        $services = $servicesServices->findBySearchTextWithServicesImages(
            $searchText,
            $page,
            $limit,
            $order,
            $cep
        );
        return $res->json($services);
    }

    public function create($req, $res) {
        $serviceDTO = $req->getBody();
        $servicesServices->create($serviceDTO);
        return $res->status(201)->send();
    }

    public function update($req, $res) {
        $serviceDTO = $req->getBody();
        $servicesServices->update($serviceDTO);
        return $res->status(204)->send();
    }

    public function delete($req, $res) {
        $id = $req->params['id'];
        $servicesServices->delete($id);
        return $res->status(204)->send();
    }

    public function createImages($req, $res) {
        $id = $req->params['id'];
        $images = $req->files['images'];
        $servicesServices->createImages($id, $images);
        return $res->status(204)->send();
    }

    public function deleteImage($req, $res) {
        $id = $req->params['id'];
        $servicesServices->deleteImage($id);
        return $res->status(204)->send();
    }
}
?>
