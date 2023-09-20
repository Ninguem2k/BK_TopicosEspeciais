<?php
// Define o tipo ServiceOrderOptions
$typeServiceOrderOptions = [
    "recentDate",
    "oldDate",
    "lowerPrice",
    "higherPrice"
];

// Define o enum serviceOrderEnum
$serviceOrderEnum = [
    "recentDate" => ["created_at" => "DESC"],
    "oldDate" => ["created_at" => "ASC"],
    "lowerPrice" => ["price" => "ASC"],
    "higherPrice" => ["price" => "DESC"]
];
?>
