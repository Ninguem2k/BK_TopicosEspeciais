<?php
// Importações não são necessárias em PHP

require 'Redis.php'; // Assume que você tem uma implementação da classe Redis

$redisClientConfig = array(
    'host' => 'localhost',
    'port' => 6379,
    'database' => 0
);

$redisClient = new Redis($redisClientConfig);

$rateLimiterRedisConfig = array(
    'points' => 10, // Número de pontos permitidos
    'duration' => 60, // Janela de tempo em segundos
);

// Middleware para limitar a taxa
function rateLimiter($req, $res, $next) {
    global $redisClient;
    global $rateLimiterRedisConfig;

    // Obtém o IP do cliente
    $clientIP = $_SERVER['REMOTE_ADDR'];

    // Gera uma chave única para o IP
    $key = 'rate_limiter:' . $clientIP;

    // Verifica se o IP atingiu a taxa limite
    $remainingRequests = $redisClient->decr($key);
    if ($remainingRequests >= 0) {
        $next();
    } else {
        $res->status(429)->json(array('message' => 'Too Many Requests'));
    }
}
?>
