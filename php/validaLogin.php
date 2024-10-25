<?php
    if(isset($_POST['email'])||isset($_POST['senha'])){
        
        if(strlen($_POST['email'])==0){
            die("<script>alert('Usuário inválido!');</script><script>location.href='../index.php';</script>");
        } else if (strlen($_POST['senha'])==0){
            die("<script>alert('Senha inválida!');</script><script>location.href='../index.php';</script>");
        }else{
            include('conexao.php');

            $email = $conn->real_escape_string($_POST['email']);
            $pass = $conn->real_escape_string($_POST['senha']);

            $email = str_replace(array("#","'",";","*"),'',$email);
            $pass = str_replace(array("#","'",";","*"),'',$pass);

            $query = "SELECT id,nome,email,senha FROM users WHERE email = '$email' LIMIT 1";
            $sql_exec = $conn->query($query) or die("Falha na execução da consualta sql: ".$conn->error);

            $usuario = $sql_exec->fetch_assoc();
            if (password_verify($pass,$usuario['senha'])){

                if(!isset($_SESSION)){
                    session_start();
                }

                $_SESSION['user_id'] = $usuario['id'];
                $_SESSION['user_name'] = $usuario['nome'];
                $_SESSION['time']=time();

                mysqli_close($conn);
                header("Location: painel.php");

            }else{
                session_start();
                session_destroy();
                $_SESSION=array();
                die("<script>alert('Usuário e/ou Senha inválida!');</script><script>location.href='../index.php';</script>");
                mysqli_close($conn);
            }

            
        }
    }
?>