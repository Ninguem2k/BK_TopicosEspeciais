<?php
require_once "path/to/your/ICreateUserRequestDTO.php";
require_once "path/to/your/IUpdateUserRequestDTO.php";
require_once "path/to/your/UsersRepository.php";
require_once "path/to/your/UsersServices.php";
require_once "path/to/your/LocalStorageProvider.php";
require_once "path/to/your/ServicesRepository.php";
require_once "path/to/your/ServicesImagesRepository.php";
require_once "path/to/your/ServicesServices.php";
require_once "path/to/your/ServiceOrderOptions.php";

$storageProvider = new LocalStorageProvider();

$servicesRepository = new ServicesRepository();
$servicesImagesRepository = new ServicesImagesRepository();

$servicesServices = new ServicesServices(
    $servicesRepository,
    $servicesImagesRepository,
    $storageProvider
);

$usersRepository = new UsersRepository();
$usersServices = new UsersServices($usersRepository, $storageProvider);

class UsersControllers {
    public function findOneByIdWithServicesAndServicesImages($req, $res) {
        $id = $req->params['id'];
        $page = (int) $req->query['page'];
        $limit = (int) $req->query['limit'];
        $order = (int) $req->query['order'];

        $user = $usersServices->findOneById($id);
        $services = $servicesServices->findByUserIdWithServicesImages(
            $id,
            $page,
            $limit,
            $order
        );

        $user->services = $services;

        return $res->json($user);
    }

    public function create($req, $res) {
        $userDTO = $req->getBody();
        $usersServices->create($userDTO);
        return $res->status(201)->send();
    }

    public function update($req, $res) {
        $userDTO = $req->getBody();
        $usersServices->update($userDTO);
        return $res->status(204)->send();
    }

    public function delete($req, $res) {
        $id = $req->params['id'];
        $usersServices->delete($id);
        return $res->status(204)->send();
    }

    public function createAvatar($req, $res) {
        $id = $req->user['id'];
        $filename = $req->file['filename'];
        $usersServices->createAvatar($id, $filename);
        return $res->status(204)->send();
    }

    public function deleteAvatar($req, $res) {
        $id = $req->user['id'];
        $usersServices->deleteAvatar($id);
        return $res->status(204)->send();
    }
}
?>
