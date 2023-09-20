<?php
// Configuração para o cliente Redis
$redisClientConfig = [
    'enableOfflineQueue' => false,
    'host' => getenv('REDIS_HOST') ?: '127.0.0.1',
    'port' => 6379,
];

// Exemplo de uso (usando a biblioteca Predis)
$redis = new Predis\Client($redisClientConfig);
?>
