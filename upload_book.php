<?php
session_start();
include 'href/php/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $descricao = $_POST['descricao'];
    $file = $_FILES['arquivo'];

    // Verificar se todos os campos foram preenchidos
    if (!empty($titulo) && !empty($autor) && !empty($descricao) && !empty($file['name'])) {
        // Definir caminho para salvar o arquivo
        $destino = 'href/uploads/' . basename($file['name']);

        if (move_uploaded_file($file['tmp_name'], $destino)) {
            // Inserir os dados na tabela
            $sql = "INSERT INTO livros (titulo, autor, descricao, arquivo) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);

            // Vincular parâmetros
            $stmt->bind_param("ssss",$titulo, $autor,$descricao, $file['name']);

            if ($stmt->execute()) {
                echo "Livro adicionado com sucesso!";
            } else {
                echo "Erro ao adicionar o livro: " . $stmt->error;
            }

            // Fechar a declaraçãostmt->close();
        } else {
            echo "Erro ao fazer o upload do arquivo.";
        }
    } else {
        echo "Por favor, preencha todos os campos e envie um arquivo válido.";
    }
}
?>


<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Upload de Livros</title>
  <!-- Link do Materialize CSS -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="href/css/materialize.min.css" rel="stylesheet">
</head>
<body>
    <nav>
        
        <div class="teal nav-wrapper">
            <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons"><svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 24 24"><path fill="currentColor" d="M3 18v-2h18v2zm0-5v-2h18v2zm0-5V6h18v2z"/></svg></i></a>
            <a href="#" class="brand-logo">TESTE</a>
            
            <ul class="left hide-on-med-and-down">
                <li><a href="#">Link 1</a></li>
                <li><a href="#">Link 2</a></li>
                <li><a href="#">Link 3</a></li>
            </ul>
            
        </div>
    </nav>

    <ul class="sidenav" id="mobile-demo">
        <h1>SIGAAP</h1>
        <li><a href="home.php">Home</a></li>
        <li class="current"><a href="dashboard.html">Dashboard</a></li>
        <li><a href="upload_book.php">Upload Book</a></li>
        <li><a href="books.php">Read Book</a></li>
        <li><a href="chat/index.php">Comunidade</a></li>
                    
        </div>
    </ul>
  <div class="container">
    <h4 class="center-align">Upload de Livros</h4>
    <div class="card">
      <div class="card-content">
        <form method="POST" enctype="multipart/form-data">
          <!-- Título -->
          <div class="input-field">
            <input id="titulo" type="text" name="titulo" required>
            <label for="titulo">Título do Livro</label>
          </div>

          <!-- Autor -->
          <div class="input-field">
            <input id="autor" type="text" name="autor" required>
            <label for="autor">Autor</label>
          </div>

          <!-- Descrição -->
          <div class="input-field">
            <textarea id="descricao" class="materialize-textarea" name="descricao"></textarea>
            <label for="descricao">Descrição</label>
          </div>

          <!-- Categoria -->
          <div class="input-field">
            <select name="categoria" required>
              <option value="" disabled selected>Selecione uma categoria</option>
              <option value="tecnologia">Tecnologia</option>
              <option value="educacao">Educação</option>
              <option value="literatura">Literatura</option>
              <option value="romance">Romance</option>
              <option value="fantasia">Fantasia</option>
            </select>
            <label>Categoria</label>
          </div>

          <!-- Upload do Arquivo -->
          <div class="file-field input-field">
            <div class="btn">
              <span>Arquivo</span>
              <input type="file" name="arquivo" required>
            </div>
            <div class="file-path-wrapper">
              <input class="file-path validate" type="text" placeholder="Selecione o arquivo do livro">
            </div>
          </div>

          <!-- Botão de Enviar -->
          <div class="center-align">
            <button class="btn waves-effect waves-light" type="submit" name="action">
              Enviar
              <i class="material-icons right">send</i>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Scripts do Materialize -->
  <script src="href/js/materialize.min.js"></script>
  <script>
    // Inicialização de componentes
    document.addEventListener('DOMContentLoaded', function () {
      var elems = document.querySelectorAll('select');
      M.FormSelect.init(elems);
    });
  </script>
 
  <script>
      document.addEventListener('DOMContentLoaded', function() {
      var elems = document.querySelectorAll('.sidenav');
      var instances = M.Sidenav.init(elems);
        });
  </script>
</body>
</html>
