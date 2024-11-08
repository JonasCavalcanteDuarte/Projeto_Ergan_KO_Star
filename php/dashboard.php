<?php
    include('protect.php');
    $timezone = new DateTimeZone('America/Sao_Paulo');
    $agora = new DateTime('now', $timezone);

?>
<body>
    <script src="https://cdn.jsdelivr.net/npm/chart.js" defer></script>
    <script src="../php/dash.js"></script>
        <form id="date-filter">
            <label for="start-date">Data Inicial:</label>
            <input type="date" id="start-date" name="start-date" value="<?php echo $agora->format('Y-m-d')?>">
            
            <label for="end-date">Data Final:</label>
            <input type="date" id="end-date" name="end-date" value="<?php echo $agora->format('Y-m-d')?>">
            
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