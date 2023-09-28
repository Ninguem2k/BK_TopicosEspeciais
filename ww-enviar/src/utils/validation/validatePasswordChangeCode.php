<?php

class AppError extends Exception {}

function validatePasswordChangeCode($code) {
    if (strlen($code) < 6) {
        throw new AppError("Formato de código incorreto", 400);
    }
}

// Exemplo de uso
try {
    validatePasswordChangeCode('123456');
    echo 'Código válido';
} catch (AppError $e) {
    echo 'Erro: ' . $e->getMessage();
}
