<?php
namespace app\models;
require_once '../core/conexao.php';
use core\conexao;
use PDO;

class credAPIModel {

    public function getTotalCreds() {
        $db = conexao::getInstance();
        if(!isset($_SESSION['user_id'])){
            session_start();
        }

        if($_SESSION['loja_acesso'] == 'Ambas'){
            $stmt = $db->query("SELECT COUNT(*) FROM credenciais_amz");
        }else{
            $stmt = $db->prepare("SELECT COUNT(*) FROM credenciais_amz WHERE nm_loja = :loja_acesso");
            $stmt->bindParam(':loja_acesso', $_SESSION['loja_acesso']);
            $stmt->execute();
        }
        return $stmt->fetchColumn();
    }

    public function getCreds($limit, $offset) {
        $db = conexao::getInstance();
        if(!isset($_SESSION['user_id'])){
            session_start();
        }

        if($_SESSION['loja_acesso'] == 'Ambas'){
            $stmt = $db->prepare("SELECT nm_loja, CONCAT(LEFT(client_id,10),'...',RIGHT(client_id,10)) AS client_id,CONCAT(LEFT(client_secret,10),'...',RIGHT(client_secret,10)) AS client_secret, CONCAT(LEFT(refresh_token,10),'...',RIGHT(refresh_token,10)) AS refresh_token,dh_last_update,alterado_por FROM credenciais_amz LIMIT :limit OFFSET :offset");
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
        }else{
            $stmt = $db->prepare("SELECT nm_loja, CONCAT(LEFT(client_id,10),'...',RIGHT(client_id,10)) AS client_id,CONCAT(LEFT(client_secret,10),'...',RIGHT(client_secret,10)) AS client_secret, CONCAT(LEFT(refresh_token,10),'...',RIGHT(refresh_token,10)) AS refresh_token,dh_last_update,alterado_por FROM credenciais_amz WHERE nm_loja = :loja_acesso LIMIT :limit OFFSET :offset");
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt->bindParam(':loja_acesso', $_SESSION['loja_acesso']);
            $stmt->execute();
        }
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
        $dados_old = self::getCredInfo($nmLoja);

        $stmt = $db->prepare("UPDATE credenciais_amz SET client_id = :client_id, client_secret= :client_secret, refresh_token = :refresh_token, dh_last_update = now(),alterado_por = :alterado_por WHERE nm_loja = :nmLoja");
        $stmt->bindParam(':client_id', $client_id);
        $stmt->bindParam(':client_secret', $client_secret);
        $stmt->bindParam(':refresh_token', $refresh_token);
        $stmt->bindParam(':nmLoja', $nmLoja);
        $stmt->bindParam(':alterado_por', $userData);
        $stmt->execute();

        $rowCount = $stmt->rowCount();

        //Registra a ação no log do banco de dados
        $dados_old['refresh_token'] = str_replace("|", "", $dados_old['refresh_token']);
        $dados_old['refresh_token'] = trim($dados_old['refresh_token']);
        $oldDados_log = $dados_old['nm_loja'].'|'.$dados_old['client_id'].'|'.$dados_old['client_secret'].'|'.$dados_old['refresh_token'];
        $refresh_token_ = str_replace("|", "", $refresh_token);
        $refresh_token_ = trim($refresh_token_);
        $newDados_log = $nmLoja.'|'.substr($client_id, 0, 10).'...'.substr($client_id, -10).'|'.substr($client_secret, 0, 10).'...'.substr($client_secret, -10).'|'.substr($refresh_token_, 0, 10).'...'.substr($refresh_token_, -10);
        if(!isset($_SESSION['user_id'])){
            session_start();
        }
        $nm_loja = $_SESSION['loja_acesso'];

        $stmt = $db->prepare('INSERT INTO log_users (id_user, nm_user, acao, alvo, old_values, new_values, dh_execucao, nm_loja) VALUES (:id_user, :nm_user, "Editar", "Credencial API", :old_values, :new_values, now(), :nm_loja)');
        $stmt->bindParam(':id_user', $_SESSION['user_id']);
        $stmt->bindParam(':nm_user', $_SESSION['user_name']);
        $stmt->bindParam(':old_values', $oldDados_log);
        $stmt->bindParam(':new_values', $newDados_log);
        $stmt->bindParam(':nm_loja', $nm_loja);
        $stmt->execute();

        return $rowCount;
    }
}

?>