<?php
use App\Interfaces\ICategoriesRepository;
use App\DTOs\ICreateCategoryRequestDTO;
use App\DTOs\IResponseCategoryDTO;
use App\DTOs\IUpdateCategoryDTO;
use App\Errors\AppError;
use App\Interfaces\IStorageProvider;
use App\Entities\Category;
use App\Configs\UploadConfig;
use App\Mappers\CategoryMapper;

class CategoriesServices {
    private $categoriesRepository;
    private $storageProvider;

    public function __construct(ICategoriesRepository $categoriesRepository, IStorageProvider $storageProvider) {
        $this->categoriesRepository = $categoriesRepository;
        $this->storageProvider = $storageProvider;
    }

    public function checkIfCategoryExists($id) {
        $category = $this->categoriesRepository->findOneById($id);

        if (!$category) {
            throw new AppError("Category does not exist", 404);
        }

        return $category;
    }

    public function find($page = null, $limit = null) {
        $skip = null;

        if ($page !== null && $limit !== null) {
            $skip = ($page - 1) * $limit;
        }

        $categories = $this->categoriesRepository->find($skip, $limit) ?? [];

        return array_map(function ($category) {
            return CategoryMapper::toDTO($category);
        }, $categories);
    }

    public function findOneById($id) {
        return CategoryMapper::toDTO($this->checkIfCategoryExists($id));
    }

    public function create(ICreateCategoryRequestDTO $categoryDTO) {
        $category = $this->categoriesRepository->findOneByName($categoryDTO->name);

        if ($category) {
            throw new AppError("Category already exists", 404);
        }

        $this->categoriesRepository->create($categoryDTO);
    }

    public function delete($id) {
        $this->checkIfCategoryExists($id);

        $this->categoriesRepository->delete($id);
    }

    public function createIcon($id, $file) {
        $category = $this->checkIfCategoryExists($id);

        if (!$file) {
            throw new AppError("Image does not exist", 404);
        }

        if ($category->icon) {
            $this->storageProvider->delete($category->icon, "icon");
        }

        $this->storageProvider->save($file, "icon");

        $newCategory = new IUpdateCategoryDTO();
        $newCategory->icon = $file;
        $newCategory->icon_url = UploadConfig::APP_URL . "icon/{$file}";

        $this->categoriesRepository->update($category, $newCategory);
    }

    public function deleteIcon($id) {
        $category = $this->checkIfCategoryExists($id);

        if (!$category->icon_url || !$category->icon) {
            throw new AppError("Image does not exist", 404);
        }

        $this->storageProvider->delete($category->icon, "icon");

        // Excluindo a URL e o caminho do arquivo
        $category->icon = null;
        $category->icon_url = null;

        $this->categoriesRepository->update($category, $category);
    }
}

?>
