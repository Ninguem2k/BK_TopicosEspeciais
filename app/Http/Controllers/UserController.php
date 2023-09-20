<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UsersRepository; // Substitua pelo repositório real.
use App\Services\UsersServices; // Substitua pelo serviço real.
use App\Enums\ServiceOrderOptions; // Substitua pelo enum real.
use App\Providers\LocalStorageProvider; // Substitua pelo provedor real.
use App\Repositories\ServicesRepository; // Substitua pelo repositório real.
use App\Repositories\ServicesImagesRepository; // Substitua pelo repositório real.
use App\Services\ServicesServices; // Substitua pelo serviço real.

class UserController extends Controller
{
    protected $usersRepository;
    protected $usersServices;
    protected $localStorageProvider;
    protected $servicesRepository;
    protected $servicesImagesRepository;
    protected $servicesServices;

    public function __construct(
        UsersRepository $usersRepository,
        UsersServices $usersServices,
        LocalStorageProvider $localStorageProvider,
        ServicesRepository $servicesRepository,
        ServicesImagesRepository $servicesImagesRepository,
        ServicesServices $servicesServices
    ) {
        $this->usersRepository = $usersRepository;
        $this->usersServices = $usersServices;
        $this->localStorageProvider = $localStorageProvider;
        $this->servicesRepository = $servicesRepository;
        $this->servicesImagesRepository = $servicesImagesRepository;
        $this->servicesServices = $servicesServices;
    }

    public function findOneByIdWithServicesAndServicesImages(Request $request, $id)
    {
        $page = $request->query('page', 1);
        $limit = $request->query('limit', 10);
        $order = $request->query('order', ServiceOrderOptions::DEFAULT);

        $user = $this->usersServices->findOneById($id);
        $services = $this->servicesServices->findByUserIdWithServicesImages(
            $id,
            $page,
            $limit,
            $order
        );

        $user->services = $services;

        return response()->json($user);
    }

    public function create(Request $request)
    {
        $userDTO = $request->all();

        $this->usersServices->create($userDTO);

        return response()->json([], 201);
    }

    public function update(Request $request)
    {
        $userDTO = $request->all();

        $this->usersServices->update($userDTO);

        return response()->noContent();
    }

    public function delete(Request $request, $id)
    {
        $this->usersServices->delete($id);

        return response()->noContent();
    }

    public function createAvatar(Request $request)
    {
        $id = $request->user()->id;
        $filename = $request->file('image')->store('avatars');

        $this->usersServices->createAvatar($id, $filename);

        return response()->noContent();
    }

    public function deleteAvatar(Request $request)
    {
        $id = $request->user()->id;

        $this->usersServices->deleteAvatar($id);

        return response()->noContent();
    }
}
