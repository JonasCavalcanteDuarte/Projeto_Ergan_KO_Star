<?php
namespace app\models;
require_once '../core/conexao.php';
use core\conexao;
use PDO;

class UserModel {

    public static function authenticate($email, $password) {
        $db = conexao::getInstance();
        $stmt = $db->prepare('SELECT id,nome,email,senha,nivel FROM users WHERE email = :email LIMIT 1');
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user && password_verify($password, $user['senha'])) {
            return $user;
        }
        
        return false;
    }

    public static function create_user($email, $password) {
        $db = conexao::getInstance();
        $stmt = $db->prepare('INSERT INTO users (email, password) VALUES (?, ?)');
        $stmt->bindParam('ss', $email,password_hash($password, PASSWORD_DEFAULT));
        return $stmt->execute();
    }
}
?>