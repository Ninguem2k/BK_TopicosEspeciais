<?php
// Configuração para a fonte de dados (DataSource) usando PDO para PostgreSQL
$typeormDataSourceConfig = [
    'type' => 'pgsql',
    'host' => getenv('POSTGRES_DB_HOST') ?: 'localhost',
    'port' => 5432,
    'dbname' => getenv('POSTGRES_DB_NAME'),
    'user' => getenv('POSTGRES_DB_USER'),
    'password' => getenv('POSTGRES_DB_PASSWORD'),
];

// Caminhos para entidades e migrações dinâmicos dependendo do ambiente
$isDevEnv = getenv('NODE_ENV') === 'dev';
$migrationsPath = $isDevEnv ? 'src/database/migrations/*.ts' : 'dist/database/migrations/*.js';
$entitiesPath = $isDevEnv ? 'src/database/entities/*.ts' : 'dist/database/entities/*.js';

// Exemplo de uso
// Criar uma conexão com o banco de dados usando PDO
try {
    $pdo = new PDO(
        "pgsql:host={$typeormDataSourceConfig['host']};port={$typeormDataSourceConfig['port']};dbname={$typeormDataSourceConfig['dbname']}",
        $typeormDataSourceConfig['user'],
        $typeormDataSourceConfig['password']
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conexão bem-sucedida!";
} catch (PDOException $e) {
    echo "Erro de conexão: " . $e->getMessage();
}
?>
