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
    <title>Alterar credenciais</title>
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
                <form action="EfetCredAPI.php" method="POST">
                    <input type="hidden" name="acao" value="cadastrar">
                    <div class="mb-3">
                        <label for="nm_loja" class="form-label">Loja:</label>
                        <select name="nm_loja" class="form-control" required>
                            <option value>Selecione</option>
                            <option value="KO-Star">KO-Star</option>
                            <option value="Ergan">Ergan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="client_id" class="form-label">Client ID:</label>
                        <input type="text" placeholder="Client ID" name="client_id" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="client_s" class="form-label">Client Secret:</label>
                        <input type="text" placeholder="Client Secret" name="client_s" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="r_token" class="form-label">Refresh Token:</label>
                        <input type="text" placeholder="Refresh Token" name="r_token" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Atualizar credenciais <i class="fas fa-paper-plane"></i></button>
                </form>
            </div>
        </div>
    </div>


</body>
</html>