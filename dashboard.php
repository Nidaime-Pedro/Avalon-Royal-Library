<?php
session_start();
include_once('href/php/db.php'); // Inclui o arquivo de conexão com o banco de dados

// Verificar se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
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
  <link href="href/css/materialize.min.css" rel="stylesheet">
  <!-- Ícones do Materialize -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <nav>
        
        <div class="teal nav-wrapper">
            <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons"><svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 24 24"><path fill="currentColor" d="M3 18v-2h18v2zm0-5v-2h18v2zm0-5V6h18v2z"/></svg></i></a>
            <a href="#" class="brand-logo">SIGAAP</a>
            
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
        <li class="current"><a href="dashboard.php">Dashboard</a></li>
        <li><a href="upload_book.php">Upload Book</a></li>
        <li><a href="books.php">Read Book</a></li>
        <li><a href="chat/index.php">Comunidade</a></li>
                    
        </div>
    </ul>
    
    
  <div class="container">
    <h4 class="center-align">Gestão de Livros</h4>

    <!-- Tabela de Livros -->
    <table class="highlight responsive-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Título</th>
          <th>Autor</th>
          <th>Categoria</th>
          <th>Arquivo</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($result->num_rows > 0): ?>
          <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
              <td><?= htmlspecialchars($row['id']); ?></td>
              <td><?= htmlspecialchars($row['titulo']); ?></td>
              <td><?= htmlspecialchars($row['autor']); ?></td>
              <td><?= htmlspecialchars($row['categoria']); ?></td>
              <td>
                <a href="href/uploads/<?= htmlspecialchars($row['arquivo']); ?>" target="_blank">Download</a>
              </td>
            </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr>
            <td colspan="5" class="center-align">Nenhum livro encontrado</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

  <script src="href/js/materialize.min.js"></script>
  <script>
      document.addEventListener('DOMContentLoaded', function() {
      var elems = document.querySelectorAll('.sidenav');
      var instances = M.Sidenav.init(elems);
        });
    </script>
</body>
</html>
