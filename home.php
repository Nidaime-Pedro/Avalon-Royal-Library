<?php
require 'href/php/db.php'; // Arquivo de conexão com o banco de dados

// Consultar a tabela 'livros'
$sql = "SELECT * FROM livros";
$result = $conn->query($sql);

// Verificar se a consulta retornou resultados
if (!$result) {
    die("Erro na consulta: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca Virtual</title>
    <link href="href/css/materialize.min.css" rel="stylesheet">
    <script defer src="href/js/materialize.min.js"></script>
</head>
<body class="blue-grey lighten-5">
    
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
        <h3 class="center">Livros Disponíveis</h3>
        <div class="row">
            <?php while ($livro = mysqli_fetch_assoc($result)): ?>
                <div class='col s12 m4'>
                    <div class='card'>
                        <div class='card-image'>
                            <img src="<?php echo htmlspecialchars($livro['capa']); ?>" alt="Capa de <?php echo htmlspecialchars($livro['titulo']); ?>">
                        </div>
                        <div class="card-content">
                            <a href="read_books.php?id=<?php echo $livro['id']; ?>"><span class="card-title"><?php echo htmlspecialchars($livro['titulo']); ?></span></a>
                            <p><strong>Autor:</strong> <?php echo htmlspecialchars($livro['autor']); ?></p>
                        </div>
                        <div class="card-action">
                            <a href="#modal<?php echo $livro['id']; ?>" class="btn blue modal-trigger">Ver detalhes</a>
                        </div>
                    </div>
                </div>

                <!-- Modal para detalhes do livro -->
                <div id="modal<?php echo $livro['id']; ?>" class="modal">
                    <div class="modal-content">
                        <h4><?php echo htmlspecialchars($livro['titulo']); ?></h4>
                        <p><strong>Autor:</strong> <?php echo htmlspecialchars($livro['autor']); ?></p>
                        <p><?php echo htmlspecialchars($livro['descricao']); ?></p>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="modal-close waves-effect waves-green btn-flat">Fechar</a>
                    </div>
                </div>
            
            <?php endwhile; ?>
        </div>
    </div>

    <footer class="page-footer blue">
        <div class="container">
            <div class="row">
                <div class="col s12">
                    <h5 class="white-text">Biblioteca Virtual</h5>
                    <p class="grey-text text-lighten-4">Acesse os melhores livros na nossa plataforma.</p>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Inicializar os modais do Materialize
        document.addEventListener('DOMContentLoaded', function() {
            var modals = document.querySelectorAll('.modal');
            M.Modal.init(modals);
        });
    </script>
    <script src="href/js/materialize.min.js"></script>
  <script>
      document.addEventListener('DOMContentLoaded', function() {
      var elems = document.querySelectorAll('.sidenav');
      var instances = M.Sidenav.init(elems);
        });
    </script>
</body>
</html>
