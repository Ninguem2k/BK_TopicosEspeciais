<?php

namespace App\Repositories;

use App\Models\ServiceImage;

class ServiceImageRepository
{
    public function findById(string $id): ?ServiceImage
    {
        return ServiceImage::find($id);
    }

    public function create(array $data): ServiceImage
    {
        return ServiceImage::create($data);
    }

    public function delete(string $id): void
    {
        ServiceImage::destroy($id);
    }
}
