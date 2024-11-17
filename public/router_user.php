<?php
namespace public;

require_once '../app/controllers/userController.php';
use app\controller\userController;
require_once '../app/controllers/editUserController.php';
use app\controller\editUserController;


if ($_GET['pagina'] === 'gerenciar_acessos') {
    $controllerns = 'app\\controllers\\userController';
    $c = new $controllerns;
    $c->index($_GET['page']);
}elseif($_GET['pagina'] === 'editar_usuario'){
    $controllerns = 'app\\controllers\\editUserController';
    $c = new $controllerns;
    $c->index($_GET['userId']);
}elseif($_GET['pagina'] === 'excluir_usuario'){
    $controllerns = 'app\\controllers\\editUserController';
    $c = new $controllerns;
    $c->deletarUsuario($_GET['userId']);
}

?>