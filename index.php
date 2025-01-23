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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="href/css/materialize.min.css" rel="stylesheet">
    <style>
        .hero-section {
            background: url('https://source.unsplash.com/1600x900/?library,books') center/cover no-repeat;
            color: white;
            padding: 60px 20px;
            text-align: center;
        }
        .card .card-image img {
            height: 180px;
            object-fit: cover;
        }
    </style>
</head>
<body class="blue-grey lighten-5">

    <!-- Navbar -->
    <nav class="blue">
        <div class="nav-wrapper container">
            <a href="#!" class="brand-logo">Biblioteca</a><br>
            <ul class="right hide-on-med-and-down">
                <li><a href="login.html">Login</a></li>
                <li><a href="cadastro.html">Cadastro</a></li>
                <li><a href="#livros">Livros</a></li>
                <li><a href="#contato">Contato</a></li>
            </ul>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero-section">
        <h1>Bem-vindo à Biblioteca Virtual</h1>
        <p>Explore um vasto acervo de livros e materiais de estudo de qualquer lugar.</p>
        <a href="cadastro.html" class="btn-large waves-effect waves-light green">Cadastre-se Agora</a>
    </div>

    <!-- Destaques -->
    <div class="container">
        <h3 class="center">Livros em Destaque</h3>
        <div class="row">
            <?php while ($livro = mysqli_fetch_assoc($result)): ?>
            <div class="col s12 m6 l4">
                <div class="card">
                    <div class="card-image">
                        <img src="https://source.unsplash.com/400x300/?book">
                        <span class="card-title"><?php echo htmlspecialchars($livro['titulo']); ?></span>
                    </div>
                    <div class="card-content">
                        <p><?php echo htmlspecialchars($livro['descricao']); ?></p>
                    </div>
                    <div class="card-action">
                        <a href="#">Detalhes</a>
                    </div>
                </div>
            </div>
            
            <?php endwhile; ?>
        </div>
    </div>

    <!-- Contato -->
    <div class="container" id="contato">
        <h3 class="center">Fale Conosco</h3>
        <form action="enviar_mensagem.php" method="POST">
            <div class="row">
                <div class="input-field col s12 m6">
                    <input id="nome" name="nome" type="text" required>
                    <label for="nome">Nome</label>
                </div>
                <div class="input-field col s12 m6">
                    <input id="email" name="email" type="email" required>
                    <label for="email">Email</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <textarea id="mensagem" name="mensagem" class="materialize-textarea" required></textarea>
                    <label for="mensagem">Mensagem</label>
                </div>
            </div>
            <button class="btn waves-effect waves-light blue" type="submit">Enviar</button>
        </form>
    </div>

    <!-- Footer -->
    <footer class="page-footer blue">
        <div class="container">
            <div class="row">
                <div class="col s12 m6">
                    <h5>Sobre a Biblioteca</h5>
                    <p>Uma plataforma dedicada a facilitar o acesso ao conhecimento por meio de livros e materiais educativos.</p>
                </div>
                <div class="col s12 m4 offset-m2">
                    <h5>Links</h5>
                    <ul>
                        <li><a class="white-text" href="index.php">Login</a></li>
                        <li><a class="white-text" href="cadastro.php">Cadastro</a></li>
                        <li><a class="white-text" href="#livros">Livros</a></li>
                        <li><a class="white-text" href="#contato">Contato</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-copyright">
            <div class="container center">
                © 2025 Biblioteca Virtual - Todos os direitos reservados
            </div>
        </div>
    </footer>

    <script src="href/js/materialize.min.js"></script>
</body>
</html>
