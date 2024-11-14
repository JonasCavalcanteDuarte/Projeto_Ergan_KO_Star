<?php
//include('protect.php');
//include('protect_nivel.php');
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./assets/css/style_php.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="../public/assets/images/logo_browser.png">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- chartjs-plugin-datalabels -->
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
    <title>Painel</title>
</head>
<body>
    <script src="./assets/js/bootstrap.bundle.min.js"></script>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="./painel">Painel de controle</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link active" aria-current="page" href="./painel">Painel</a>
                <a class="nav-link" href="./cadastro">Cadastrar usuário</a>
                <a class="nav-link" href="?page=listaUser">Gerenciar acessos</a>
                <a class="nav-link" href="?page=altCredAMZ">Alterar credenciais API Amazon</a>
                <a class="nav-link" href="?page=listarProdutos">Gerenciar Produtos</a>
                <a class="nav-link" href="?page=dashboard">Dashboard</a>
                <a class="nav-link" href="./login/logout">Sair</a>
                <!-- <a class="nav-link disabled" aria-disabled="true" href="#">Alterar credenciais API Amazon</a> -->
            </div>
            </div>
        </div>
    </nav>
    <div class="container">
        <?php
            $this->carregarViewNoTemplate($nomeView, $dadosModel);
        ?>
    </div>

    <div class="footer">
            <p>© 2024 Todos os direitos reservados | Ergan & KO-Star</p>
    </div>
</body>
</html>