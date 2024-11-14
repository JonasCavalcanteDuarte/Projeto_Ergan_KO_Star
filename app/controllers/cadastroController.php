<?php
namespace app\controllers;
require '../core/controller.php';
use core\Controller;

class cadastroController extends Controller{


    public function __construct() {
        // Iniciar a sessão
        session_start();

        // Verificar se o usuário está logado
        if (!isset($_SESSION['user_id'])) {
            // Caso não esteja logado, redirecionar para a página de login
            header('Location: ../public/home');
            exit;
        }
    }

    public function index(){
        //chama um model
        //--------------
        //chama uma view
        $this->carregarTemplate('cadastro');

        //faz a junção de backend com frontend
    }
}
?>