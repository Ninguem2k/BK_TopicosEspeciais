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

// Migração: Criação da tabela "services"
try {
    $sql = "
    CREATE TABLE services (
        id CHAR(36) PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        price DECIMAL(10,2) NOT NULL,
        discount INT DEFAULT 0,
        description VARCHAR(255),
        observation VARCHAR(255),
        order INT DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        category_id CHAR(36),
        user_id CHAR(36) NOT NULL
    )";

    $pdo->exec($sql);
    echo "Tabela 'services' criada com sucesso.\n";
} catch (PDOException $e) {
    die("Erro ao criar a tabela 'services': " . $e->getMessage());
}

// Adicionando as chaves estrangeiras
try {
    $sql = "
    ALTER TABLE services
    ADD FOREIGN KEY (category_id)
    REFERENCES categories(id)
    ON DELETE SET NULL";

    $pdo->exec($sql);
    echo "Chave estrangeira para 'category_id' adicionada com sucesso.\n";
} catch (PDOException $e) {
    die("Erro ao adicionar a chave estrangeira para 'category_id': " . $e->getMessage());
}

try {
    $sql = "
    ALTER TABLE services
    ADD FOREIGN KEY (user_id)
    REFERENCES users(id)
    ON DELETE CASCADE";

    $pdo->exec($sql);
    echo "Chave estrangeira para 'user_id' adicionada com sucesso.\n";
} catch (PDOException $e) {
    die("Erro ao adicionar a chave estrangeira para 'user_id': " . $e->getMessage());
}

// Para desfazer a operação (rollback)
// $sql = "DROP TABLE services";
// $pdo->exec($sql);
// echo "Tabela 'services' removida.\n";
?>
