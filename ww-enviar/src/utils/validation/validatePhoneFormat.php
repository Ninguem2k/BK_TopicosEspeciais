<?php

class AppError extends Exception {}

function validatePhoneFormat($phone) {
    if (!is_string($phone)) {
        throw new AppError("Formato de telefone inválido", 400);
    }
    
    $cleaned = preg_replace('/\D/', '', $phone);
    if (strlen($cleaned) < 8 || strlen($cleaned) > 13) {
        throw new AppError("Formato de telefone inválido", 400);
    }
}

// Exemplo de uso
try {
    validatePhoneFormat('1234567890');
    echo 'Telefone válido';
} catch (AppError $e) {
    echo 'Erro: ' . $e->getMessage();
}
