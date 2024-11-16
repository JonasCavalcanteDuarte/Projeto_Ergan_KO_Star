<?php
namespace core;

// Iniciar a sessão
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    // Caso não esteja logado, redirecionar para a página de login
    header('Location: ../public/home');
    exit;
}elseif(isset($_SESSION['user_id'])){
    // Caso esteja logado, redirecionar para a página de login
    header('Location: ../public/painel');
    exit;
}

?>