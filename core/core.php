<?php
Class Core{
    public function __construct(){
        $this->run();
    }

    public function run(){
        if(isset($_GET['pag'])){
            $url = $_GET['pag'];
        }
    
        if(!empty($url)){
            $url = explode('/', $url);
            if($url[0]=='public'){
                array_shift($url);
                $controller = $url[0].'Controller';
                $controllerns = 'app\\controllers\\'.$url[0].'Controller';
                $caminho = '../app/controllers/'.$controller.'.php';
            }else{
                $controller = $url[0].'Controller';
                $controllerns = 'app\\controllers\\'.$url[0].'Controller';
                $caminho = '../app/controllers/'.$controller.'.php';
            }
            array_shift($url);
            if(isset($url[0]) && !empty($url[0])){
                $metodo = $url[0];
                array_shift($url);
            }else{
                $metodo = 'index';
            }
            if(count($url) > 0){
                $parametros = $url;
            }else{
                $parametros = array();
            }

            // Função que converte o erro de inclusão em exceção
            function handleRequireError($errno, $errstr) {
                throw new Exception($errstr, $errno);
            }

            try {
                // Define o manipulador de erro para lançar exceções
                set_error_handler('handleRequireError');
                
                require_once $caminho;
                
                // Restaura o manipulador de erros padrão após a inclusão
                restore_error_handler();
            } catch (Exception $e) {
                // Tratamento da exceção
                $caminho = '../app/controllers/erroController.php';
                require_once $caminho;
                $controller = 'erroController';
                $controllerns = 'app\\controllers\\erroController';
                $metodo = 'index';
            }

            if(!class_exists($controllerns) && !method_exists($controllerns, $metodo)){
                $caminho = '../app/controllers/erroController.php';
                $controller = 'erroController';
                $metodo = 'index';
            }
        }else{
            $caminho = '../app/controllers/homeController.php';
            require_once $caminho;
            $controllerns = 'app\\controllers\\homeController';
            $controller = 'homeController';
            $metodo = 'index';
            $parametros = array();
        }
        $c = new $controllerns;
        call_user_func_array(array($c,$metodo),$parametros);
    }
}
?>