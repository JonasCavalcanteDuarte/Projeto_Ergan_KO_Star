<?php
    include('protect.php');
    $timezone = new DateTimeZone('America/Sao_Paulo');
    $agora = new DateTime('now', $timezone);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel = "stylesheet" href="../css/style.css">
    <title>Dashboard</title>
</head>
<body>
    <form id="date-filter">
        <label for="start-date">Data Inicial:</label>
        <input type="date" id="start-date" name="start-date" value="<?php echo $agora->format('Y-m-d')?>">
        
        <label for="end-date">Data Final:</label>
        <input type="date" id="end-date" name="end-date" value="<?php echo $agora->format('Y-m-d')?>">
        
        <button type="submit">Filtrar</button>
    </form>

    <div class="container">
        <div class="row">
            <div id="chartBarVendas" style="width: 800px; height: 500px;"></div>
        </div>

        <div class="row">
            <div class="col">
                <canvas id="myChart" width="200" height="50"></canvas>
            </div>
        </div>
    </div>
    <script src="../php/dash.js"></script>
</body>
</html>