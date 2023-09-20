<?php

// User entity class
class User {
    public $id;
    public $name;
    public $email;
    public $phone;
    public $cep;
    public $password;
    public $avatar;
    public $avatar_url;
}

// Service DTO interface
interface IResponseServiceDTO {
    // Define properties specific to IResponseServiceDTO
}

// Create user DTO interface
interface ICreateUserDTO {
    public $name;
    public $email;
    public $phone;
    public $cep;
    public $password;
}

// Create user request DTO interface
interface ICreateUserRequestDTO {
    public $name;
    public $email;
    public $phone;
    public $cep;
    public $password;
}

// Update user type
class UpdateUserType {
    public $id;
    public $name;
    public $email;
    public $phone;
    public $cep;
    public $password; // Optional
    public $avatar;   // Optional
    public $avatar_url; // Optional
}

// Update user DTO interface
interface IUpdateUserDTO {
    // Implement UpdateUserType properties
}

// Update user request DTO interface
interface IUpdateUserRequestDTO {
    public $id;
    public $name;
    public $email;
    public $password;
    public $phone;
    public $cep;
}

// Response user DTO interface
interface IResponseUserDTO {
    public $id;
    public $name;
    public $email;
    public $phone;
    public $cep;
    public $avatar_url;
    public $services; // Array of IResponseServiceDTO or null
}

// Authentication user DTO interface
interface IAuthenticationUserDTO {
    public $email;
    public $password;
}

?>
