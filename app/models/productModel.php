<?php
namespace app\models;
require_once '../core/conexao.php';
use core\conexao;
use PDO;

class ProductModel {

    public function getTotalProducts() {
        $db = conexao::getInstance();
        if(!isset($_SESSION['user_id'])){
            session_start();
        }

        if($_SESSION['loja_acesso'] == 'Ambas'){
            $stmt = $db->query("SELECT COUNT(*) FROM products");
        }else{
            $stmt = $db->prepare("SELECT COUNT(*) FROM products WHERE nm_loja = :loja_acesso");
            $stmt->bindParam(':loja_acesso', $_SESSION['loja_acesso']);
            $stmt->execute();
        }
        return $stmt->fetchColumn();
    }

    public function getProducts($limit, $offset) {
        $db = conexao::getInstance();
        if(!isset($_SESSION['user_id'])){
            session_start();
        }

        if($_SESSION['loja_acesso'] == 'Ambas'){
            $stmt = $db->prepare("SELECT A.nm_loja,A.item_name,A.seller_sku,A.asin,A.price,A.quantity,A.open_date,B.acquisition_value,B.dh_last_update,B.alterado_por FROM products A LEFT JOIN products_acquisition_value B ON A.nm_loja = B.loja AND A.seller_sku = B.seller_sku LIMIT :limit OFFSET :offset");
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
        }else{
            $stmt = $db->prepare("SELECT A.nm_loja,A.item_name,A.seller_sku,A.asin,A.price,A.quantity,A.open_date,B.acquisition_value,B.dh_last_update,B.alterado_por FROM products A LEFT JOIN products_acquisition_value B ON A.nm_loja = B.loja AND A.seller_sku = B.seller_sku WHERE nm_loja = :loja_acesso LIMIT :limit OFFSET :offset");
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt->bindParam(':loja_acesso', $_SESSION['loja_acesso']);
            $stmt->execute();
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getProductInfo($sku) {
        $db = conexao::getInstance();
        $stmt = $db->prepare("SELECT A.nm_loja,A.item_name,A.seller_sku,A.asin,A.price,A.quantity,A.open_date,B.acquisition_value FROM products A LEFT JOIN products_acquisition_value B ON A.nm_loja = B.loja AND A.seller_sku = B.seller_sku WHERE A.seller_sku = :sku LIMIT 1");
        $stmt->bindParam(':sku', $sku);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function updateProduct($sku,$acquisition_value) {
        $userData = $_SESSION['user_name']." ID: ".$_SESSION['user_id'];
        $db = conexao::getInstance();
        $dados_old = self::getProductInfo($sku);
        
        $stmt = $db->prepare("UPDATE products_acquisition_value SET acquisition_value = :acquisition_value, dh_last_update = now(),alterado_por = :alterado_por WHERE seller_sku = :sku");
        $stmt->bindParam(':sku', $sku);
        $stmt->bindParam(':acquisition_value', $acquisition_value);
        $stmt->bindParam(':alterado_por', $userData);
        $stmt->execute();

        $rowCount = $stmt->rowCount();


        //Registra a ação no log do banco de dados
        $oldDados_log = $dados_old['seller_sku'].'|'.$dados_old['acquisition_value'];
        $acquisition_value = str_replace("|", "", $acquisition_value);
        $acquisition_value = trim($acquisition_value);
        $newDados_log = $sku.'|'.$acquisition_value;
        if(!isset($_SESSION['user_id'])){
            session_start();
        }
        $nm_loja = $_SESSION['loja_acesso'];

        $stmt = $db->prepare('INSERT INTO log_users (id_user, nm_user, acao, alvo, old_values, new_values, dh_execucao, nm_loja) VALUES (:id_user, :nm_user, "Editar", "Produto", :old_values, :new_values, now(), :nm_loja)');
        $stmt->bindParam(':id_user', $_SESSION['user_id']);
        $stmt->bindParam(':nm_user', $_SESSION['user_name']);
        $stmt->bindParam(':old_values', $oldDados_log);
        $stmt->bindParam(':new_values', $newDados_log);
        $stmt->bindParam(':nm_loja', $nm_loja);
        $stmt->execute();

        return $rowCount;
    }

}