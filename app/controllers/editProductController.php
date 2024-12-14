<?php
namespace app\controllers;
use core\Controller;
require_once '../app/models/productModel.php';
use app\models\productModel;

class editProductController extends Controller{


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

    public function editarProduto(){
        $sku = str_replace(array("#","'",";","*"),'',$_POST['sku']);
        $nm_loja = str_replace(array("#","'",";","*"),'',$_POST['nm_loja']);
        $acquisition_value = str_replace(array("#","'",";","*"),'',$_POST['acquisition_value']);
        
        $result = productModel::updateProduct($sku, $nm_loja, $acquisition_value);

        if($result == 1){
            echo "<script>alert('Valor pago atualizado com sucesso!');</script>";
            echo "<script>location.href='../product';</script>";
            exit();
        }else{
            echo "<script>alert('Nenhum registro foi alterado, tente novamente mais tarde.');</script>";
            echo "<script>location.href='../product';</script>";
            exit();
        }
    }

    public function index($sku){
        //chama um model
        $result = productModel::getProductInfo($sku);

        //chama uma view
        $this->carregarTemplate('editarProduto',$result);

        //faz a junção de backend com frontend
    }
}
?>