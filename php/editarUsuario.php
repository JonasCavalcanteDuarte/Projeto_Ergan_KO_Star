<?php
include('protect.php');
include('conexao.php');

$query = "SELECT id,nome,email,senha FROM users WHERE id = ".$_REQUEST['id']." LIMIT 1";
$sql_exec = $conn->query($query) or die("Falha na execução da consualta sql: ".$conn->error);
$row = $sql_exec->fetch_object();

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/style_php.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <title>Editar usuário</title>
</head>
<body>
    <script src="../js/bootstrap.bundle.min.js"></script>


    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>Preencha o formulário:</h2>
            </div>
            <div class="card-body">
                <!-- Formulário -->
                <form action="?page=gerirUsuario" method="POST">
                    <input type="hidden" name="acao" value="editar">
                    <input type="hidden" name="id" value="<?php print $row->id;?>">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome:</label>
                        <input type="text" name="nome" value="<?php print $row->nome; ?>" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail:</label>
                        <input type="email" name="email" value="<?php print $row->email; ?>" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="senha" class="form-label">Senha:</label>
                        <input type="password" name="senha" placeholder="Digite a senha atual ou uma nova senha" name="r_token" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Atualizar dados <i class="fas fa-paper-plane"></i></button>
                </form>
            </div>
        </div>
    </div>


    
</body>
</html>