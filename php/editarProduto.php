<?php
include('protect.php');
include('conexao.php');

$query = "SELECT A.*, B.acquisition_value FROM products A LEFT JOIN products_acquisition_value B ON A.nm_loja = B.loja AND A.seller_sku = B.seller_sku WHERE A.asin = '".$_REQUEST['asin']."' LIMIT 1";
$sql_exec = $conn->query($query) or die("Falha na execução da consualta sql: ".$conn->error);
$row = $sql_exec->fetch_object();

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/style_php.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <title>Editar produto:</title>
</head>
<body>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <h1>Altere as informações:</h1>
    <form action="?page=gerirProduto" method="POST">
        <input type="hidden" name="acao" value="editar">
        <input type="hidden" name="asin" value="<?php print $row->asin;?>">
        <p>
            <label for="">Produto:</label>
            <input type="text" name="produto" value="<?php print $row->item_name; ?>" disabled= "" readonly>
        </p>
        <p>
            <label for="">Seller SKU:</label>
            <input type="text" name="seller_sku" value="<?php print $row->seller_sku; ?>" disabled= "" readonly>
        </p>
        <p>
            <label for="">asin:</label>
            <input type="text" name="asin" value="<?php print $row->asin; ?>" disabled= "" readonly>
        </p>
        <p>
            <label for="">Preço anunciado:</label>
            <input type="text" name="preco_anunciado" value="<?php print $row->price; ?>" disabled= "" readonly>
        </p>
        <p>
            <label for="">Quantidade:</label>
            <input type="text" name="quantidade" value="<?php print $row->quantity; ?>" disabled= "" readonly>
        </p>
        <p>
            <label for="">DH Anuncio:</label>
            <input type="text" name="dh_anuncio" value="<?php print $row->open_date; ?>" disabled= "" readonly>
        </p>
        <p>
            <label for="">Preço pago:</label>
            <input type="text" name="preco_pago" value="<?php print $row->acquisition_value; ?>">
        </p>
        <p>
            <button type="submit">Atualizar dados</button>
        </p>
    </form>
</body>
</html>