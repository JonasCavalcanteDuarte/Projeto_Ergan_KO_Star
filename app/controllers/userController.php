<?php
namespace app\controllers;
require '../core/controller.php';
use core\Controller;
require_once '../app/models/userModel.php';
use app\models\userModel;

class userController  extends Controller{
    private $userModel;

    public function __construct() {
        $this->userModel = new userModel();
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
        $total_records = $this->userModel->getTotalUsers();

        // Calcula o número de páginas
        $total_pages = ceil($total_records / $records_per_page);

        // Pega os usuários para a página atual
        $users = $this->userModel->getUsers($records_per_page, $offset);

        $paginas=array();

        $paginas['page'] = $page;
        $paginas['total_pages'] = $total_pages;

        // Redireciona para a view e passa os dados
        $this->carregarTemplate('gerenciar_acessos',$users, $paginas);
        
    }
}
?>