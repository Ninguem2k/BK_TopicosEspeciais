<?php
// Exemplo de classe representando a entidade "ServiceImage"
class ServiceImage {
    public $id;
    public $url;
    public $name;
    public $file_size;
    public $format;
    public $created_at;
    public $service_id;
    public $service;  // Representa o relacionamento com a classe Service

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
$serviceImage = new ServiceImage();
$serviceImage->url = "https://example.com/image.jpg";
$serviceImage->name = "Image Name";
$serviceImage->file_size = 1024;
$serviceImage->format = "jpg";
// ... Defina outras propriedades ...

// Exemplo de relação com a entidade Service
$service = new Service();
$serviceImage->service = $service;

// Saída de informações
var_dump($serviceImage);
?>
