<?php
require_once '../app/functions/dateFunctions.php';
use app\functions\dateFunctions;

$datas = dateFunctions::obterDatasDoMes();

if($dadosModel['datasFiltro']['start_date']!=''){
    $primeiroDiaFormatado = $dadosModel['datasFiltro']['start_date'];
    $ultimoDiaFormatado = $dadosModel['datasFiltro']['end_date'];
}else{
    // Formatar as datas para o formato 'YYYY-MM-DD'
    $primeiroDiaFormatado = $datas['primeiroDia'];
    $ultimoDiaFormatado = $datas['ultimoDia'];
}

//var_dump($dadosModel);
?>
<script src="../public/assets/js/dashboard.js" defer></script>
<!-- Passando os dados para o JavaScript -->
<script type="application/json" id="orderData">
    <?php echo json_encode([
        'datas' => $dadosModel['qtdOrders']['datas'],
        'qtdPedidos' => $dadosModel['qtdOrders']['qtdPedidos']
    ]); ?>
</script>
<!-- Passando os dados para o JavaScript -->
<script type="application/json" id="orderStatusData">
    <?php echo json_encode([
        'order_status' => $dadosModel['qtdOrderStatus']['order_status'],
        'qtdPedidos' => $dadosModel['qtdOrderStatus']['qtdPedidos']
    ]); ?>
</script>
<div class="container mt-5" style="margin-bottom:10px">
        <form id="date-filter" action="../dashboard/index" method="POST">
            <div class="row">
                <div class="col-sm-5 col-md-5 col-lg-5">
                    <div class="form-group">
                        <label for="start-date">Data Inicial:</label>
                        <input type="date" id="start-date" name="start_date" value="<?php echo $primeiroDiaFormatado?>" class="form-control" required>
                    </div>
                </div>
                <div class="col-sm-5 col-md-5 col-lg-5">
                    <div class="form-group">
                        <label for="end-date">Data Final:</label>
                        <input type="date" id="end-date" name="end_date" value="<?php echo $ultimoDiaFormatado?>" class="form-control" required>
                    </div>
                </div>
                <div class="col-sm-2 col-md-2 col-lg-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-10">Filtrar</button>
                </div>
            </div>
        </form>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <canvas id="qtdPedidos"></canvas>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <canvas id="qtdOrderStatus"></canvas>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <canvas id="vlVendas"></canvas>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <canvas id="qtdOrderPayment"></canvas>
                </div>
            </div>
            <div class="row" style="margin-top:50px">
                <div class="col-sm-12">
                    <form id="orderby-filter">
                        <div class="row">
                            <div class="col-sm-10 col-md-10 col-lg-10">
                                <select id= "order_by_clause" name="order_by_clause" class="form-control" required>
                                    <option value="DESC">10 Mais vendidos</option>
                                    <option value="ASC">10 Menos vendidos</option>
                                </select>
                            </div>
                            <div class="col-sm-2 col-md-2 col-lg-2 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary w-10">Filtrar</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-sm-12">
                    <canvas id="qtdProdVendidos"></canvas>
                </div>
            </div>
        </div>
    </div>