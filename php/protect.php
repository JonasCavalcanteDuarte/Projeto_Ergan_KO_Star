<?php
if(!isset($_SESSION['user_id'])){
    session_start();
}

if ( !isset($_SESSION['user_id']) or !isset($_SESSION['user_name']) or !isset($_SESSION['time']) ) {

    session_destroy();
    $_SESSION=array();
    die("Você não pode acessar essa página pois não esta logado!<p><a href=\"../index.php\">Fazer Login</p>");
}


?>