<?php

namespace App\Services;

use App\Exceptions\AppError;
use App\Models\Service;
use App\Models\ServiceImage;
use App\Enums\ServiceOrderOptions;
use App\Http\DTOs\CreateServiceRequestDTO;
use App\Http\DTOs\UpdateServiceRequestDTO;
use App\Mappers\ServiceMapper;
use App\Repositories\ServicesRepository;
use App\Repositories\ServicesImagesRepository;
use App\Interfaces\StorageProviderInterface;

class ServicesService
{
    private $servicesRepository;
    private $servicesImagesRepository;
    private $storageProvider;

    public function __construct(
        ServicesRepository $servicesRepository,
        ServicesImagesRepository $servicesImagesRepository,
        StorageProviderInterface $storageProvider
    ) {
        $this->servicesRepository = $servicesRepository;
        $this->servicesImagesRepository = $servicesImagesRepository;
        $this->storageProvider = $storageProvider;
    }

    public function checkIfServiceExists($id)
    {
        $service = $this->servicesRepository->findOneById($id);

        if (!$service) {
            throw new AppError("Service does not exist", 404);
        }

        return $service;
    }

    public function findOneByIdWithServicesImagesAndUser($id)
    {
        $service = $this->servicesRepository->findOneByIdWithServicesImagesAndUser($id);

        if (!$service) {
            throw new AppError("Service does not exist", 404);
        }

        return ServiceMapper::toDTO($service);
    }

    public function findByUserIdWithServicesImages($id, $page = 1, $limit = 30, $order = ServiceOrderOptions::RECENT_DATE)
    {
        $skip = ($page - 1) * $limit;
        $services = $this->servicesRepository->findByUserIdWithServicesImages($id, $skip, $limit, $order) ?? [];
        return array_map([ServiceMapper::class, 'toDTO'], $services);
    }

    public function findByCategoryIdWithServicesImages($id, $page = 1, $limit = 30, $order = ServiceOrderOptions::RECENT_DATE, $cep = null)
    {
        $skip = ($page - 1) * $limit;
        $services = $this->servicesRepository->findByCategoryIdWithServicesImages($id, $skip, $limit, $order, $cep) ?? [];
        return array_map([ServiceMapper::class, 'toDTO'], $services);
    }

    public function findBySearchTextWithServicesImages($searchText, $page = 1, $limit = 30, $order = ServiceOrderOptions::RECENT_DATE, $cep = null)
    {
        $skip = ($page - 1) * $limit;
        $searchText = str_replace("-", " ", $searchText);
        $services = $this->servicesRepository->findBySearchTextWithServicesImages($searchText, $skip, $limit, $order, $cep) ?? [];
        return array_map([ServiceMapper::class, 'toDTO'], $services);
    }

    public function create(CreateServiceRequestDTO $serviceDTO)
    {
        $this->servicesRepository->create(array_merge($serviceDTO->toArray(), ['order' => 0]));
    }

    public function update(UpdateServiceRequestDTO $serviceDTO)
    {
        $service = $this->checkIfServiceExists($serviceDTO->id);
        $this->servicesRepository->update($service, $serviceDTO->toArray());
    }

    public function delete($id)
    {
        $this->checkIfServiceExists($id);
        $this->servicesRepository->delete($id);
    }

    public function createImages($id, $files)
    {
        $this->checkIfServiceExists($id);

        if (!$files || count($files) === 0) {
            throw new AppError("Image does not exist", 404);
        }

        foreach ($files as $file) {
            $this->storageProvider->save($file->filename, "service");

            $this->servicesImagesRepository->create([
                'service_id' => $id,
                'name' => $file->filename,
                'url' => appUrl() . "service/{$file->filename}",
                'file_size' => $file->size,
                'format' => $file->mimetype,
            ]);
        }
    }

    public function deleteImage($id)
    {
        $image = $this->servicesImagesRepository->findOneById($id);

        if (!$image) {
            throw new AppError("Image does not exist", 404);
        }

        $this->storageProvider->delete($image->name, "service");
        $this->servicesImagesRepository->delete($id);
    }
}
