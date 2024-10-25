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
    <title>Alterar credenciais</title>
</head>
<body>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <h1>Preencha o formulário:</h1>
    <form action="EfetCredAPI.php" method="POST">
        <p>
            <label>Loja:</label>
            <select name="nm_loja" required>
                <option value>Selecione</option>
                <option value="KO-Star">KO-Star</option>
                <option value="Ergan">Ergan</option>
            </select>
        </p>
        <p>
            <input type="text" placeholder="Client ID" name="client_id" required/>
        </p>
        <p>
            <input type="text" placeholder="Client Secret" name="client_s" required/>
        </p>
        <p>
            <input type="text" placeholder="Refresh Token" name="r_token" required/>
        </p>
        <p>
            <button type="submit">Atualizar credenciais</button>
        </p>
    </form>
    <p><a href="painel.php">Voltar para o painel</a></p>
</body>
</html>