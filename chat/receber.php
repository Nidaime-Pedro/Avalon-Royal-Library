<?php
$pdo = new PDO('mysql:host=127.0.0.1;dbname=chat', 'root', 'root'); // Ajuste as credenciais do banco de dados

$stmt = $pdo->query("SELECT usuario, texto, DATE_FORMAT(data_envio, '%H:%i:%s') as hora FROM mensagens ORDER BY id ASC");

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<p><strong>[{$row['hora']}] {$row['usuario']}:</strong> {$row['texto']}</p>";
}
?>