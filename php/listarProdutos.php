<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/style_php.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <title>Gerenciar produtos</title>
</head>
<body>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <h1>Lista de produtos</h1>
<?php
    include('conexao.php');
    $pagina = 1;
    if(isset($_GET['pagina'])){
        $pagina = filter_input(INPUT_GET, "pagina", FILTER_VALIDATE_INT);
    }
    if(!$pagina){
        $pagina = 1;
    }

    $limite = 10;
    $inicio = ($pagina * $limite) - $limite;

    $query = "SELECT A.*, B.acquisition_value FROM products A LEFT JOIN products_acquisition_value B ON A.nm_loja = B.loja AND A.seller_sku = B.seller_sku ORDER BY A.quantity DESC LIMIT $inicio,$limite";
    $sql_exec = $conn->query($query) or die("Falha na execução da consualta sql: ".$conn->error);
    $sql_cnt = $sql_exec->num_rows;
    
    $queryqtdpg = "SELECT * FROM products";
    $sql_execqtdpg = $conn->query($queryqtdpg) or die("Falha na execução da consualta sql: ".$conn->error);
    $qtd_pg = $sql_execqtdpg->num_rows;

    $paginas = ceil($qtd_pg / $limite);

    mysqli_close($conn);
    if($sql_cnt > 0){
        print "<table class='table table-hover table-striped'>";
        print "<tr>";
        print "<th>Loja</th>";
        print "<th>Produto</th>";
        print "<th>Seller SKU</th>";
        print "<th>asin</th>";
        print "<th>Preço anunciado</th>";
        print "<th>Quantidade</th>";
        print "<th>DH Anuncio</th>";
        print "<th>Preço pago</th>";
        print "<th>Ações</th>";
        print "</tr>";
        while($row = $sql_exec->fetch_object()){
            print "<tr>";
            print "<td>".$row->nm_loja."</td>";
            print "<td>".$row->item_name."</td>";
            print "<td>".$row->seller_sku."</td>";
            print "<td>".$row->asin."</td>";
            print "<td>R$: ".$row->price."</td>";
            print "<td>".$row->quantity."</td>";
            print "<td>".$row->open_date."</td>";
            print "<td>R$: ".$row->acquisition_value."</td>";
            print "<td>
                        <button onclick=\"location.href='?page=editarProduto&asin=".$row->asin."';\"  class='btn btn-success'>Editar</button>
                   </td>";
            print "</tr>";

        }
        print "</table>";

        if($pagina>1){
            print "<a href='painel.php?page=listarProdutos&pagina=1'>Primeira Página </a>";
            print "<a href='painel.php?page=listarProdutos&pagina=".($pagina-1)."'> << </a>";
        }
        echo $pagina;

        if($pagina<$paginas){
            print "<a href='painel.php?page=listarProdutos&pagina=".($pagina+1)."'> >> </a>";
            print "<a href='painel.php?page=listarProdutos&pagina=".$paginas."'> Última Página</a>";
        }

    }else{
        print "<p class='alert alert-danger'>Não encontrou produtos.</p>";
    }
?>

</body>
</html>