<?php

use Doctrine\ORM\EntityRepository;

class ServicesRepository implements IServicesRepository {
    private $repository;

    public function __construct() {
        $this->repository = appDataSource::getRepository(Service::class);
    }

    public function findOneById($id) {
        return $this->repository->findOneBy(['id' => $id]);
    }

    public function findOneByIdWithServicesImagesAndUser($id) {
        return $this->repository->findOneBy(['id' => $id], ['relations' => ['images', 'user']]);
    }

    public function findByUserIdWithServicesImages($id, $skip, $take, $order) {
        return $this->repository->findBy(
            ['user_id' => $id],
            ['relations' => ['images'], 'order' => serviceOrderEnum[$order], 'skip' => $skip, 'take' => $take]
        );
    }

    public function findByCategoryIdWithServicesImages($id, $skip, $take, $order, $cep = null) {
        return $this->repository->findBy(
            ['category_id' => $id, 'user' => ['cep' => $cep]],
            ['relations' => ['images'], 'order' => serviceOrderEnum[$order], 'skip' => $skip, 'take' => $take]
        );
    }

    public function findBySearchTextWithServicesImages($searchText, $skip, $take, $order, $cep = null) {
        return $this->repository->findBy(
            [
                'name' => ['ILike' => '%' . $searchText . '%'],
                'description' => ['ILike' => '%' . $searchText . '%'],
                'observation' => ['ILike' => '%' . $searchText . '%'],
                'user' => ['cep' => $cep]
            ],
            ['relations' => ['images'], 'order' => serviceOrderEnum[$order], 'skip' => $skip, 'take' => $take]
        );
    }

    public function create($serviceDTO) {
        $service = $this->repository->create($serviceDTO);
        $this->repository->save($service);
    }

    public function update($service, $serviceDTO) {
        $this->repository->merge($service, $serviceDTO);
        $this->repository->save($service);
    }

    public function delete($id) {
        $this->repository->delete($id);
    }
}

?>
