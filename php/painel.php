<?php
include('protect.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/style.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <title>Painel</title>
</head>
<body>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="painel.php">Painel de controle</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link active" aria-current="page" href="painel.php">Painel</a>
                <a class="nav-link" href="?page=cadastro">Cadastrar usuário</a>
                <a class="nav-link" href="?page=listaUser">Gerenciar acessos</a>
                <a class="nav-link" href="?page=altCredAMZ">Alterar credenciais API Amazon</a>
                <a class="nav-link" href="?page=listarProdutos">Gerenciar Produtos</a>
                <!-- <a class="nav-link disabled" aria-disabled="true" href="#">Alterar credenciais API Amazon</a> -->
                <a class="nav-link disabled" aria-disabled="true" href="#">Dashboard</a>
                <a class="nav-link" href="logout.php">Sair</a>
            </div>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col mt-5">
                <?php
                    switch(@$_REQUEST["page"]){
                        case "cadastro":
                            include("cadastro.php");
                        break;
                        case "listaUser":
                            include("listaUsuarios.php");
                        break;
                        case "altCredAMZ":
                            include("AltCredAPI.php");
                        break;
                        case "gerirUsuario":
                            include("gerirUsuario.php");
                        break;
                        case "editarUsuario":
                            include("editarUsuario.php");
                        break;
                        case "listarProdutos":
                            include("listarProdutos.php");
                        break;
                        case "editarProduto":
                            include("editarProduto.php");
                        break;

                        default:
                        print "<h1>Bem vindo ao painel, ".$_SESSION['user_name']."</h1>";
                    }
                ?>
            </div>
        </div>
    </div>

    <div class="copy_right">
            <p>© Todos os direitos reservados.</p>
    </div>
</body>
</html>