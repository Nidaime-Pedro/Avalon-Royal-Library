<?php
session_start();

// Configuração do banco de dados
$dbHost = "127.0.0.1";
$dbUsername = "root";
$dbPassword = "root";
$dbName = "biblioteca";

// Conexão com o banco de dados
$connection = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if ($connection->connect_error) {
    die("Erro de conexão: " . $connection->connect_error);
}

// Captura os dados do formulário
$email = $_POST['email'];
$password = $_POST['password'];

// Consulta SQL para buscar o usuário
$sql = "SELECT * FROM usuarios WHERE email = ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    // Verificar se a senha está correta
    if (password_verify($password, $user['senha'])) {
        // Salvar informações na sessão
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['role'] = 'user';

        // Redirecionar para a tela de usuário
        header("Location: ../../dashboard.php");
        exit;
    } else {
        echo "Senha incorreta!";
    }
} else {
    echo "Usuário não encontrado!";
}

$stmt->close();
$connection->close();
?>
