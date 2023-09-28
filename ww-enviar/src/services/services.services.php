<?php
namespace App\Services;

use App\Interfaces\IServicesRepository;
use App\Interfaces\IServicesImagesRepository;
use App\DTOs\ICreateServiceRequestDTO;
use App\DTOs\IResponseServiceDTO;
use App\DTOs\IUpdateServiceRequestDTO;
use App\Errors\AppError;
use App\Interfaces\IStorageProvider;
use App\Configs\UploadConfig;
use App\Entities\Service;
use App\Mappers\ServiceMapper;
use App\Enums\ServiceOrderOptions;

class ServicesServices
{
    private $servicesRepository;
    private $servicesImagesRepository;
    private $storageProvider;

    public function __construct(
        IServicesRepository $servicesRepository,
        IServicesImagesRepository $servicesImagesRepository,
        IStorageProvider $storageProvider
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
        return array_map(function ($service) {
            return ServiceMapper::toDTO($service);
        }, $services);
    }

    // Restante do código segue o mesmo padrão de tradução

    // ...

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

?>
