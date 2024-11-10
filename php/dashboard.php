<?php
    include('protect.php');
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
?>
<body>
    <div class="container mt-5" style="margin-bottom:10px">
        <form id="date-filter">
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
    <script src="../php/dash.js"></script>
</body>
</html>