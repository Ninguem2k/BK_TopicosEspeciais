<?php

class Category {
    public $id;
    public $name;
    public $description;
    public $icon_url;
}

class ServiceDTO {
    // Properties for service DTO
}

class CreateCategoryDTO {
    public $name;
    public $description;
}

class CreateCategoryRequestDTO {
    public $name;
    public $description;
}

class UpdateCategoryDTO {
    public $icon;
    public $icon_url;
}

class ResponseCategoryType {
    public $id;
    public $name;
    public $description;
    public $icon_url;
    public $services; // This could be an array of ServiceDTO or null
}

class ResponseCategoryDTO extends ResponseCategoryType {
    // No additional properties in this case
}

?>
