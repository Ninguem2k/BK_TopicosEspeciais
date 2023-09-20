<?php
// Importações não são necessárias em PHP

function ensureAuthentication($req, $res, $next) {
    $authHeader = $req->headers['authorization'];

    if (!$authHeader) {
        throw new Exception("Missing authorization token", 400);
    }

    // Bearer <token>
    // Vamos usar o método explode para acessar o token
    $tokenParts = explode(" ", $authHeader);

    if (count($tokenParts) !== 2 || $tokenParts[0] !== 'Bearer') {
        throw new Exception("Invalid authorization token", 400);
    }

    $token = $tokenParts[1];

    // Tentar verificar a autenticidade do token usando a chave
    try {
        $decodedToken = jwt_decode($token, authConfig::SECRET_TOKEN);
        $sub = $decodedToken->sub;
    } catch (Exception $e) {
        throw new Exception("Invalid authorization token", 400);
    }

    // Checando tipo e tentando buscar usuário na base de dados
    if (!is_string($sub)) {
        throw new Exception("Invalid subject", 400);
    }

    // Implemente a lógica para buscar o usuário na base de dados e fazer as validações necessárias
    // ...

    // Para usar em algumas validações
    $req->user = ['id' => $user->id];

    $next();
}
?>
