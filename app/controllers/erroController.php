<?php
namespace app\controllers;
require '../core/controller.php';
use core\Controller;

class erroController extends Controller{
    public function index(){
        //chama um model
        //--------------
        //chama uma view
        $this->carregarTemplate('erro');

        //faz a junção de backend com frontend
    }
}
?>