<?php
// Dados de conexão ao banco
$dbHost = "127.0.0.1"; 
$dbUsername = "root";  
$dbPassword = "root";      
$dbName = "biblioteca";   

// Conexão ao banco de dados
$connection = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Verificar se há erro na conexão
if ($connection->connect_errno) {
    die("Erro de conexão: " . $connection->connect_error);
}

// Recebendo os dados do formulário
$nome = $_POST['nome'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Criptografia da senha


// Criar o comando SQL para inserir os dados
$sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
$stmt = $connection->prepare($sql);

if ($stmt) {
    // Associar os valores ao comando SQL
    $stmt->bind_param("sss", $nome, $email, $password);

    // Executar o comando
    if ($stmt->execute()) {
        header("Location: login.html");
        echo "<script>alert('Usuário cadastrado com sucesso!')</script>";
    } else {
        echo "<script>alert('Erro ao cadastrar usuário: '" . $stmt->error.")</script>";
    }

    $stmt->close();
} else {
    echo "Erro na preparação do comando SQL: " . $connection->error;
}

// Fechar a conexão
$connection->close();
?>