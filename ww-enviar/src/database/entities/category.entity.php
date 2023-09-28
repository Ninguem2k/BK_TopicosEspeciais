<?php
// Exemplo de classe representando a entidade "Category"
class Category {
    public $id;
    public $name;
    public $description;
    public $icon;
    public $icon_url;
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
$category = new Category();
$category->name = "Category Name";
$category->description = "Category Description";
// ... Defina outras propriedades ...

// Exemplo de relação com a entidade Service
$service1 = new Service();
$service2 = new Service();
$category->services = [$service1, $service2];

// Saída de informações
var_dump($category);
?>
