<?php
//include('protect.php');
//include('protect_nivel.php');
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../public/assets/css/style_php.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="../public/assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="../public/assets/images/logo_browser.png">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- chartjs-plugin-datalabels -->
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
    <title>Painel</title>
</head>
<body>
    <script src="../public/assets/js/bootstrap.bundle.min.js"></script>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="../public/painel">Painel de controle</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link active" aria-current="page" href="../public/painel">Painel</a>
                <a class="nav-link" href="../public/cadastro">Cadastrar usuário</a>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Gerenciar
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="../public/user">Acessos</a>
                            <a class="dropdown-item" href="../public/credAPI">Credenciais API's</a>
                            <a class="dropdown-item" href="../public/product">Produtos</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Logs
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="../public/userLog">Log de usuários</a>
                            <a class="dropdown-item" href="#">Log API's</a>
                        </div>
                    </li>
                </ul>
                <a class="nav-link" href="../public/dashboard">Dashboard</a>
                <a class="nav-link" href="../public/login/logout">Sair</a>
                <!-- <a class="nav-link disabled" aria-disabled="true" href="#">Alterar credenciais API Amazon</a> -->
            </div>
            </div>
        </div>
    </nav>
    <div class="container">
        <?php
            $this->carregarViewNoTemplate($nomeView, $dadosModel, $dadosPaginacao);
        ?>
    </div>

    <div class="footer">
            <p>© 2024 Todos os direitos reservados | Ergan & KO-Star</p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <!-- Link para o JavaScript do Bootstrap (necessário para o dropdown funcionar) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>