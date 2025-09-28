<?php
// config.php - Postgres via environment variables (PDO)
$db_host = getenv('DB_HOST') ?: 'localhost';
$db_port = getenv('DB_PORT') ?: '5432';
$db_name = getenv('DB_NAME') ?: 'todo';
$db_user = getenv('DB_USER') ?: 'postgres';
$db_pass = getenv('DB_PASS') ?: '';

$dsn = "pgsql:host={$db_host};port={$db_port};dbname={$db_name}";

try {
    $db = new PDO($dsn, $db_user, $db_pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}


