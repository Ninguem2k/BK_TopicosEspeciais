<?php
// Configuração de autenticação
$authConfig = [
    'secret_token' => getenv('JWT_SECRET_TOKEN') ?: '',
    'expires_in_token' => '10d',  // 10 dias
    'secret_refresh_token' => getenv('JWT_SECRET_REFRESH_TOKEN') ?: '',
    'expires_in_refresh_token' => '30d'  // 30 dias
];

// Exporta a configuração de autenticação (simulado, não é uma funcionalidade nativa do PHP)
function exportAuthConfig() {
    global $authConfig;
    return $authConfig;
}

// Exemplo de uso
var_dump(exportAuthConfig());
?>
