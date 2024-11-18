<?php
namespace app\models;
require_once '../core/conexao.php';
use core\conexao;
use PDO;

class credAPIModel {

    public function getTotalCreds() {
        $db = conexao::getInstance();
        $stmt = $db->query("SELECT COUNT(*) FROM credenciais_amz");
        return $stmt->fetchColumn();
    }

    public function getCreds($limit, $offset) {
        $db = conexao::getInstance();
        $stmt = $db->prepare("SELECT nm_loja, CONCAT(LEFT(client_id,10),'...',RIGHT(client_id,10)) AS client_id,CONCAT(LEFT(client_secret,10),'...',RIGHT(client_secret,10)) AS client_secret, CONCAT(LEFT(refresh_token,10),'...',RIGHT(refresh_token,10)) AS refresh_token,dh_last_update,alterado_por FROM credenciais_amz LIMIT :limit OFFSET :offset");
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getCredInfo($nmLoja) {
        $db = conexao::getInstance();
        $stmt = $db->prepare("SELECT nm_loja,CONCAT(LEFT(client_id,10),'...',RIGHT(client_id,10)) AS client_id,CONCAT(LEFT(client_secret,10),'...',RIGHT(client_secret,10)) AS client_secret,CONCAT(LEFT(refresh_token,10),'...',RIGHT(refresh_token,10)) AS refresh_token FROM credenciais_amz WHERE nm_loja = :nmLoja LIMIT 1");
        $stmt->bindParam(':nmLoja', $nmLoja);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function updateCred($nmLoja,$client_id, $client_secret, $refresh_token) {
        $userData = $_SESSION['user_name']." ID: ".$_SESSION['user_id'];
        $db = conexao::getInstance();
        $stmt = $db->prepare("UPDATE credenciais_amz SET client_id = :client_id, client_secret= :client_secret, refresh_token = :refresh_token, dh_last_update = now(),alterado_por = :alterado_por WHERE nm_loja = :nmLoja");
        $stmt->bindParam(':client_id', $client_id);
        $stmt->bindParam(':client_secret', $client_secret);
        $stmt->bindParam(':refresh_token', $refresh_token);
        $stmt->bindParam(':nmLoja', $nmLoja);
        $stmt->bindParam(':alterado_por', $userData);
        $stmt->execute();

        $rowCount = $stmt->rowCount();

        return $rowCount;
    }
}

?>