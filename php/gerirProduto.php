<?php
    
    switch(@$_REQUEST["acao"]){
        case "editar":
            if(isset($_POST['email'])){
                include('conexao.php');
                $nome = $conn->real_escape_string($_POST['nome']);
                $email = $conn->real_escape_string($_POST['email']);
                $pass = password_hash($conn->real_escape_string($_POST['senha']), PASSWORD_DEFAULT);

                $nome = str_replace(array("#","'",";","*"),'',$nome);
                $email = str_replace(array("#","'",";","*"),'',$email);
                $pass = str_replace(array("#","'",";","*"),'',$pass);

        
                $query = "SELECT id FROM users WHERE email = '$email' LIMIT 1";
                $sql_exec = $conn->query($query) or die("Falha na execução da consualta sql: ".$conn->error);
                $sql_cnt = $sql_exec->num_rows;

                if($sql_cnt == 1){
                    die("<script>alert('E-mail já cadastrado!');</script><script>location.href='?page=cadastro';</script>");
                }else{
                    try{
                        $query = $conn->prepare("INSERT INTO users (nome,email,senha,dh_criacao) VALUES(?,?,?,now());");
                        $query->bind_param("sss",$nome,$email,$pass);
                        $query->execute();
                        
                        mysqli_close($conn);
                        print "<script>alert('Cadastrado com sucesso!');</script>";
                        print "<script>location.href='?page=listaUser';</script>";
                    }catch(\Exception $e){
                        mysqli_close($conn);
                        die("<script>alert('Erro ao cadastrar usuário, tente novamente.');</script><script>location.href='?page=cadastro';</script>");
                    }
                }
            }
        break;

        default:
        print "";
    }
?>