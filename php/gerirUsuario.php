<?php
    
    switch(@$_REQUEST["acao"]){
        case "cadastrar":
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
        case "editar":
            if(isset($_POST['email'])){
                include('conexao.php');
                $nome = $conn->real_escape_string($_POST['nome']);
                $email = $conn->real_escape_string($_POST['email']);
                $pass = password_hash($conn->real_escape_string($_POST['senha']), PASSWORD_DEFAULT);

                $nome = str_replace(array("#","'",";","*"),'',$nome);
                $email = str_replace(array("#","'",";","*"),'',$email);
                $pass = str_replace(array("#","'",";","*"),'',$pass);

                try{
                    $query = $conn->prepare("UPDATE users SET nome = ?, email = ?, senha = ? WHERE id = ?;");
                    $query->bind_param("ssss",$nome,$email,$pass,$_POST['id']);
                    $query->execute();
                    
                    mysqli_close($conn);
                    print "<script>alert('Atualizado com sucesso!');</script>";
                    print "<script>location.href='?page=listaUser';</script>";
                }catch(\Exception $e){
                    mysqli_close($conn);
                    die("<script>alert('Erro ao atualizar usuário, tente novamente.');</script><script>location.href='?page=editarUsuario';</script>");
                }
                
            }
        break;
        case "excluir":
            include('conexao.php');

            try{
                $query = $conn->prepare("DELETE FROM users WHERE id = ?;");
                $query->bind_param("s",$_REQUEST['id']);
                $query->execute();
                
                mysqli_close($conn);
                print "<script>alert('Excluido com sucesso!');</script>";
                print "<script>location.href='?page=listaUser';</script>";
            }catch(\Exception $e){
                mysqli_close($conn);
                die("<script>alert('Erro ao excluir usuário, tente novamente.');</script><script>location.href='?page=listaUser';</script>");
            }
        break;

        default:
        print "";
    }
?>