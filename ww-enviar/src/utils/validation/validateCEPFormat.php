<?php

class AppError extends Exception {}

function validateCEPFormat($cep) {
    $cepRegex = '/^\d{5}-?\d{3}$/';
    if (!preg_match($cepRegex, $cep)) {
        throw new AppError("Formato de CEP inválido", 400);
    }
}

// Exemplo de uso
try {
    validateCEPFormat('12345-678');
    echo 'CEP válido';
} catch (AppError $e) {
    echo 'Erro: ' . $e->getMessage();
}
