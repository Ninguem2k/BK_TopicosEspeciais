<?php

require_once 'Repository.php';
require_once '../../dtos/serviceImage.dtos.php';
require_once '../../interfaces/servicesImagesRepository.interface.php';
require_once '../appDataSource.php';
require_once '../entities/serviceImage.entity.php';

class ServicesImagesRepository implements IServicesImagesRepository {
    private $repository;

    public function __construct() {
        $appDataSource = new AppDataSource();
        $this->repository = $appDataSource->getRepository(ServiceImage::class);
    }

    public function findOneById($id) {
        return $this->repository->findOneBy(['id' => $id]);
    }

    public function create($imageDTO) {
        $serviceImage = new ServiceImage();
        // Assuming $imageDTO has the necessary properties to populate the ServiceImage object
        // Assuming there is a mapping or a method to set properties from $imageDTO to $serviceImage
        // Example: $serviceImage->setName($imageDTO->name);

        $this->repository->save($serviceImage);
        return $serviceImage;
    }

    public function delete($id) {
        $this->repository->delete($id);
    }
}

?>
