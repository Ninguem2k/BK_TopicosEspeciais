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

// Migração: Criação da tabela "categories"
try {
    $sql = "
    CREATE TABLE categories (
        id CHAR(36) PRIMARY KEY,
        name VARCHAR(255) UNIQUE NOT NULL,
        description VARCHAR(255),
        icon VARCHAR(255),
        icon_url VARCHAR(255),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    $pdo->exec($sql);
    echo "Tabela 'categories' criada com sucesso.\n";
} catch (PDOException $e) {
    die("Erro ao criar a tabela 'categories': " . $e->getMessage());
}

// Para desfazer a criação da tabela "categories" (rollback)
// $sql = "DROP TABLE categories";
// $pdo->exec($sql);
// echo "Tabela 'categories' removida.\n";
?>
