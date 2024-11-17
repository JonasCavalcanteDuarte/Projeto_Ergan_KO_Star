<?php
namespace app\controllers;
use core\Controller;
require_once '../app/models/userModel.php';
use app\models\userModel;

class editUserController extends Controller{


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

    public function editar(){
        $userId = str_replace(array("#","'",";","*"),'',$_POST['id']);
        $nome = str_replace(array("#","'",";","*"),'',$_POST['nome']);
        $email = str_replace(array("#","'",";","*"),'',$_POST['email']);
        $senha = str_replace(array("#","'",";","*"),'',$_POST['senha']);
        $nivel = str_replace(array("#","'",";","*"),'',$_POST['nivel']);
        
        $result = userModel::updateUser($userId, $nome, $email, $senha, $nivel);

        print "<script>alert('Editado com sucesso!');</script>";
        print "<script>location.href='../user';</script>";
        exit;

    }

    public function index($userId){
        //chama um model
        $result = userModel::getUserInfo($userId);

        //chama uma view
        $this->carregarTemplate('editarUsuario',$result);

        //faz a junção de backend com frontend
    }
}
?>