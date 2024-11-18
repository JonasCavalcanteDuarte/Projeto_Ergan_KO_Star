<?php
namespace app\models;
require_once '../core/conexao.php';
use core\conexao;
use PDO;

class ProductModel {

    public function getTotalProducts() {
        $db = conexao::getInstance();
        $stmt = $db->query("SELECT COUNT(*) FROM products");
        return $stmt->fetchColumn();
    }

    public function getProducts($limit, $offset) {
        $db = conexao::getInstance();
        $stmt = $db->prepare("SELECT A.nm_loja,A.item_name,A.seller_sku,A.asin,A.price,A.quantity,A.open_date,B.acquisition_value,B.dh_last_update,B.alterado_por FROM products A LEFT JOIN products_acquisition_value B ON A.nm_loja = B.loja AND A.seller_sku = B.seller_sku LIMIT :limit OFFSET :offset");
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
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
        $stmt = $db->prepare("UPDATE products_acquisition_value SET acquisition_value = :acquisition_value, dh_last_update = now(),alterado_por = :alterado_por WHERE seller_sku = :sku");
        $stmt->bindParam(':sku', $sku);
        $stmt->bindParam(':acquisition_value', $acquisition_value);
        $stmt->bindParam(':alterado_por', $userData);
        $stmt->execute();

        $rowCount = $stmt->rowCount();

        return $rowCount;
    }

}