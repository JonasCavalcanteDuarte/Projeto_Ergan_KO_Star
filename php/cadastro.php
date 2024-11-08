<?php
include('protect.php');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/style_php.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <title>Cadastrar usuário</title>
</head>
<body>
    <script src="../js/bootstrap.bundle.min.js"></script>


    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>Cadastre um usuário:</h2>
            </div>
            <div class="card-body">
                <!-- Formulário -->
                <form action="?page=gerirUsuario" method="POST">
                    <input type="hidden" name="acao" value="cadastrar">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome:</label>
                        <input type="text" name="nome" class="form-control" placeholder="Digite o nome" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail:</label>
                        <input type="email" name="email" class="form-control" placeholder="Digite o e-mail" required>
                    </div>
                    <div class="mb-3">
                        <label for="senha" class="form-label">Senha:</label>
                        <input type="password" name="senha" class="form-control" placeholder="Digite a senha" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Cadastrar <i class="fas fa-paper-plane"></i></button>
                </form>
            </div>
        </div>
    </div>



</body>
</html>