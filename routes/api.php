<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\CategoriesController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/services/search/{searchText}', [ServicesController::class, 'findBySearchTextWithServicesImages']);
Route::get('/services/user/{id}', [ServicesController::class, 'findByUserIdWithServicesImages']);
Route::get('/services/{id}', [ServicesController::class, 'findOneByIdWithServicesImages']);

Route::middleware(['auth'])->group(function () {
    Route::post('/services', [ServicesController::class, 'create']);
    Route::put('/services', [ServicesController::class, 'update']);
    Route::delete('/services/{id}', [ServicesController::class, 'delete']);
    Route::put('/services/images/{id}', [ServicesController::class, 'createImages']);
    Route::delete('/services/images/{id}', [ServicesController::class, 'deleteImage']);
});

Route::get('/users/{id}', [UsersController::class, 'findOneByIdWithServicesAndServicesImages']);
Route::post('/users', [UsersController::class, 'create']);

Route::middleware(['auth'])->group(function () {
    Route::put('/users/avatar', [UsersController::class, 'createAvatar']);
    Route::delete('/users/avatar', [UsersController::class, 'deleteAvatar']);
    Route::put('/users', [UsersController::class, 'update']);
    Route::delete('/users/{id}', [UsersController::class, 'delete']);
});

Route::get('/categories', [CategoriesController::class, 'findAll']);
Route::get('/categories/home', [CategoriesController::class, 'findWithServicesAndServicesImages']);
Route::get('/categories/{id}', [CategoriesController::class, 'findOneByIdWithServicesAndServicesImages']);

Route::middleware(['auth'])->group(function () {
    Route::put('/categories/icon/{id}', [CategoriesController::class, 'createIcon']);
    Route::post('/categories', [CategoriesController::class, 'create']);
    Route::delete('/categories/icon/{id}', [CategoriesController::class, 'deleteIcon']);
    Route::delete('/categories/{id}', [CategoriesController::class, 'delete']);
});



Route::post('/sessions', [AuthController::class, 'createSession']);
Route::post('/sessions_with_code', [AuthController::class, 'createSessionWithCode']);
Route::post('/refresh_token', [AuthController::class, 'refreshToken']);
Route::post('/recover_password', [AuthController::class, 'recoverPassword']);
