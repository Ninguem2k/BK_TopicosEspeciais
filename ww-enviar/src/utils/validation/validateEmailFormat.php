<?php

class AppError extends Exception {}

function validateEmailFormat($email) {
    $emailRegex = '/^[^\s@]+@[^\s@]+\.[^\s@]+$/';
    if (!preg_match($emailRegex, $email)) {
        throw new AppError("Formato de e-mail inválido", 400);
    }
}

// Exemplo de uso
try {
    validateEmailFormat('example@example.com');
    echo 'E-mail válido';
} catch (AppError $e) {
    echo 'Erro: ' . $e->getMessage();
}
