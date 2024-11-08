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

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>Altere o preço de aquisição do produto:</h2>
            </div>
            <div class="card-body">
                <!-- Formulário -->
                <form action="?page=gerirProduto" method="POST">
                    <input type="hidden" name="acao" value="editar">
                    <input type="hidden" name="asin" value="<?php print $row->asin;?>">
                    <div class="mb-3">
                        <label for="produto" class="form-label">Produto:</label>
                        <input type="text" name="produto" value="<?php print $row->item_name; ?>" disabled= "" class="form-control" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="seller_sku" class="form-label">Seller SKU:</label>
                        <input type="text" name="seller_sku" value="<?php print $row->seller_sku; ?>" disabled= "" class="form-control" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="asin" class="form-label">asin:</label>
                        <input type="text" name="asin" value="<?php print $row->asin; ?>" disabled= "" class="form-control" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="preco_anunciado" class="form-label">Preço anunciado:</label>
                        <input type="text" name="preco_anunciado" value="<?php print $row->price; ?>" disabled= "" class="form-control" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="quantidade" class="form-label">Quantidade em estoque:</label>
                        <input type="text" name="quantidade" value="<?php print $row->quantity; ?>" disabled= "" class="form-control" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="dh_anuncio" class="form-label">DH Anuncio:</label>
                        <input type="text" name="dh_anuncio" value="<?php print $row->open_date; ?>" disabled= "" class="form-control" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="preco_pago" class="form-label">Preço pago:</label>
                        <input type="text" name="preco_pago" value="<?php print $row->acquisition_value; ?>" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Atualizar dados <i class="fas fa-paper-plane"></i></button>
                </form>
            </div>
        </div>
    </div>


</body>
</html>