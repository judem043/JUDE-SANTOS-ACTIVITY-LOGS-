<?php  
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$host = "localhost";
$user = "root";
$password = "";
$dbname = "SANTOS";
$dsn = "mysql:host={$host};dbname={$dbname}";

$pdo = new PDO($dsn,$user,$password);
$pdo->exec("SET time_zone = '+08:00';");

?>