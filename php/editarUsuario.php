<?php
include('protect.php');
include('conexao.php');

$query = "SELECT id,nome,email,senha FROM users WHERE id = ".$_REQUEST['id']." LIMIT 1";
$sql_exec = $conn->query($query) or die("Falha na execução da consualta sql: ".$conn->error);
$row = $sql_exec->fetch_object();

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/style_php.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <title>Editar usuário</title>
</head>
<body>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <h1>Altere as informações:</h1>
    <form action="?page=gerirUsuario" method="POST">
        <input type="hidden" name="acao" value="editar">
        <input type="hidden" name="id" value="<?php print $row->id;?>">
        <p>
            <label for="">Nome:</label>
            <input type="text" name="nome" value="<?php print $row->nome; ?>">
        </p>
        <p>
            <label for="">E-mail:</label>
            <input type="email" name="email" value="<?php print $row->email; ?>">
        </p>
        <p>
            <label for="">Senha:</label>
            <input type="password" name="senha" placeholder="Digite a senha atual ou uma nova senha" required>
        </p>
        <p>
            <button type="submit">Atualizar dados</button>
        </p>
    </form>
</body>
</html>