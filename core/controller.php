<?php
namespace core;

class Controller{
    public $dados;
    public function __construct(){
        $this->dados=array();
    }

    public function carregarTemplate($nomeView,$dadosModel = array()){
        $this->dados = $dadosModel;
        if($nomeView=='home'){
            require '../app/views/template_login.php';
        }elseif($nomeView=='painel'){
            require '../app/views/template.php';
        }elseif($nomeView=='erro'){
            require '../app/views/template_erro.php';
        }else{
            if(file_exists('../app/views/'.$nomeView.'.php')){
                require '../app/views/template.php';
            }else{
                require '../app/views/template_erro.php';
            }
        }
    }

    public function carregarViewNoTemplate($nomeView,$dadosModel = array()){
        extract($dadosModel);
        require '../app/views/'.$nomeView.'.php';
    }
}
?>