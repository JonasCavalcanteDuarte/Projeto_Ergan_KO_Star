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
    
    if($_GET['chart']=='qtdPedidos'){
        if(isset($_GET['start_date'])&&isset($_GET['end_date'])){
            $query = "SELECT DATE_FORMAT(purchase_date, '%Y-%m-%d') AS dt, COUNT(DISTINCT amazon_order_id) AS QTD_PEDIDOS FROM order_details WHERE DATE_FORMAT(purchase_date, '%Y-%m-%d') >= '".$_GET['start_date']."' AND DATE_FORMAT(purchase_date, '%Y-%m-%d') <= '".$_GET['end_date']."' GROUP BY DATE_FORMAT(purchase_date, '%Y-%m-%d') ORDER BY 1;";
            $qtd_pedidos = $conn->query($query) or die("Falha na execução da consualta sql: ".$conn->error);
        }else{
            $query = "SELECT DATE_FORMAT(purchase_date, '%Y-%m-%d') AS dt, COUNT(DISTINCT amazon_order_id) AS QTD_PEDIDOS FROM order_details WHERE DATE_FORMAT(purchase_date, '%Y-%m-%d') >= '".$primeiroDiaFormatado."' AND DATE_FORMAT(purchase_date, '%Y-%m-%d') <= '".$ultimoDiaFormatado."' GROUP BY DATE_FORMAT(purchase_date, '%Y-%m-%d') ORDER BY 1;";
            $qtd_pedidos = $conn->query($query) or die("Falha na execução da consualta sql: ".$conn->error);
        }
        
        $dataArray = array();
    
        while ($linha = mysqli_fetch_assoc($qtd_pedidos)) {
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
    } elseif($_GET['chart']=='qtdOrderStatus'){
        //#######################################################################################################################################################
        if(isset($_GET['start_date'])&&isset($_GET['end_date'])){
            $query = "SELECT order_status, COUNT(DISTINCT amazon_order_id) AS QTD_PEDIDOS FROM order_details WHERE DATE_FORMAT(purchase_date, '%Y-%m-%d') >= '".$_GET['start_date']."' AND DATE_FORMAT(purchase_date, '%Y-%m-%d') <= '".$_GET['end_date']."' GROUP BY order_status ORDER BY 2 DESC;";
            $qtd_pedidos = $conn->query($query) or die("Falha na execução da consualta sql: ".$conn->error);
        }else{
            $query = "SELECT order_status, COUNT(DISTINCT amazon_order_id) AS QTD_PEDIDOS FROM order_details WHERE DATE_FORMAT(purchase_date, '%Y-%m-%d') >= '".$primeiroDiaFormatado."' AND DATE_FORMAT(purchase_date, '%Y-%m-%d') <= '".$ultimoDiaFormatado."' GROUP BY order_status ORDER BY 2 DESC;";
            $qtd_pedidos = $conn->query($query) or die("Falha na execução da consualta sql: ".$conn->error);
        }
        
        $dataArray = array();
    
        while ($linha = mysqli_fetch_assoc($qtd_pedidos)) {
            $dataArray[] = $linha; // Adiciona cada linha ao array
        }
    
        header('Content-Type: application/json');
    
        // Processar filtro de data
        $timezone = new DateTimeZone('America/Sao_Paulo');
        $agora = new DateTime('now', $timezone);
        $startDate = isset($_GET['start_date']) ? $_GET['start_date'] : '2024-10-22';
        $endDate = isset($_GET['end_date']) ? $_GET['end_date'] : $agora->format('Y-m-d');
    
        $categorias = array_column($dataArray, 'order_status');
        $valores = array_column($dataArray, 'QTD_PEDIDOS');
    
        // Formatar os dados para o gráfico
        echo json_encode([
            'labels' => $categorias,
            'values' => $valores
        ]);
    } elseif($_GET['chart']=='qtdProdVendidos'){
        //#######################################################################################################################################################
        if(isset($_GET['start_date'])&&isset($_GET['end_date'])){
            $query = "SELECT sku, SUM(quantity) AS QTD_PRODUTOS FROM order_details WHERE DATE_FORMAT(purchase_date, '%Y-%m-%d') >= '".$_GET['start_date']."' AND DATE_FORMAT(purchase_date, '%Y-%m-%d') <= '".$_GET['end_date']."' GROUP BY sku ORDER BY 2 ".$_GET['order_by_clause']." LIMIT 10;";
            $qtd_pedidos = $conn->query($query) or die("Falha na execução da consualta sql: ".$conn->error);
        }else{
            $query = "SELECT sku, SUM(quantity) AS QTD_PRODUTOS FROM order_details WHERE DATE_FORMAT(purchase_date, '%Y-%m-%d') >= '".$primeiroDiaFormatado."' AND DATE_FORMAT(purchase_date, '%Y-%m-%d') <= '".$ultimoDiaFormatado."' GROUP BY sku ORDER BY 2 ".$_GET['order_by_clause']." DESC LIMIT 10;";
            $qtd_pedidos = $conn->query($query) or die("Falha na execução da consualta sql: ".$conn->error);
        }
        
        $dataArray = array();
    
        while ($linha = mysqli_fetch_assoc($qtd_pedidos)) {
            $dataArray[] = $linha; // Adiciona cada linha ao array
        }
    
        header('Content-Type: application/json');
    
        // Processar filtro de data
        $timezone = new DateTimeZone('America/Sao_Paulo');
        $agora = new DateTime('now', $timezone);
        $startDate = isset($_GET['start_date']) ? $_GET['start_date'] : '2024-10-22';
        $endDate = isset($_GET['end_date']) ? $_GET['end_date'] : $agora->format('Y-m-d');
    
        $categorias = array_column($dataArray, 'sku');
        $valores = array_column($dataArray, 'QTD_PRODUTOS');
    
        // Formatar os dados para o gráfico
        echo json_encode([
            'labels' => $categorias,
            'values' => $valores
        ]);
    } elseif($_GET['chart']=='vlVendas'){
        //#######################################################################################################################################################
        if(isset($_GET['start_date'])&&isset($_GET['end_date'])){
            $query = "SELECT DATE_FORMAT(purchase_date, '%Y-%m-%d') AS dt, CAST( (SUM(item_price)+SUM(shipping_price)) AS DECIMAL(6,2)) AS VL_TOTAL FROM order_details WHERE DATE_FORMAT(purchase_date, '%Y-%m-%d') >= '".$_GET['start_date']."' AND DATE_FORMAT(purchase_date, '%Y-%m-%d') <= '".$_GET['end_date']."' GROUP BY DATE_FORMAT(purchase_date, '%Y-%m-%d') ORDER BY 1;";
            $qtd_pedidos = $conn->query($query) or die("Falha na execução da consualta sql: ".$conn->error);
        }else{
            $query = "SELECT DATE_FORMAT(purchase_date, '%Y-%m-%d') AS dt, CAST( (SUM(item_price)+SUM(shipping_price)) AS DECIMAL(6,2)) AS VL_TOTAL FROM order_details WHERE DATE_FORMAT(purchase_date, '%Y-%m-%d') >= '".$primeiroDiaFormatado."' AND DATE_FORMAT(purchase_date, '%Y-%m-%d') <= '".$ultimoDiaFormatado."' GROUP BY DATE_FORMAT(purchase_date, '%Y-%m-%d') ORDER BY 1;";
            $qtd_pedidos = $conn->query($query) or die("Falha na execução da consualta sql: ".$conn->error);
        }
        
        $dataArray = array();
    
        while ($linha = mysqli_fetch_assoc($qtd_pedidos)) {
            $dataArray[] = $linha; // Adiciona cada linha ao array
        }
    
        header('Content-Type: application/json');
    
        // Processar filtro de data
        $timezone = new DateTimeZone('America/Sao_Paulo');
        $agora = new DateTime('now', $timezone);
        $startDate = isset($_GET['start_date']) ? $_GET['start_date'] : '2024-10-22';
        $endDate = isset($_GET['end_date']) ? $_GET['end_date'] : $agora->format('Y-m-d');
    
        $categorias = array_column($dataArray, 'dt');
        $valores = array_column($dataArray, 'VL_TOTAL');
    
        // Formatar os dados para o gráfico
        echo json_encode([
            'labels' => $categorias,
            'values' => $valores
        ]);
    } elseif($_GET['chart']=='OrderPayment'){
        //#######################################################################################################################################################
        if(isset($_GET['start_date'])&&isset($_GET['end_date'])){
            $query = "SELECT payment_method_details AS pm, COUNT(DISTINCT amazon_order_id) AS QTD_PEDIDOS FROM order_details WHERE DATE_FORMAT(purchase_date, '%Y-%m-%d') >= '".$_GET['start_date']."' AND DATE_FORMAT(purchase_date, '%Y-%m-%d') <= '".$_GET['end_date']."' GROUP BY payment_method_details ORDER BY 2 DESC;";
            $qtd_pedidos = $conn->query($query) or die("Falha na execução da consualta sql: ".$conn->error);
        }else{
            $query = "SELECT payment_method_details AS pm, COUNT(DISTINCT amazon_order_id) AS QTD_PEDIDOS FROM order_details WHERE DATE_FORMAT(purchase_date, '%Y-%m-%d') >= '".$primeiroDiaFormatado."' AND DATE_FORMAT(purchase_date, '%Y-%m-%d') <= '".$ultimoDiaFormatado."' GROUP BY payment_method_details ORDER BY 2 DESC;";
            $qtd_pedidos = $conn->query($query) or die("Falha na execução da consualta sql: ".$conn->error);
        }
        
        $dataArray = array();
    
        while ($linha = mysqli_fetch_assoc($qtd_pedidos)) {
            $dataArray[] = $linha; // Adiciona cada linha ao array
        }
    
        header('Content-Type: application/json');
    
        // Processar filtro de data
        $timezone = new DateTimeZone('America/Sao_Paulo');
        $agora = new DateTime('now', $timezone);
        $startDate = isset($_GET['start_date']) ? $_GET['start_date'] : '2024-10-22';
        $endDate = isset($_GET['end_date']) ? $_GET['end_date'] : $agora->format('Y-m-d');
    
        $categorias = array_column($dataArray, 'pm');
        $valores = array_column($dataArray, 'QTD_PEDIDOS');
    
        // Formatar os dados para o gráfico
        echo json_encode([
            'labels' => $categorias,
            'values' => $valores
        ]);
    }

?>
