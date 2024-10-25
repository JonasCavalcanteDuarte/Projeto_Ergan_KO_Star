<?php
    if(isset($_POST['nm_loja'])){
        include('conexao.php');
        $nm_loja = $conn->real_escape_string($_POST['nm_loja']);
        $client_id = $conn->real_escape_string($_POST['client_id']);
        $client_s = $conn->real_escape_string($_POST['client_s']);
        $r_token = $conn->real_escape_string($_POST['r_token']);

        $nm_loja = str_replace(array("#","'",";","*"),'',$nm_loja);
        $client_id = str_replace(array("#","'",";","*"),'',$client_id);
        $client_s = str_replace(array("#","'",";","*"),'',$client_s);
        $r_token = str_replace(array("#","'",";","*"),'',$r_token);

        try{
            $query = $conn->prepare("UPDATE credenciais_amz SET client_id=?, client_secret = ?, refresh_token = ?, dh_last_update = now() WHERE nm_loja = ?;");
            $query->bind_param("ssss",$client_id,$client_s,$r_token,$nm_loja);
            $query->execute();

            if($conn->affected_rows==0){
                print "<script>alert('Nenhum dado foi atualizado, tente novamente.');</script><script>location.href='painel.php?page=altCredAMZ';</script>";
            }else{
                print "<script>alert('Sucesso.');</script><script>location.href='painel.php';</script>";
                mysqli_close($conn);
            }

        }catch(\Exception $e){
            echo $e;
            die("Erro ao atualizar credenciais, tente novamente.<p><a href=\"AltCredAPI.php\">Voltar</p>");
            mysqli_close($conn);
        }
    }
?>