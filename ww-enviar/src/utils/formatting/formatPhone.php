<?php
function formatPhone($phone) {
    $cleaned = preg_replace('/\D/', '', $phone);
    $length = strlen($cleaned);

    switch ($length) {
        case 9:
            return substr($cleaned, 0, 5) . '-' . substr($cleaned, 5);
        case 10:
            return '(' . substr($cleaned, 0, 2) . ') ' . substr($cleaned, 2, 4) . '-' . substr($cleaned, 6);
        case 11:
            return '(' . substr($cleaned, 0, 2) . ') ' . substr($cleaned, 2, 5) . '-' . substr($cleaned, 7);
        case 12:
            return '+' . substr($cleaned, 0, 2) . ' (' . substr($cleaned, 2, 2) . ') ' . substr($cleaned, 4, 4) . '-' . substr($cleaned, 8);
        case 13:
            return '+' . substr($cleaned, 0, 2) . ' (' . substr($cleaned, 2, 2) . ') ' . substr($cleaned, 4, 5) . '-' . substr($cleaned, 9);
        default:
            return substr($cleaned, 0, 4) . '-' . substr($cleaned, 4);
    }
}
?>
