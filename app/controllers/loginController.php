<?php
namespace app\controllers;
require_once '../app/models/userModel.php';
use app\models\userModel;

class LoginController {

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['senha'] ?? '';

            $user = userModel::authenticate($email, $password);

            if ($user) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['nome'];
                $_SESSION['nivel'] = $user['nivel'];
                $_SESSION['time']=time();
                header('Location: ../painel');
                exit;
            } else {
                $error = 'Usuário ou senha incorretos!';
                require '../app/views/home.php';
            }
        } else {
            require '../app/views/home.php';
        }
    }

    public function logout() {
        // Destruir a sessão ao fazer logout
        session_start();
        session_destroy();
        header('Location: ../home');
        exit;
    }
}