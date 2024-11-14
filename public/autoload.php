<?php
spl_autoload_register(function($nome_arquivo){
    if(file_exists('../app/controllers/'.$nome_arquivo.'.php')){
        require '../app/controllers/'.$nome_arquivo.'.php';
    }elseif(file_exists('../app/models/'.$nome_arquivo.'.php')){
        require '../app/models/'.$nome_arquivo.'.php';
    }elseif(file_exists('../core/'.$nome_arquivo.'.php')){
        require '../core/'.$nome_arquivo.'.php';
    }
});
?>