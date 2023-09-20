<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ServicesRepository; 
use App\Repositories\ServicesImagesRepository; 
use App\Services\ServicesServices; 
use App\Enums\ServiceOrderOptions; 

class ServiceController extends Controller
{
    protected $servicesRepository;
    protected $servicesImagesRepository;
    protected $servicesServices;

    public function __construct(
        ServicesRepository $servicesRepository,
        ServicesImagesRepository $servicesImagesRepository,
        ServicesServices $servicesServices
    ) {
        $this->servicesRepository = $servicesRepository;
        $this->servicesImagesRepository = $servicesImagesRepository;
        $this->servicesServices = $servicesServices;
    }

    public function findOneByIdWithServicesImagesAndUser(Request $request, $id)
    {
        $service = $this->servicesServices->findOneByIdWithServicesImagesAndUser($id);

        return response()->json($service);
    }

    public function findByUserIdWithServicesImages(Request $request, $id)
    {
        $services = $this->servicesServices->findByUserIdWithServicesImages($id);

        return response()->json($services);
    }

    public function findBySearchTextWithServicesImages(Request $request, $searchText)
    {
        $page = $request->query('page', 1);
        $limit = $request->query('limit', 10);
        $order = $request->query('order', ServiceOrderOptions::DEFAULT);
        $cep = $request->query('cep');

        $services = $this->servicesServices->findBySearchTextWithServicesImages(
            $searchText,
            $page,
            $limit,
            $order,
            $cep
        );

        return response()->json($services);
    }

    public function create(Request $request)
    {
        $serviceDTO = $request->all();

        $this->servicesServices->create($serviceDTO);

        return response()->json([], 201);
    }

    public function update(Request $request)
    {
        $serviceDTO = $request->all();

        $this->servicesServices->update($serviceDTO);

        return response()->noContent();
    }

    public function delete(Request $request, $id)
    {
        $this->servicesServices->delete($id);

        return response()->noContent();
    }

    public function createImages(Request $request, $id)
    {
        $images = $request->file('images');

        $this->servicesServices->createImages($id, $images);

        return response()->noContent();
    }

    public function deleteImage(Request $request, $id)
    {
        $this->servicesServices->deleteImage($id);

        return response()->noContent();
    }
}
