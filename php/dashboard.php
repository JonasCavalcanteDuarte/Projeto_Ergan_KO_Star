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
    <script src="https://cdn.jsdelivr.net/npm/chart.js" defer></script>
        <form id="date-filter">
            <label for="start-date">Data Inicial:</label>
            <input type="date" id="start-date" name="start_date" value="<?php echo $primeiroDiaFormatado?>" required>
            
            <label for="end-date">Data Final:</label>
            <input type="date" id="end-date" name="end_date" value="<?php echo $ultimoDiaFormatado?>" required>
            
            <button type="submit">Filtrar</button>
        </form>
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <canvas id="myChart"></canvas>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <canvas id="myChart2"></canvas>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <canvas id="myChart3"></canvas>
                    </div>
                </div>
            </div>
        </div>
    <script src="../php/dash.js"></script>
</body>
</html>