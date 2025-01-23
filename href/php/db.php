<?php
$host = '127.0.0.1';
$user = 'root';
$password = 'root';
$db = 'biblioteca';

$conn = new mysqli($host, $user, $password, $db);

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}
?>