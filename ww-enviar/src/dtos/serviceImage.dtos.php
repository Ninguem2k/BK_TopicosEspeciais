<?php

class ServiceImage {
    public $id;
    public $url;
    public $name;
    public $file_size;
    public $format;
    public $service_id;
}

class CreateServiceImageDTO {
    public $url;
    public $name;
    public $file_size;
    public $format;
    public $service_id;
}

class ResponseServiceImageDTO {
    public $id;
    public $url;
    public $name;
}

?>
