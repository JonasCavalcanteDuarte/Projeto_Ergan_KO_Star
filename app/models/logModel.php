<?php
namespace app\models;
require_once '../core/conexao.php';
use core\conexao;
use PDO;

class logModel {

    public function getTotalLogs() {
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

    public function getLogs($limit, $offset) {
        $db = conexao::getInstance();
        if(!isset($_SESSION['user_id'])){
            session_start();
        }

        if($_SESSION['loja_acesso'] == 'Ambas'){
            $stmt = $db->prepare("SELECT id, nm_user, acao, alvo, old_values, new_values, dh_execucao FROM log_users  ORDER BY dh_execucao DESC LIMIT :limit OFFSET :offset");
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
        }else{
            $stmt = $db->prepare("SELECT id, nm_user, acao, alvo, old_values, new_values, dh_execucao FROM log_users WHERE nm_loja = :nm_loja ORDER BY dh_execucao DESC LIMIT :limit OFFSET :offset");
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt->bindParam(':nm_loja', $_SESSION['loja_acesso']);
            $stmt->execute();
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
?>