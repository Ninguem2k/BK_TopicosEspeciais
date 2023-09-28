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

// Migração: Criação da tabela "users_tokens"
try {
    $sql = "
    CREATE TABLE users_tokens (
        id CHAR(36) PRIMARY KEY,
        refresh_token VARCHAR(255) NOT NULL,
        expires_date TIMESTAMP NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        user_id CHAR(36) NOT NULL
    )";

    $pdo->exec($sql);
    echo "Tabela 'users_tokens' criada com sucesso.\n";
} catch (PDOException $e) {
    die("Erro ao criar a tabela 'users_tokens': " . $e->getMessage());
}

// Adicionando a chave estrangeira
try {
    $sql = "
    ALTER TABLE users_tokens
    ADD FOREIGN KEY (user_id)
    REFERENCES users(id)
    ON DELETE CASCADE";

    $pdo->exec($sql);
    echo "Chave estrangeira adicionada com sucesso.\n";
} catch (PDOException $e) {
    die("Erro ao adicionar a chave estrangeira: " . $e->getMessage());
}

// Para desfazer a operação (rollback)
// $sql = "DROP TABLE users_tokens";
// $pdo->exec($sql);
// echo "Tabela 'users_tokens' removida.\n";
?>
