<?php
include_once('db.php');

// Verificar se os dados foram enviados via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $descr = $_POST['descricao'];
    $categoria = $_POST['categoria'];
    $file = $_FILES['arquivo'];

    // Verificar se todos os campos foram preenchidos
    if (!empty($titulo) && !empty($autor) && !empty($descr) && !empty($categoria) && !empty($file['name'])) {
        // Definir caminho para salvar o arquivo
        $destino = 'uploads/' . basename($file['name']);

        // Verificar se o upload do arquivo foi bem-sucedido
        if (move_uploaded_file($file['tmp_name'], $destino)) {
            // Inserir os dados na tabela
            $sql = "INSERT INTO livros (titulo, autor, descricao, categoria, arquivo) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);

            // Vincular parâmetros
            $stmt->bind_param("sssss", $titulo, $autor, $descr, $categoria, $file['name']);

            if ($stmt->execute()) {
                echo "Livro adicionado com sucesso!";
            } else {
                echo "Erro ao adicionar o livro: " . $stmt->error;
            }

            // Fechar a declaração
            $stmt->close();
        } else {
            echo "Erro ao fazer o upload do arquivo.";
        }
    } else {
        echo "Por favor, preencha todos os campos e envie um arquivo válido.";
    }
} else {
    echo "Método de requisição inválido.";
}
?>
