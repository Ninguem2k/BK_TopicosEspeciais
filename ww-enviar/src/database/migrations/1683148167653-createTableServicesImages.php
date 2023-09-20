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

// Migração: Criação da tabela "services_images"
try {
    $sql = "
    CREATE TABLE services_images (
        id CHAR(36) PRIMARY KEY,
        url VARCHAR(255) NOT NULL,
        name VARCHAR(255) NOT NULL,
        file_size INT NOT NULL,
        format VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        service_id CHAR(36) NOT NULL
    )";

    $pdo->exec($sql);
    echo "Tabela 'services_images' criada com sucesso.\n";
} catch (PDOException $e) {
    die("Erro ao criar a tabela 'services_images': " . $e->getMessage());
}

// Adicionando a chave estrangeira
try {
    $sql = "
    ALTER TABLE services_images
    ADD FOREIGN KEY (service_id)
    REFERENCES services(id)
    ON DELETE CASCADE";

    $pdo->exec($sql);
    echo "Chave estrangeira para 'service_id' adicionada com sucesso.\n";
} catch (PDOException $e) {
    die("Erro ao adicionar a chave estrangeira para 'service_id': " . $e->getMessage());
}

// Para desfazer a operação (rollback)
// $sql = "DROP TABLE services_images";
// $pdo->exec($sql);
// echo "Tabela 'services_images' removida.\n";
?>
