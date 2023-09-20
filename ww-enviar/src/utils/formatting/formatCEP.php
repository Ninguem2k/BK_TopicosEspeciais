<?php
function formatCEP($cep) {
    // Caso o cep não possua hífen, ele recebe
    return preg_replace('/^(\d{5})(\d{3})$/', '$1-$2', $cep);
}
?>
