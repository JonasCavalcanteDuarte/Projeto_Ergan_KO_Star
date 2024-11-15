<?php
namespace app\controllers;
require '../core/controller.php';
use core\Controller;
require_once '../app/models/userModel.php';
use app\models\userModel;

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

    public function cadastrar(){
        $nome = str_replace(array("#","'",";","*"),'',$_POST['nome']);
        $email = str_replace(array("#","'",";","*"),'',$_POST['email']);
        $senha = str_replace(array("#","'",";","*"),'',$_POST['senha']);
        $nivel = str_replace(array("#","'",";","*"),'',$_POST['nivel']);
        
        $result = userModel::create_user($nome, $email, $senha, $nivel);

        print "<script>alert('Cadastrado com sucesso!');</script>";
        print "<script>location.href='../painel';</script>";

        //header('Location: ../painel');
        exit;

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