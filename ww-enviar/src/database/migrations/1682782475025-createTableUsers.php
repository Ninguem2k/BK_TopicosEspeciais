<?php
// Configuração do banco de dados (substitua com suas próprias configurações)
$dbHost = 'localhost';
$dbName = 'my_database';
$dbUser = 'my_username';
$dbPassword = 'my_password';

try {
    $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUser, $dbPassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro de conexão com o banco de dados: " . $e->getMessage());
}

// Migração: Criação da tabela "users"
try {
    $sql = "
    CREATE TABLE users (
        id CHAR(36) PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        email VARCHAR(255) UNIQUE NOT NULL,
        phone VARCHAR(255) NOT NULL,
        password VARCHAR(255) NOT NULL,
        cep VARCHAR(255) NOT NULL,
        avatar VARCHAR(255),
        avatar_url VARCHAR(255),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    $pdo->exec($sql);
    echo "Tabela 'users' criada com sucesso.\n";
} catch (PDOException $e) {
    die("Erro ao criar a tabela 'users': " . $e->getMessage());
}

// Para desfazer a criação da tabela "users" (rollback)
// $sql = "DROP TABLE users";
// $pdo->exec($sql);
// echo "Tabela 'users' removida.\n";
?>
