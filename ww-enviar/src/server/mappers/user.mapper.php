<?php
require_once "../../dtos/user.dtos.php";
require_once "../../database/entities/user.entity.php";
require_once "../../database/entities/service.entity.php";
require_once "../../dtos/service.dtos.php";
require_once "./service.mapper.php";

class UserMapper {
    public static function toDTO($user) {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'cep' => $user->cep,
            'avatar_url' => $user->avatar_url,
            'services' => self::handleServices($user->services),
        ];
    }

    private static function handleServices($services) {
        if (!$services || count($services) === 0) {
            return null;
        }

        $responseServices = array_map(function($service) {
            return ServiceMapper::toDTO($service);
        }, $services);

        return $responseServices;
    }
}
?>
