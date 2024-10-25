<?php
//verifica se o usuario já esta logado para evitar multiplos logins e sessoes.
include('./php/protectML.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <title>Painel</title>
</head>
<body>
    <script src="js/bootstrap.bundle.min.js"></script>
    <div class="container">
        <div class="row">
            <div class="col mt-5">
                <h1>Acesse sua conta</h1>
                <form action="./php/validaLogin.php" method="POST">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">E-mail:</label>
                        <input type="email" class="form-control"  name="email" required>
                        <div id="emailHelp" class="form-text">Não compartilhe seus dados de acesso com outras pessoas.</div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Senha:</label>
                        <input type="password" class="form-control" name="senha" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Entrar</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>