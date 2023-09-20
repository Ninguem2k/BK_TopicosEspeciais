<?php

namespace App\Repositories;

use App\Models\Service;
use Illuminate\Support\Collection;

class ServiceRepository
{
    public function findById(string $id): ?Service
    {
        return Service::find($id);
    }

    public function findByIdWithImagesAndUser(string $id): ?Service
    {
        return Service::with('images', 'user')->find($id);
    }

    public function findByUserIdWithImages(string $userId, int $skip, int $take, string $order): Collection
    {
        return Service::where('user_id', $userId)
            ->with('images')
            ->orderBy($order)
            ->skip($skip)
            ->take($take)
            ->get();
    }

    public function findByCategoryIdWithImages(string $categoryId, int $skip, int $take, string $order, ?string $cep = null): Collection
    {
        return Service::where('category_id', $categoryId)
            ->whereHas('user', function ($query) use ($cep) {
                if ($cep) {
                    $query->where('cep', $cep);
                }
            })
            ->with('images')
            ->orderBy($order)
            ->skip($skip)
            ->take($take)
            ->get();
    }

    public function findBySearchTextWithImages(string $searchText, int $skip, int $take, string $order, ?string $cep = null): Collection
    {
        return Service::where(function ($query) use ($searchText, $cep) {
            $query->where('name', 'like', "%$searchText%")
                ->orWhere('description', 'like', "%$searchText%")
                ->orWhere('observation', 'like', "%$searchText%")
                ->whereHas('user', function ($query) use ($cep) {
                    if ($cep) {
                        $query->where('cep', $cep);
                    }
                });
        })
        ->with('images')
        ->orderBy($order)
        ->skip($skip)
        ->take($take)
        ->get();
    }

    public function create(array $data): Service
    {
        return Service::create($data);
    }

    public function update(Service $service, array $data): void
    {
        $service->update($data);
    }

    public function delete(string $id): void
    {
        Service::destroy($id);
    }
}
