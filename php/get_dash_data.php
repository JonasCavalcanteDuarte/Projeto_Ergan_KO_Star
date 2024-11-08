<?php
    include('protect.php');
    include('conexao.php');
    
    $query = "SELECT DATE_FORMAT(purchase_date, '%Y-%m-%d') AS dt, COUNT(DISTINCT amazon_order_id) AS QTD_PEDIDOS FROM order_details GROUP BY DATE_FORMAT(purchase_date, '%Y-%m-%d') ORDER BY 1;";
    $sql_exec = $conn->query($query) or die("Falha na execução da consualta sql: ".$conn->error);
    $dataArray = array();

    while ($linha = mysqli_fetch_assoc($sql_exec)) {
        $dataArray[] = $linha; // Adiciona cada linha ao array
    }

    header('Content-Type: application/json');

    // Processar filtro de data
    $timezone = new DateTimeZone('America/Sao_Paulo');
    $agora = new DateTime('now', $timezone);
    $startDate = isset($_GET['start_date']) ? $_GET['start_date'] : '2024-10-22';
    $endDate = isset($_GET['end_date']) ? $_GET['end_date'] : $agora->format('Y-m-d');

    // Filtra os dados por intervalo de datas
    if ($startDate && $endDate) {
        $filteredData = array_filter($dataArray, function($date) use ($startDate, $endDate) {
            return $date['dt'] >= $startDate && $date['dt'] <= $endDate;
        });
        $categorias = array_column($filteredData, 'dt');
        $valores = array_column($filteredData, 'QTD_PEDIDOS');
    } else {
        //$filteredData = $dataArray;
        $categorias = array_column($dataArray, 'dt');
        $valores = array_column($dataArray, 'QTD_PEDIDOS');
    }

    // Formatar os dados para o gráfico
    echo json_encode([
        'labels' => $categorias,
        'values' => $valores
    ]);
?>
