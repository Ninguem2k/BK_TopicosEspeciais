<?php
// Exemplo de classe representando a entidade "Service"
class Service {
    public $id;
    public $name;
    public $price;
    public $discount;
    public $description;
    public $observation;
    public $order;
    public $created_at;
    public $user_id;
    public $category_id;
    public $user;  // Representa o relacionamento com a classe User
    public $category;  // Representa o relacionamento com a classe Category
    public $images;  // Representa o relacionamento com a classe ServiceImage

    // Construtor
    public function __construct() {
        if (empty($this->id)) {
            $this->id = uniqid();  // Gera um ID único
        }
    }
}

// Exemplo de classe representando a entidade "User"
class User {
    // Propriedades da entidade User
}

// Exemplo de classe representando a entidade "Category"
class Category {
    // Propriedades da entidade Category
}

// Exemplo de classe representando a entidade "ServiceImage"
class ServiceImage {
    // Propriedades da entidade ServiceImage
}

// Exemplo de uso
$service = new Service();
$service->name = "Service Name";
$service->price = 100.0;
$service->discount = 10.0;
// ... Defina outras propriedades ...

// Exemplo de relação com as entidades User, Category e ServiceImage
$user = new User();
$category = new Category();
$serviceImage1 = new ServiceImage();
$serviceImage2 = new ServiceImage();
$service->user = $user;
$service->category = $category;
$service->images = [$serviceImage1, $serviceImage2];

// Saída de informações
var_dump($service);
?>
