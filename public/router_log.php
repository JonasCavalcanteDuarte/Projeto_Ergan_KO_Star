<?php
namespace public;
use app\controller\userLogController;
use app\controller\apiLogController;

if ($_GET['pagina'] === 'visualizar_userLogs') {
    require_once '../app/controllers/userLogController.php';
    $controllerns = 'app\\controllers\\userLogController';
    $c = new $controllerns;
    $c->index($_GET['page']);
}elseif($_GET['pagina'] === 'visualizar_apiLogs'){
    require_once '../app/controllers/apiLogController.php';
    $controllerns = 'app\\controllers\\apiLogController';
    $c = new $controllerns;
    $c->index($_GET['userId']);
}

?>