<?php
require_once "../../dtos/category.dtos.php";
require_once "../../dtos/service.dtos.php";
require_once "../../database/entities/category.entity.php";
require_once "../../database/entities/service.entity.php";
require_once "./service.mapper.php";

class CategoryMapper {
    public static function toDTO($category) {
        return [
            'id' => $category->id,
            'name' => $category->name,
            'description' => $category->description,
            'icon_url' => $category->icon_url,
            'services' => self::handleServices($category->services),
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
