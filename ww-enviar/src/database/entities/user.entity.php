<?php
// Exemplo de classe representando a entidade "User"
class User {
    public $id;
    public $name;
    public $email;
    public $phone;
    public $password;
    public $cep;
    public $avatar;
    public $avatar_url;
    public $created_at;
    public $services;  // Representa o relacionamento com a classe Service

    // Construtor
    public function __construct() {
        if (empty($this->id)) {
            $this->id = uniqid();  // Gera um ID único
        }
    }
}

// Exemplo de classe representando a entidade "Service"
class Service {
    // Propriedades da entidade Service
}

// Exemplo de uso
$user = new User();
$user->name = "John Doe";
$user->email = "john@example.com";
$user->phone = "123456789";
$user->password = "mypassword";
$user->cep = "12345-678";
// ... Defina outras propriedades ...

// Exemplo de relação com a entidade Service
$service1 = new Service();
$service2 = new Service();
$user->services = [$service1, $service2];

// Saída de informações
var_dump($user);
?>
