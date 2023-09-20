<?php

namespace App\Services;

use App\Exceptions\AppError;
use App\Interfaces\CategoriesRepositoryInterface;
use App\Interfaces\StorageProviderInterface;
use App\Mappers\CategoryMapper;
use App\DTOs\CreateCategoryRequestDTO;
use App\DTOs\ResponseCategoryDTO;
use App\DTOs\UpdateCategoryDTO;

class CategoriesServices
{
    private $categoriesRepository;
    private $storageProvider;

    public function __construct(CategoriesRepositoryInterface $categoriesRepository, StorageProviderInterface $storageProvider)
    {
        $this->categoriesRepository = $categoriesRepository;
        $this->storageProvider = $storageProvider;
    }

    public function checkIfCategoryExists($id)
    {
        $category = $this->categoriesRepository->findOneById($id);

        if (!$category) {
            throw new AppError("Category does not exist", 404);
        }

        return $category;
    }

    public function find($page = null, $limit = null)
    {
        $skip = null;

        if ($page !== null && $limit !== null) {
            $skip = ($page - 1) * $limit;
        }

        $categories = $this->categoriesRepository->find($skip, $limit) ?? [];

        return array_map(function ($category) {
            return CategoryMapper::toDTO($category);
        }, $categories);
    }

    public function findOneById($id)
    {
        return CategoryMapper::toDTO($this->checkIfCategoryExists($id));
    }

    public function create(CreateCategoryRequestDTO $categoryDTO)
    {
        $category = $this->categoriesRepository->findOneByName($categoryDTO->name);

        if ($category) {
            throw new AppError("Category already exists", 404);
        }

        $this->categoriesRepository->create($categoryDTO);
    }

    public function delete($id)
    {
        $this->checkIfCategoryExists($id);

        $this->categoriesRepository->delete($id);
    }

    public function createIcon($id, $file)
    {
        $category = $this->checkIfCategoryExists($id);

        if (!$file) {
            throw new AppError("Image does not exist", 404);
        }

        if ($category->icon) {
            $this->storageProvider->delete($category->icon, "icon");
        }

        $this->storageProvider->save($file, "icon");

        $newCategory = new UpdateCategoryDTO([
            'icon' => $file,
            'icon_url' => appUrl() . "icon/$file",
        ]);

        $this->categoriesRepository->update($category, $newCategory);
    }

    public function deleteIcon($id)
    {
        $category = $this->checkIfCategoryExists($id);

        if (!$category->icon_url || !$category->icon) {
            throw new AppError("Image does not exist", 404);
        }

        $this->storageProvider->delete($category->icon, "icon");

        $category->icon = null;
        $category->icon_url = null;

        $this->categoriesRepository->update($category, $category);
    }
}
