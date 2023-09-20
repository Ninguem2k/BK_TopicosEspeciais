<?php

namespace App\Services;

use App\Enums\ServiceOrderOptions;
use App\Exceptions\AppError;
use App\Interfaces\IServicesRepository;
use App\Interfaces\IServicesImagesRepository;
use App\Interfaces\IStorageProvider;
use App\Mappers\ServiceMapper;
use App\DTOs\ICreateServiceRequestDTO;
use App\DTOs\IResponseServiceDTO;
use App\DTOs\IUpdateServiceRequestDTO;

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

    // ... Restante do código permanece igual, traduzido para PHP

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

    // ... Restante do código permanece igual, traduzido para PHP
}
