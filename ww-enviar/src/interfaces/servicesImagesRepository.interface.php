<?php
namespace App\Repositories;

use App\DTOs\ICreateServiceImageDTO;
use App\Entities\ServiceImage;

interface IServicesImagesRepository {
    public function findOneById(string $id): ?ServiceImage;
    public function create(ICreateServiceImageDTO $dto): ServiceImage;
    public function delete(string $id): void;
}
?>
