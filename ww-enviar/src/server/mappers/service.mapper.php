<?php
require_once "../../dtos/service.dtos.php";
require_once "../../dtos/serviceImage.dtos.php";
require_once "../../dtos/user.dtos.php";
require_once "../../database/entities/service.entity.php";
require_once "../../database/entities/serviceImage.entity.php";
require_once "../../database/entities/user.entity.php";
require_once "./serviceImage.mapper.php";
require_once "./user.mapper.php";

class ServiceMapper {
    public static function toDTO($service) {
        return [
            'id' => $service->id,
            'name' => $service->name,
            'price' => $service->price,
            'discount' => $service->discount,
            'description' => $service->description,
            'observation' => $service->observation,
            'images' => self::handleServicesImages($service->images),
            'user' => self::handleUser($service->user),
        ];
    }

    private static function handleServicesImages($serviceImages) {
        if (!$serviceImages || count($serviceImages) === 0) {
            return null;
        }

        $responseServiceImages = array_map(function($serviceImage) {
            return ServiceImageMapper::toDTO($serviceImage);
        }, $serviceImages);

        return $responseServiceImages;
    }

    private static function handleUser($user) {
        if (!$user) {
            return null;
        }

        return UserMapper::toDTO($user);
    }
}
?>
