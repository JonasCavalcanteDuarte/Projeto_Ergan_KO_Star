<?php
namespace app\models;
require_once '../core/conexao.php';
use core\conexao;
require_once '../app/functions/dateFunctions.php';
use app\functions\dateFunctions;

use PDO;

class dashboardModel {
    private $primeiroDiaFormatado;
    private $ultimoDiaFormatado;

    public function __construct() {
        $datas = dateFunctions::obterDatasDoMes();

        // Formatar as datas para o formato 'YYYY-MM-DD'
        $this->primeiroDiaFormatado = $datas['primeiroDia'];
        $this->ultimoDiaFormatado = $datas['ultimoDia'];
    }

    public function qtdOrders($dt_ini = '',$dt_fim = '') {
        $db = conexao::getInstance();

        if($dt_ini!=''&&$dt_fim != ''){
            $stmt = "";
            $stmt = $db->prepare("SELECT DATE_FORMAT(purchase_date, '%Y-%m-%d') AS dt, COUNT(DISTINCT amazon_order_id) AS QTD_PEDIDOS FROM order_details WHERE DATE_FORMAT(purchase_date, '%Y-%m-%d') >= :dt_ini AND DATE_FORMAT(purchase_date, '%Y-%m-%d') <=:dt_fim GROUP BY DATE_FORMAT(purchase_date, '%Y-%m-%d') ORDER BY 1;");
            $stmt->bindParam(':dt_ini', $dt_ini);
            $stmt->bindParam(':dt_fim', $dt_fim);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }else{
            $stmt = $db->prepare("SELECT DATE_FORMAT(purchase_date, '%Y-%m-%d') AS dt, COUNT(DISTINCT amazon_order_id) AS QTD_PEDIDOS FROM order_details WHERE DATE_FORMAT(purchase_date, '%Y-%m-%d') >= :primeiroDiaFormatado AND DATE_FORMAT(purchase_date, '%Y-%m-%d') <= :ultimoDiaFormatado GROUP BY DATE_FORMAT(purchase_date, '%Y-%m-%d') ORDER BY 1;");
            $stmt->bindParam(':primeiroDiaFormatado', $this->primeiroDiaFormatado);
            $stmt->bindParam(':ultimoDiaFormatado', $this->ultimoDiaFormatado);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        // Cria arrays para armazenar os dados
        $datas = [];
        $qtdPedidos = [];

        // Preenche os arrays com os dados do banco
        foreach ($results as $row) {
            $datas[] = $row['dt'];
            $qtdPedidos[] = $row['QTD_PEDIDOS'];
        }

        // Retorna os dados
        return ['datas' => $datas, 'qtdPedidos' => $qtdPedidos];
    }

    public function qtdOrderStatus($dt_ini = '',$dt_fim = '') {
        $db = conexao::getInstance();

        if($dt_ini!=''&&$dt_fim != ''){
            $stmt = "";
            $stmt = $db->prepare("SELECT order_status, COUNT(DISTINCT amazon_order_id) AS QTD_PEDIDOS FROM order_details WHERE DATE_FORMAT(purchase_date, '%Y-%m-%d') >= :dt_ini AND DATE_FORMAT(purchase_date, '%Y-%m-%d') <= :dt_fim GROUP BY order_status ORDER BY 2 DESC;");
            $stmt->bindParam(':dt_ini', $dt_ini);
            $stmt->bindParam(':dt_fim', $dt_fim);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }else{
            $stmt = $db->prepare("SELECT order_status, COUNT(DISTINCT amazon_order_id) AS QTD_PEDIDOS FROM order_details WHERE DATE_FORMAT(purchase_date, '%Y-%m-%d') >= :primeiroDiaFormatado AND DATE_FORMAT(purchase_date, '%Y-%m-%d') <= :ultimoDiaFormatado GROUP BY order_status ORDER BY 2 DESC;");
            $stmt->bindParam(':primeiroDiaFormatado', $this->primeiroDiaFormatado);
            $stmt->bindParam(':ultimoDiaFormatado', $this->ultimoDiaFormatado);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        // Cria arrays para armazenar os dados
        $order_status = [];
        $qtdPedidos = [];

        // Preenche os arrays com os dados do banco
        foreach ($results as $row) {
            $order_status[] = $row['order_status'];
            $qtdPedidos[] = $row['QTD_PEDIDOS'];
        }

        // Retorna os dados
        return ['order_status' => $order_status, 'qtdPedidos' => $qtdPedidos];
    }
}

?>