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
            exit();
        }
    }

    public function editarUsuario(){
        $userId = str_replace(array("#","'",";","*"),'',$_POST['id']);
        $nome = str_replace(array("#","'",";","*"),'',$_POST['nome']);
        $email = str_replace(array("#","'",";","*"),'',$_POST['email']);
        $senha = str_replace(array("#","'",";","*"),'',$_POST['senha']);
        $senha = password_hash($senha, PASSWORD_DEFAULT);
        $nivel = str_replace(array("#","'",";","*"),'',$_POST['nivel']);
        if(isset($_POST['loja'])&&$_POST['loja']!=''){
            $loja = str_replace(array("#","'",";","*"),'',$_POST['loja']);
        }else{
            $loja = 'Ambas';
        }
        
        $result = userModel::updateUser($userId, $nome, $email, $senha, $nivel, $loja);

        if($result == 1){
            echo "<script>alert('Usuário atualizado com sucesso!');</script>";
            echo "<script>location.href='../user';</script>";
            exit();
        }else{
            echo "<script>alert('Nenhum registro foi alterado, tente novamente mais tarde.');</script>";
            echo "<script>location.href='../user';</script>";
            exit();
        }
    }

    public function deletarUsuario($userId){
        $userToDetele = str_replace(array("#","'",";","*"),'',$userId);
        
        $result = userModel::deleteUser($userToDetele);

        if($result == 1){
            echo "<script>alert('Usuário excluido com sucesso!');</script>";
            echo "<script>location.href='./user';</script>";
            exit();
        }else{
            echo "<script>alert('Nenhum registro foi excluido, tente novamente mais tarde.');</script>";
            echo "<script>location.href='./user';</script>";
            exit();
        }

    }

    public function index($userId){
        //chama um model
        $userInfo = userModel::getUserInfo($userId);
        $accessLevels = userModel::getUserAccessLevel();

        $results['userInfo'] = $userInfo;
        $results['accessLevels'] = $accessLevels;


        //chama uma view
        $this->carregarTemplate('editarUsuario',$results);

        //faz a junção de backend com frontend
    }
}
?>