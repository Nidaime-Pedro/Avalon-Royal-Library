<?php
session_start();
include_once('../href/php/db.php'); // Inclui o arquivo de conexão com o banco de dados

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit;
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT nome FROM usuarios WHERE id = $user_id";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $user_name = $row['nome'];
} else {
    $user_name = 'Usuário desconhecido'; // Valor padrão caso o usuário não seja encontrado
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat em Tempo Real</title>
    <link rel="stylesheet" href="../href/css/materialize.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container">
        <h4>Chat em Tempo Real</h4>
        <div id="chat" style="height: 300px; overflow-y: scroll; border: 1px solid #ccc; padding: 10px;">
            <!-- Mensagens aparecerão aqui -->
        </div>
        <form id="form">
            <!-- Preenche o campo com o nome do usuário -->
            <input id="usuario" type="text" placeholder="Seu nome" required readonly value="<?= htmlspecialchars($user_name, ENT_QUOTES, 'UTF-8'); ?>" />
            <input id="mensagem" type="text" placeholder="Digite sua mensagem" autocomplete="off" required />
            <button class="btn">Enviar</button>
        </form>
    </div>
    <script>
        // Função para buscar mensagens a cada 1 segundo
        function carregarMensagens() {
            $.get('receber.php', function(data) {
                $('#chat').html(data); // Exibe as mensagens no elemento #chat
                $('#chat').scrollTop($('#chat')[0].scrollHeight); // Rolagem automática
            });
        }

        // Envio de mensagens com nome do usuário
        $('#form').submit(function(e) {
            e.preventDefault();
            const usuario = $('#usuario').val();
            const mensagem = $('#mensagem').val();

            $.post('enviar.php', { usuario: usuario, texto: mensagem }, function() {
                $('#mensagem').val('');
                carregarMensagens();
            });
        });

        // Atualizar mensagens automaticamente
        setInterval(carregarMensagens, 1000);
        carregarMensagens(); // Carregar mensagens ao iniciar
    </script>
</body>
</html>