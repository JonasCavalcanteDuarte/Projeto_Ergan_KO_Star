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
    <title>Cadastrar usuário</title>
</head>
<body>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <h1>Cadastre um usuário:</h1>
    <form action="?page=gerirUsuario" method="POST">
        <input type="hidden" name="acao" value="cadastrar">
        <p>
            <label for="">Nome:</label>
            <input type="text" name="nome">
        </p>
        <p>
            <label for="">E-mail:</label>
            <input type="email" name="email">
        </p>
        <p>
            <label for="">Senha:</label>
            <input type="password" name="senha">
        </p>
        <p>
            <button type="submit">Cadastrar</button>
        </p>
    </form>
</body>
</html>