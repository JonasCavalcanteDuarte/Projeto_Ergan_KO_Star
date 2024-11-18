<?php
namespace app\controllers;
require '../core/controller.php';
use core\Controller;
require_once '../app/models/productModel.php';
use app\models\productModel;

class productController  extends Controller{
    private $productModel;

    public function __construct() {
        $this->productModel = new productModel();
    }

    public function index($page_number = '') {
        // Define o número de registros por página
        $records_per_page = 20;

        // Pega o número da página (ou 1 se não estiver definido)
        if($page_number!=''){
            $page = $page_number;
        }else{
            $page = 1;
        }
        //$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

        // Calcula o deslocamento para a consulta
        $offset = ($page - 1) * $records_per_page;

        // Pega o total de registros
        $total_records = $this->productModel->getTotalProducts();

        // Calcula o número de páginas
        $total_pages = ceil($total_records / $records_per_page);

        // Pega os usuários para a página atual
        $products = $this->productModel->getProducts($records_per_page, $offset);

        $paginas=array();

        $paginas['page'] = $page;
        $paginas['total_pages'] = $total_pages;

        // Redireciona para a view e passa os dados
        $this->carregarTemplate('gerenciar_produtos',$products, $paginas);
        
    }
}
?>