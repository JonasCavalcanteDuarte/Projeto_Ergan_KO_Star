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

    public static function create_user($nome, $email, $senha, $nivel) {
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
                $stmt = $db->prepare('INSERT INTO users (nome,email, senha, nivel, dh_criacao) VALUES (:nome, :email, :senha, :nivel, now())');
                $stmt->bindParam(':nome', $nome);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':senha', $hashedPassword);
                $stmt->bindParam(':nivel', $nivel);
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
}
?>