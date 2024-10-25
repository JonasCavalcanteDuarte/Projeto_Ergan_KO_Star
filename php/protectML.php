<?php

if(!isset($_SESSION['user_id'])){
    session_start();
    if(isset($_SESSION['user_id'])){
        header('Location: ./php/painel.php'); 
    }
}
?>