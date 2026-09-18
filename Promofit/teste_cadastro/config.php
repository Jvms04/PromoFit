<?php
$DB_SERVER = getenv('PROMOFIT_DB_HOST') ?: 'localhost';
$DB_USERNAME = getenv('PROMOFIT_DB_USERNAME');
$DB_PASSWORD = getenv('PROMOFIT_DB_PASSWORD');
$DB_NAME = getenv('PROMOFIT_DB_NAME');

if (!$DB_USERNAME || !$DB_PASSWORD || !$DB_NAME) {
    http_response_code(500);
    exit('Configuração de banco de dados ausente.');
}

try {
    $pdo = new PDO(
        "mysql:host={$DB_SERVER};dbname={$DB_NAME}",
        $DB_USERNAME,
        $DB_PASSWORD
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    error_log('Falha na conexão com o banco de dados.');
    http_response_code(500);
    exit('Não foi possível conectar ao banco de dados.');
}
?>