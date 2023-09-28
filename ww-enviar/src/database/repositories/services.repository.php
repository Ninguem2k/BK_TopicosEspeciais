<?php

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

class ServicesRepository implements IServicesRepository
{
    private $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repository = $entityManager->getRepository(Service::class);
    }

    public function findOneById($id)
    {
        return $this->repository->findOneBy(['id' => $id]);
    }

    public function findOneByIdWithServicesImagesAndUser($id)
    {
        $qb = $this->repository->createQueryBuilder('s')
            ->where('s.id = :id')
            ->setParameter('id', $id)
            ->innerJoin('s.images', 'i')
            ->innerJoin('s.user', 'u');

        return $qb->getQuery()->getOneOrNullResult();
    }

    public function findByUserIdWithServicesImages($id, $skip, $take, $order)
    {
        $qb = $this->repository->createQueryBuilder('s')
            ->where('s.user_id = :user_id')
            ->setParameter('user_id', $id)
            ->innerJoin('s.images', 'i')
            ->orderBy('s.' . $order)
            ->setFirstResult($skip)
            ->setMaxResults($take);

        return $qb->getQuery()->getResult();
    }

    // Restante das funções de consulta adaptadas de maneira semelhante

    public function create(ICreateServiceDTO $serviceDTO)
    {
        $service = new Service();
        // Preencha os campos do serviço com os dados de $serviceDTO

        // Persista o serviço no banco de dados
        // $this->entityManager->persist($service);
        // $this->entityManager->flush();
    }

    public function update(Service $service, IUpdateServiceDTO $serviceDTO)
    {
        // Atualize os campos do serviço com os dados de $serviceDTO

        // Persista as alterações no banco de dados
        // $this->entityManager->flush();
    }

    public function delete($id)
    {
        $service = $this->repository->findOneBy(['id' => $id]);
        if ($service) {
            // Remova o serviço do banco de dados
            // $this->entityManager->remove($service);
            // $this->entityManager->flush();
        }
    }
}
