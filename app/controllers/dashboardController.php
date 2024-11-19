<?php
namespace app\controllers;
require '../core/controller.php';
use core\Controller;
require_once '../app/models/dashboardModel.php';
use app\models\dashboardModel;

class dashboardController  extends Controller{
    private $dashboardModel;

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

    public function index() {
        // Cria uma instância do modelo
        $this->dashboardModel = new dashboardModel();

        if(isset($_POST['start_date'])&&isset($_POST['end_date'])){
            $dt_ini = $_POST['start_date'];
            $dt_fim = $_POST['end_date'];
            $datasFiltro['start_date'] = $dt_ini;
            $datasFiltro['end_date'] = $dt_fim;
        }else{
            $dt_ini = '';
            $dt_fim = '';
            $datasFiltro['start_date'] = '';
            $datasFiltro['end_date'] = '';
        }


        if(isset($_POST['orderBy'])){
            $orderBy = $_POST['orderBy'];
            $orderByFiltro['orderBy'] = $orderBy;
        }else{
            $orderBy = '';
            $orderByFiltro['orderBy'] = '';
        }
        // Obtém os dados das vendas
        $qtdOrdersData = $this->dashboardModel->qtdOrders($dt_ini,$dt_fim);
        $qtdOrderStatusData = $this->dashboardModel->qtdOrderStatus($dt_ini,$dt_fim);
        $vlOrdersData = $this->dashboardModel->qtdOrderValues($dt_ini,$dt_fim);
        $qtdOrdersPaymentData = $this->dashboardModel->qtdOrderPayment($dt_ini,$dt_fim);
        $qtdProductSalesData = $this->dashboardModel->qtdProductSales($dt_ini,$dt_fim,$orderBy);

        $results['datasFiltro'] = $datasFiltro;
        $results['orderByFiltro'] = $orderByFiltro;
        $results['qtdOrders'] = $qtdOrdersData;
        $results['qtdOrderStatus'] = $qtdOrderStatusData;
        $results['vlOrders'] = $vlOrdersData;
        $results['qtdOrdersPayment'] = $qtdOrdersPaymentData;
        $results['qtdProductSales'] = $qtdProductSalesData;

        // Inclui a view e passa os dados para ela
        $this->carregarTemplate('dashboard',$results);
    }



}
?>