
<?php
require_once __DIR__ . '/conf.php';
$conn = new mysqli(
    $conf['db_host'],
    $conf['db_user'],
    $conf['db_pass'],
    $conf['db_name']
);
if ($conn->connect_error) {
    die('Database connection failed: ' . $conn->connect_error);
}
?>