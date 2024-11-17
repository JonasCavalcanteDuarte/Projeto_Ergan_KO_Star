<?php
require_once '../app/controllers/LoginController.php';
use app\controllers\loginController;
$controller = new LoginController();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./assets/css/style.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="./assets/images/logo_browser.png">
    <title>Login Ergan | KO-Star</title>
</head>
<body>
    <script src="./assets/js/bootstrap.bundle.min.js"></script>
    <div class="login-container">
        <div class="row">
            <div class="col mt-5">
                <h1>Acesse sua conta</h1>
                <?php if (isset($password)) { echo "<p style='color:red;'>$email</p>"; } ?>
                <form action="./login/login" method="POST">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">E-mail:</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu E-mail" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Senha:</label>
                        <input type="password" class="form-control" name="senha" id="password" placeholder="Digite sua senha" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Entrar</button>
                </form>
            </div>
        </div>
        <div class="footer-text">
            <!--<p><small><a href="#">Esqueceu a senha?</a></small></p>-->
            <div id="emailHelp" class="form-text">Não compartilhe seus dados de acesso com outras pessoas.</div>
        </div>
    </div>
</body>
</html>