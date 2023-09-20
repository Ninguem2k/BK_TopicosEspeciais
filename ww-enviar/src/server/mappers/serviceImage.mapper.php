<?php
require_once "../../dtos/serviceImage.dtos.php";
require_once "../../database/entities/serviceImage.entity.php";

class ServiceImageMapper {
    public static function toDTO($serviceImage) {
        return [
            'id' => $serviceImage->id,
            'url' => $serviceImage->url,
            'name' => $serviceImage->name,
        ];
    }
}
?>
