<?php
namespace core;

require_once '../app/controllers/userController.php';
use app\controller\userController;

if ($_GET['pagina'] === 'gerenciar_users') {
    $controllerns = 'app\\controllers\\userController';
    $metodo = 'index';
    $parametros = array();
    $c = new $controllerns;
    $c->index($_GET['page']);
}

?>