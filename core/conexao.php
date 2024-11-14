<?php
namespace Core;

use PDO;
use PDOException;
require '../vendor/autoload.php';
use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__. '/../');
$dotenv->load();

class Conexao{
    private static $instancia;
    private $connection;

    private function __construct(){
        if(!isset(self::$instancia)){
            $dbname = $_ENV['DATABASE'];
            $host = $_ENV['HOST'];
            $user=$_ENV['USER'];
            $pass=$_ENV['PASS'];

            try {
                $this->connection = new PDO('mysql:dbname='.$dbname.';host='.$host,$user,$pass);
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Erro na conexão: " . $e->getMessage());
            }
            
        }
    }
    
    public static function getInstance(){
        if (self::$instancia == null) {
            self::$instancia = new Conexao();
        }
        return self::$instancia->connection;
    }
}
?>