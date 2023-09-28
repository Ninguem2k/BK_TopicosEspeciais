<?php
// Incluindo as dependências
require 'vendor/autoload.php';

use App\Database\Database; // Suponha que você tenha uma classe Database em "App\Database"
use App\Routes\Router; // Suponha que você tenha uma classe Router em "App\Routes"
use App\Errors\AppError; // Suponha que você tenha uma classe AppError em "App\Errors"

// Inicializando o banco de dados
// Vamos garantir que a aplicação só prosseguirá após a inicialização do banco de dados
$database = new Database();
$database->initialize();

// Configurando o aplicativo
$app = new Express();

// Configurando middleware
$app->use('express.json');

// Rotas da aplicação
$router = new Router();
$app->use($router);

$app->use('/avatar', 'express.static', ['tmpFilePath/avatar']);
$app->use('/icon', 'express.static', ['tmpFilePath/icon']);
$app->use('/service', 'express.static', ['tmpFilePath/service']);

// Middleware para lidar com erros
$app->use(function ($err, $req, $res, $next) {
    if ($err instanceof AppError) {
        $res->status($err->getCode())->json([
            'message' => $err->getMessage(),
        ]);
    }

    $res->status(500)->json([
        'message' => 'Internal server error - ' . $err->getMessage(),
    ]);
});

// Iniciando o servidor
$PORT = 3333;
$app->listen($PORT);
?>
