<?php
namespace app\controllers;
require '../core/controller.php';
use core\Controller;
require_once '../app/models/credAPIModel.php';
use app\models\credAPIModel;

class credAPIController  extends Controller{
    private $credAPIModel;

    public function __construct() {
        $this->credAPIModel = new credAPIModel();
    }

    public function index($page_number = '') {
        // Define o número de registros por página
        $records_per_page = 10;

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
        $total_records = $this->credAPIModel->getTotalCreds();

        // Calcula o número de páginas
        $total_pages = ceil($total_records / $records_per_page);

        // Pega os usuários para a página atual
        $users = $this->credAPIModel->getCreds($records_per_page, $offset);

        $paginas=array();

        $paginas['page'] = $page;
        $paginas['total_pages'] = $total_pages;

        // Redireciona para a view e passa os dados
        $this->carregarTemplate('gerenciar_API',$users, $paginas);
        
    }
}
?>