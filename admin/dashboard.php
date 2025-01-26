<?php
session_start();
include_once('../href/php/db.php'); // Inclui o arquivo de conexão com o banco de dados

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit;
}

if ($_SESSION['role'] !== 'admin') {
    echo "Acesso negado. Esta área é restrita a administradores.";
    exit;
}


// Consultar a tabela 'livros'
$sql = "SELECT * FROM livros";
$result = $conn->query($sql);

// Verificar se a consulta retornou resultados
if (!$result) {
    die("Erro na consulta: " . $conn->error);
}
?>


<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestão de Livros</title>
  <!-- Link do Materialize CSS -->
  <link href="../href/css/materialize.min.css" rel="stylesheet">
  <!-- Ícones do Materialize -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
        <li><a href="../home.php">Home</a></li>
        <li class="current"><a href="../dashboard.php">Dashboard</a></li>
        <li><a href="../upload_book.html">Upload Book</a></li>
        <li><a href="books.php">Read Book</a></li>
        <li><a href="../chat/index.html">Comunidade</a></li>
                    
        </div>
    </ul>
  <div class="container">
    <h4 class="center-align">Gestão de Livros</h4>

    <!-- Botão para adicionar livro -->
    <div class="right-align">
      <a class="btn waves-effect waves-light modal-trigger" href="#modalAdicionarLivro">
        <i class="material-icons left">library_add</i>Adicionar Livro
      </a>
    </div>

    <!-- Tabela de Livros -->
    <table class="highlight responsive-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Título</th>
          <th>Autor</th>
          <th>Categoria</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <!-- Exemplo de livro -->
        <tr>
          <?php if ($result->num_rows > 0): ?>
          <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
              <td><?= htmlspecialchars($row['id']); ?></td>
              <td><?= htmlspecialchars($row['titulo']); ?></td>
              <td><?= htmlspecialchars($row['autor']); ?></td>
              <td><?= htmlspecialchars($row['categoria']); ?></td>
              <td>
          <td>
            <a class="btn-small waves-effect waves-light blue modal-trigger" href="#modalEditarLivro">
              <i class="material-icons">edit</i>
            </a>
            <a class="btn-small waves-effect waves-light red">
              <i class="material-icons">delete</i>
            </a>
          </td>
        </tr>
        <?php endwhile; ?>
        <?php else: ?>
          <tr>
            <td colspan="5" class="center-align">Nenhum livro encontrado</td>
          </tr>
        <?php endif; ?>
        <!-- Outros livros podem ser listados aqui -->
      </tbody>
    </table>

    <!-- Modal Adicionar Livro -->
    <div id="modalAdicionarLivro" class="modal">
      <div class="modal-content">
        <h5>Adicionar Livro</h5>
        <form action="#" method="POST">
          <div class="input-field">
            <input id="titulo" type="text" name="titulo" required>
            <label for="titulo">Título do Livro</label>
          </div>
          <div class="input-field">
            <input id="autor" type="text" name="autor" required>
            <label for="autor">Autor</label>
          </div>
          <div class="input-field">
            <input id="categoria" type="text" name="categoria" required>
            <label for="categoria">Categoria</label>
          </div>
          <div class="input-field">
            <textarea id="descricao" class="materialize-textarea" name="descricao"></textarea>
            <label for="descricao">Descrição</label>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn waves-effect waves-light">
              Salvar
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- Modal Editar Livro -->
    <div id="modalEditarLivro" class="modal">
      <div class="modal-content">
        <h5>Editar Livro</h5>
        <form action="#" method="POST">
          <div class="input-field">
            <input id="edit_titulo" type="text" name="titulo" required>
            <label for="edit_titulo">Título do Livro</label>
          </div>
          <div class="input-field">
            <input id="edit_autor" type="text" name="autor" required>
            <label for="edit_autor">Autor</label>
          </div>
          <div class="input-field">
            <input id="edit_categoria" type="text" name="categoria" required>
            <label for="edit_categoria">Categoria</label>
          </div>
          <div class="input-field">
            <textarea id="edit_descricao" class="materialize-textarea" name="descricao"></textarea>
            <label for="edit_descricao">Descrição</label>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn waves-effect waves-light">
              Atualizar
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Scripts do Materialize -->
  <script src="../href/js/materialize.min.js"></script>
  <script>
      document.addEventListener('DOMContentLoaded', function() {
      var elems = document.querySelectorAll('.sidenav');
      var instances = M.Sidenav.init(elems);
        });
    </script>
  <script>
    // Inicialização de Modals
    document.addEventListener('DOMContentLoaded', function () {
      var elems = document.querySelectorAll('.modal');
      M.Modal.init(elems);
    });
  </script>
</body>
</html>
