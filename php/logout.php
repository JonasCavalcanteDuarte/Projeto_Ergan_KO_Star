<?php
if(!isset($_SESSION['user_id'])){
    session_start();
}

session_destroy();
$_SESSION=array();

header('Location: ../index.php');
?>