<?php
// Definição da configuração para o limitador de taxa usando Redis
$rateLimiterRedisConfig = [
    'rejectIfRedisNotReady' => true,
    'keyPrefix' => 'middleware',
    'points' => 10,  // 10 requests
    'duration' => 1,  // per 1 second by IP
];

// Exemplo de uso
var_dump($rateLimiterRedisConfig);
?>
