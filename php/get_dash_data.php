<?php
    include('protect.php');
    include('conexao.php');
    // Definir o fuso horário para 'America/Sao_Paulo'
    date_default_timezone_set('America/Sao_Paulo');

    // Criar um objeto DateTime para a data atual
    $hoje = new DateTime();

    // Obter o primeiro dia do mês atual
    $primeiroDia = new DateTime($hoje->format('Y-m-01')); // Formato 'Y-m-01' define o primeiro dia do mês

    // Obter o último dia do mês atual
    $ultimoDia = new DateTime($hoje->format('Y-m-t')); // 't' retorna o último dia do mês

    // Formatar as datas para o formato 'YYYY-MM-DD'
    $primeiroDiaFormatado = $primeiroDia->format('Y-m-d');
    $ultimoDiaFormatado = $ultimoDia->format('Y-m-d');
    
    if(isset($_GET['start_date'])&&isset($_GET['end_date'])){
        $query = "SELECT DATE_FORMAT(purchase_date, '%Y-%m-%d') AS dt, COUNT(DISTINCT amazon_order_id) AS QTD_PEDIDOS FROM order_details WHERE DATE_FORMAT(purchase_date, '%Y-%m-%d') >= '".$_GET['start_date']."' AND DATE_FORMAT(purchase_date, '%Y-%m-%d') <= '".$_GET['end_date']."' GROUP BY DATE_FORMAT(purchase_date, '%Y-%m-%d') ORDER BY 1;";
        $sql_exec = $conn->query($query) or die("Falha na execução da consualta sql: ".$conn->error);
    }else{
        $query = "SELECT DATE_FORMAT(purchase_date, '%Y-%m-%d') AS dt, COUNT(DISTINCT amazon_order_id) AS QTD_PEDIDOS FROM order_details WHERE DATE_FORMAT(purchase_date, '%Y-%m-%d') >= '".$primeiroDiaFormatado."' AND DATE_FORMAT(purchase_date, '%Y-%m-%d') <= '".$ultimoDiaFormatado."' GROUP BY DATE_FORMAT(purchase_date, '%Y-%m-%d') ORDER BY 1;";
        $sql_exec = $conn->query($query) or die("Falha na execução da consualta sql: ".$conn->error);
    }
    
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
