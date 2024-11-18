<?php
namespace public;

require_once '../app/controllers/productController.php';
use app\controller\productController;
require_once '../app/controllers/editProductController.php';
use app\controller\editProductController;


if ($_GET['pagina'] === 'gerenciar_produtos') {
    $controllerns = 'app\\controllers\\productController';
    $c = new $controllerns;
    $c->index($_GET['page']);
}elseif($_GET['pagina'] === 'editar_produto'){
    $controllerns = 'app\\controllers\\editProductController';
    $c = new $controllerns;
    $c->index($_GET['sku']);
}

?>