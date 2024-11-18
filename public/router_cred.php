<?php
namespace public;

require_once '../app/controllers/credAPIController.php';
use app\controller\credAPIController;
require_once '../app/controllers/editCredController.php';
use app\controller\editCredController;


if ($_GET['pagina'] === 'gerenciar_API') {
    $controllerns = 'app\\controllers\\credAPIController';
    $c = new $controllerns;
    $c->index($_GET['page']);
}elseif($_GET['pagina'] === 'editar_credencial'){
    $controllerns = 'app\\controllers\\editCredController';
    $c = new $controllerns;
    $c->index($_GET['nm_loja']);
}

?>