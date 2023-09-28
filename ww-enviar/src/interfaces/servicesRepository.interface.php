<?php

require_once "service.dtos.php"; // Assuming the DTOs are defined in this file
require_once "service.entity.php"; // Assuming the Service entity is defined in this file

interface IServicesRepository {
    public function findOneById(string $id): ?Service;
    public function findOneByIdWithServicesImagesAndUser(string $id): ?Service;
    public function findByUserIdWithServicesImages(string $id, int $skip, int $take, string $order): ?array;
    public function findByCategoryIdWithServicesImages(string $id, int $skip, int $take, string $order, ?string $cep): ?array;
    public function findBySearchTextWithServicesImages(string $searchText, int $skip, int $take, string $order, ?string $cep): ?array;
    public function create(ICreateServiceDTO $serviceDTO): void;
    public function update(Service $service, IUpdateServiceDTO $serviceDTO): void;
    public function delete(string $id): void;
}

?>
