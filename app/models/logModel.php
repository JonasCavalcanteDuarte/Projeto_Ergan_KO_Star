<?php
namespace app\models;
require_once '../core/conexao.php';
use core\conexao;
use PDO;

class logModel {

    public function getTotalUserLogs() {
        $db = conexao::getInstance();
        if(!isset($_SESSION['user_id'])){
            session_start();
        }
        if($_SESSION['loja_acesso'] == 'Ambas'){
            $stmt = $db->query("SELECT COUNT(*) FROM log_users");
        }else{
            $stmt = $db->prepare("SELECT COUNT(*) FROM log_users WHERE nm_loja = :nm_loja");
            $stmt->bindParam(':nm_loja', $_SESSION['loja_acesso']);
            $stmt->execute();
        }
        return $stmt->fetchColumn();
    }

    public function getUserLogs($limit, $offset) {
        $db = conexao::getInstance();
        if(!isset($_SESSION['user_id'])){
            session_start();
        }

        if($_SESSION['loja_acesso'] == 'Ambas'){
            $stmt = $db->prepare("SELECT id, nm_user, acao, alvo, old_values, new_values, dh_execucao, nm_loja FROM log_users  ORDER BY dh_execucao DESC LIMIT :limit OFFSET :offset");
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
        }else{
            $stmt = $db->prepare("SELECT id, nm_user, acao, alvo, old_values, new_values, dh_execucao, nm_loja FROM log_users WHERE nm_loja = :nm_loja ORDER BY dh_execucao DESC LIMIT :limit OFFSET :offset");
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt->bindParam(':nm_loja', $_SESSION['loja_acesso']);
            $stmt->execute();
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotalAPILogs() {
        $db = conexao::getInstance();
        if(!isset($_SESSION['user_id'])){
            session_start();
        }
        if($_SESSION['loja_acesso'] == 'Ambas'){
            $stmt = $db->query("SELECT COUNT(*) FROM log_APIS");
        }else{
            $stmt = $db->prepare("SELECT COUNT(*) FROM log_APIS WHERE nm_loja = :nm_loja");
            $stmt->bindParam(':nm_loja', $_SESSION['loja_acesso']);
            $stmt->execute();
        }
        return $stmt->fetchColumn();
    }

    public function getAPILogs($limit, $offset) {
        $db = conexao::getInstance();
        if(!isset($_SESSION['user_id'])){
            session_start();
        }

        if($_SESSION['loja_acesso'] == 'Ambas'){
            $stmt = $db->prepare("SELECT id, nm_loja, nm_table, nm_API, nm_report, ds_resp_API, nu_status_code, dh_request FROM log_APIS  ORDER BY dh_request DESC LIMIT :limit OFFSET :offset");
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
        }else{
            $stmt = $db->prepare("SELECT id, nm_loja, nm_table, nm_API, nm_report, ds_resp_API, nu_status_code, dh_request FROM log_APIS WHERE nm_loja = :nm_loja ORDER BY dh_request DESC LIMIT :limit OFFSET :offset");
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt->bindParam(':nm_loja', $_SESSION['loja_acesso']);
            $stmt->execute();
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
?>