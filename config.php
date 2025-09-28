<?php
$db_host = getenv('DB_HOST');
$db_port = getenv('DB_PORT');
$db_user = getenv('DB_USER');
$db_pass = getenv('DB_PASS');
$db_name = getenv('DB_NAME');

$db = pg_connect("host=$db_host port=$db_port dbname=$db_name user=$db_user password=$db_pass");

if (!$db) {
    die("Connection failed: " . pg_last_error());
}
?>
