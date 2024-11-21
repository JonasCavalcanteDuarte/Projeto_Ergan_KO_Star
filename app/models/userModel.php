<?php
namespace app\models;
require_once '../core/conexao.php';
use core\conexao;
use PDO;

class UserModel {

    public static function authenticate($email, $password) {
        $db = conexao::getInstance();
        $stmt = $db->prepare('SELECT id,nome,email,senha,nivel, loja_acesso FROM users WHERE email = :email LIMIT 1');
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user && password_verify($password, $user['senha'])) {
            return $user;
        }
        
        return false;
    }

    public static function create_user($nome, $email, $senha, $nivel, $loja) {
        $db = conexao::getInstance();
        // Calculando o hash da senha
        $hashedPassword = password_hash($senha, PASSWORD_DEFAULT);

        $query = "SELECT id FROM users WHERE email = '$email' LIMIT 1";
        $stmt = $db->query($query) or die("Falha na execução da consualta sql: ".$db->error);
        $stmt = $stmt->rowCount();

        if($stmt == 1){
            die("<script>alert('E-mail já cadastrado!');</script><script>location.href='../cadastro';</script>");
        }else{
            try {
                // Tenta executar a consulta
                $userData = $_SESSION['user_name']." ID: ".$_SESSION['user_id'];
                $stmt = $db->prepare('INSERT INTO users (nome,email, senha, nivel, dh_criacao,criado_por, loja_acesso) VALUES (:nome, :email, :senha, :nivel, now(),:criado_por, :loja_acesso)');
                $stmt->bindParam(':nome', $nome);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':senha', $hashedPassword);
                $stmt->bindParam(':nivel', $nivel);
                $stmt->bindParam(':criado_por', $userData);
                $stmt->bindParam(':loja_acesso', $loja);
                $stmt->execute();
            } catch (PDOException $e) {
                // Loga o erro (recomendado para produção)
                //error_log("Erro no banco de dados: " . $e->getMessage());
                
                // Exibe uma mensagem genérica para o usuário
                echo "<script>alert('Não foi possível cadastrar, por favor, tente novamente mais tarde.');</script>";
                echo "<script>location.href='../cadastro';</script>";
                exit(); // Garante que o script PHP termine após o redirecionamento
            } catch (Exception $e) {
                // Trata outras exceções genéricas
                echo "<script>alert('Ocorreu um erro inesperado.');</script>";
                echo "<script>location.href='../cadastro';</script>";
                exit(); // Garante que o script PHP termine após o redirecionamento
            }
        }
        
    }

    public function getTotalUsers() {
        $db = conexao::getInstance();
        if(!isset($_SESSION['user_id'])){
            session_start();
        }
        if($_SESSION['loja_acesso'] == 'Ambas'){
            $stmt = $db->query("SELECT COUNT(*) FROM users");
        }else{
            $stmt = $db->prepare("SELECT COUNT(*) FROM users WHERE loja_acesso = :loja_acesso");
            $stmt->bindParam(':loja_acesso', $_SESSION['loja_acesso']);
            $stmt->execute();
        }
        return $stmt->fetchColumn();
    }

    public function getUsers($limit, $offset) {
        $db = conexao::getInstance();
        if(!isset($_SESSION['user_id'])){
            session_start();
        }

        if($_SESSION['loja_acesso'] == 'Ambas'){
            $stmt = $db->prepare("SELECT id,nome,email,nivel,dh_criacao,dh_ultima_modificacao,criado_por,alterado_por, loja_acesso FROM users LIMIT :limit OFFSET :offset");
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
        }else{
            $stmt = $db->prepare("SELECT id,nome,email,nivel,dh_criacao,dh_ultima_modificacao,criado_por,alterado_por, loja_acesso FROM users WHERE loja_acesso = :loja_acesso LIMIT :limit OFFSET :offset");
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt->bindParam(':loja_acesso', $_SESSION['loja_acesso']);
            $stmt->execute();
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getUserInfo($userId) {
        $db = conexao::getInstance();
        $stmt = $db->prepare("SELECT id,nome,email,nivel,loja_acesso FROM users WHERE id = :userId LIMIT 1");
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function updateUser($userId,$nome, $email, $senha, $nivel, $loja) {
        $userData = $_SESSION['user_name']." ID: ".$_SESSION['user_id'];
        $db = conexao::getInstance();
        $stmt = $db->prepare("UPDATE users SET nome = :nome, email= :email, senha = :senha, nivel = :nivel, dh_ultima_modificacao = now(),alterado_por = :alterado_por, loja_acesso = :loja_acesso WHERE id = :userId");
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha);
        $stmt->bindParam(':nivel', $nivel);
        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':alterado_por', $userData);
        $stmt->bindParam(':loja_acesso', $loja);
        $stmt->execute();

        $rowCount = $stmt->rowCount();

        return $rowCount;
    }

    public static function deleteUser($userId) {
        $db = conexao::getInstance();
        $stmt = $db->prepare("DELETE FROM users WHERE id = :userId");
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();
        $rowCount = $stmt->rowCount();
        return $rowCount;
    }

    public static function getUserAccessLevel() {
        $db = conexao::getInstance();
        if(!isset($_SESSION['user_id'])){
            session_start();
        }
        $stmt = $db->prepare("SELECT level_access,level_description FROM user_access_level WHERE level_access>= :level_access");
        $stmt->bindParam(':level_access', $_SESSION['nivel']);
        $stmt->execute();
        $accessLevel = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt = $db->prepare("SELECT loja_acesso FROM users WHERE id = :id");
        $stmt->bindParam(':id', $_SESSION['user_id']);
        $stmt->execute();
        $accessStore = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $results['accessLevel'] = $accessLevel;
        $results['accessStore'] = $accessStore;

        return $results;
    }

}
?>