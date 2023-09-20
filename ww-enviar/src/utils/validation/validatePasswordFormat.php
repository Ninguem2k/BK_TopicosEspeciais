<?php

class AppError extends Exception {}

function validatePasswordFormat($password) {
    if (strlen($password) < 8) {
        throw new AppError("A senha deve ter pelo menos 8 caracteres", 400);
    }
}

// Exemplo de uso
try {
    validatePasswordFormat('senha123');
    echo 'Senha válida';
} catch (AppError $e) {
    echo 'Erro: ' . $e->getMessage();
}
