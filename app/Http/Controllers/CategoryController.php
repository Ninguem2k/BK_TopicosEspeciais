<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\CategoriesRepository; // Substitua pelo repositório real.
use App\Repositories\ServicesRepository; // Substitua pelo repositório real.
use App\Repositories\ServicesImagesRepository; // Substitua pelo repositório real.
use App\Services\CategoriesServices; // Substitua pelo serviço real.
use App\Services\ServicesServices; // Substitua pelo serviço real.
use App\Providers\LocalStorageProvider; // Substitua pelo provedor real.
use App\Enums\ServiceOrderOptions; // Substitua pelo enum real.

class CategoryController extends Controller
{
    protected $categoriesRepository;
    protected $servicesRepository;
    protected $servicesImagesRepository;
    protected $categoriesServices;
    protected $servicesServices;
    protected $storageProvider;

    public function __construct(
        CategoriesRepository $categoriesRepository,
        ServicesRepository $servicesRepository,
        ServicesImagesRepository $servicesImagesRepository,
        CategoriesServices $categoriesServices,
        ServicesServices $servicesServices,
        LocalStorageProvider $storageProvider
    ) {
        $this->categoriesRepository = $categoriesRepository;
        $this->servicesRepository = $servicesRepository;
        $this->servicesImagesRepository = $servicesImagesRepository;
        $this->categoriesServices = $categoriesServices;
        $this->servicesServices = $servicesServices;
        $this->storageProvider = $storageProvider;
    }

    public function findAll(Request $request)
    {
        $all = $this->categoriesServices->find();

        return response()->json($all);
    }

    public function findOneByIdWithServicesAndServicesImages(Request $request, $id)
    {
        $page = $request->query('page', 1);
        $limit = $request->query('limit', 10);
        $order = $request->query('order', ServiceOrderOptions::DEFAULT);
        $cep = $request->query('cep');

        $category = $this->categoriesServices->findOneById($id);
        $services = $this->servicesServices->findByCategoryIdWithServicesImages(
            $id,
            $page,
            $limit,
            $order,
            $cep
        );

        $category->services = $services;

        return response()->json($category);
    }

    public function findWithServicesAndServicesImages(Request $request)
    {
        $categories = $this->categoriesServices->find(1, 6);

        foreach ($categories as $category) {
            $services = $this->servicesServices->findByCategoryIdWithServicesImages(
                $category->id,
                1,
                8
            );

            $category->services = $services;
        }

        return response()->json($categories);
    }

    public function create(Request $request)
    {
        $categoryDTO = $request->all();

        $this->categoriesServices->create($categoryDTO);

        return response()->json([], 201);
    }

    public function delete(Request $request, $id)
    {
        $this->categoriesServices->delete($id);

        return response()->noContent();
    }

    public function createIcon(Request $request, $id)
    {
        $filename = $request->file('image')->store('categories');

        $this->categoriesServices->createIcon($id, $filename);

        return response()->noContent();
    }

    public function deleteIcon(Request $request, $id)
    {
        $this->categoriesServices->deleteIcon($id);

        return response()->noContent();
    }
}
