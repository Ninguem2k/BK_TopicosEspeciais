<?php

class Service {
    public $id;
    public $name;
    public $price;
    public $discount;
    public $description;
    public $observation;
    public $order;
    public $user_id;
    public $category_id;
}

class ServiceImageDTO {
    // Properties for service image DTO
}

class UserDTO {
    // Properties for user DTO
}

class CreateServiceDTO {
    public $name;
    public $price;
    public $discount;
    public $description;
    public $observation;
    public $order;
    public $user_id;
    public $category_id;
}

class CreateServiceRequestDTO {
    public $name;
    public $price;
    public $discount;
    public $description;
    public $observation;
    public $user_id;
    public $category_id;
}

class UpdateServiceDTO {
    public $id;
    public $name;
    public $price;
    public $discount;
    public $description;
    public $observation;
    public $order;
    public $user_id;
    public $category_id;
}

class UpdateServiceRequestDTO {
    public $id;
    public $name;
    public $price;
    public $discount;
    public $description;
    public $observation;
    public $order;
    public $user_id;
    public $category_id;
}

class ResponseServiceType {
    public $id;
    public $name;
    public $price;
    public $discount;
    public $description;
    public $observation;
    public $images; // This could be an array of ServiceImageDTO or null
    public $user; // This could be an instance of UserDTO or null
}

class ResponseServiceDTO extends ResponseServiceType {
    // No additional properties in this case
}

?>
