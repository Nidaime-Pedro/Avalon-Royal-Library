<?php
$pdo = new PDO('mysql:host=127.0.0.1;dbname=chat', 'root', 'root'); // Ajuste as credenciais do banco de dados

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['texto'], $_POST['usuario'])) {
    $texto = htmlspecialchars($_POST['texto']); // Evita injeção de HTML
    $usuario = htmlspecialchars($_POST['usuario']); // Evita injeção de HTML
    $stmt = $pdo->prepare("INSERT INTO mensagens (usuario, texto) VALUES (:usuario, :texto)");
    $stmt->execute(['usuario' => $usuario, 'texto' => $texto]);
}
?>