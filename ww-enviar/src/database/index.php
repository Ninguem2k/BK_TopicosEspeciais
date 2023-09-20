<?php
require_once "reflect-metadata";
require_once "typeorm/DataSource.php"; // Assuming a DataSource class exists in a file named DataSource.php
require_once "../configs/typeorm.config.php"; // Assuming the config is in a file named typeorm.config.php

// Include the TypeORM configuration
include_once "typeorm.config.php";

// Create a DataSource instance using the provided configuration
$appDataSource = new DataSource($typeormDataSourceConfig);

// Rest of your PHP code...
?>
