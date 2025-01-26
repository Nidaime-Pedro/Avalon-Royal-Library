<?php
session_start();
include_once('href/php/db.php');

// Verificar se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit;
}

// Verifica se o ID foi fornecido
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID do livro não fornecido.");
}

$id = $_GET['id'];
$sql = "SELECT * FROM livros WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();

// Verifica se o livro existe
if ($result->num_rows > 0) {
    $livro = $result->fetch_assoc();
} else {
    die("Livro não encontrado.");
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($livro['titulo']); ?></title>
    <link rel="stylesheet" href="href/css/materialize.min.css">
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
    <h3><?php echo htmlspecialchars($livro['titulo']); ?></h3>
    <div>
        <object data="href/uploads/<?php echo htmlspecialchars($livro['arquivo']); ?>#toolbar=0" 
        type="application/pdf" 
        width="100%" 
        height="660px">
    Não foi possível exibir o PDF. 
    <a href="href/uploads/<?php echo htmlspecialchars($livro['arquivo']); ?>">Clique aqui para baixar o arquivo.</a>
</object>
    </div>
    <script src="href/js/materialize.min.js"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
      var elems = document.querySelectorAll('.sidenav');
      var instances = M.Sidenav.init(elems);
        });
    </script>
    
    <script>
        // Inicializar os modais do Materialize
        document.addEventListener('DOMContentLoaded', function() {
            var modals = document.querySelectorAll('.modal');
            M.Modal.init(modals);
        });
    </script>
</body>
</html>
