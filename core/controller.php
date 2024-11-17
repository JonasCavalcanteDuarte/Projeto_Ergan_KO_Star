<?php
namespace core;

class Controller{
    public $dados;
    public $paginacao;
    public function __construct(){
        $this->dados=array();
        $this->paginacao=array();
    }

    public function carregarTemplate($nomeView, $dadosModel = array(), $dadosPaginacao = array()){
        $this->dados = $dadosModel;
        $this->paginacao = $dadosPaginacao;
        if($nomeView=='home'){
            require '../app/views/template_login.php';
        }elseif($nomeView=='erro'){
            require '../app/views/template_erro.php';
        }else{
            if (!isset($_SESSION['user_id'])) {
                session_start();
            }
            if(file_exists('../app/views/'.$nomeView.'.php')&&$_SESSION['nivel']==1){
                require '../app/views/template_nivelUm.php';
                //echo "<script>console.log('Passei por aqui');</script>";
            }elseif(file_exists('../app/views/'.$nomeView.'.php')&&$_SESSION['nivel']==2){
                require '../app/views/template_nivelDois.php';
                //echo "<script>console.log('Passei por aqui');</script>";
            }else{
                require '../app/views/template_erro.php';
            }
        }
    }

    public function carregarViewNoTemplate($nomeView,$dadosModel = array(), $dadosPaginacao = array()){
        extract($dadosModel);
        extract($dadosPaginacao);
        require '../app/views/'.$nomeView.'.php';
    }
}
?>