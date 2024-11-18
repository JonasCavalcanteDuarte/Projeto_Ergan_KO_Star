<?php
namespace app\controllers;
use core\Controller;
require_once '../app/models/credAPIModel.php';
use app\models\credAPIModel;

class editCredController extends Controller{


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

    public function editarCred(){
        $nm_loja = str_replace(array("#","'",";","*"),'',$_POST['nm_loja']);
        $client_id = str_replace(array("#","'",";","*"),'',$_POST['client_id']);
        $client_s = str_replace(array("#","'",";","*"),'',$_POST['client_s']);
        $r_token = str_replace(array("#","'",";","*"),'',$_POST['r_token']);
        
        $result = credAPIModel::updateCred($nm_loja, $client_id, $client_s, $r_token);

        if($result == 1){
            echo "<script>alert('Credenciais atualizadas com sucesso!');</script>";
            echo "<script>location.href='../credAPI';</script>";
            exit();
        }else{
            echo "<script>alert('Nenhum registro foi alterado, tente novamente mais tarde.');</script>";
            echo "<script>location.href='../credAPI';</script>";
            exit();
        }
    }

    public function index($nmLoja){
        //chama um model
        $result = credAPIModel::getCredInfo($nmLoja);

        //chama uma view
        $this->carregarTemplate('editarCredAPI',$result);

        //faz a junção de backend com frontend
    }
}
?>