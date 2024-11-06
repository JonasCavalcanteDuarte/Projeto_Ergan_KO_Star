<?php
    
    switch(@$_REQUEST["acao"]){
        case "editar":
            if(isset($_POST['asin'])){
                include('conexao.php');
                $preco_aq = $conn->real_escape_string($_POST['preco_pago']);
                $asin = $conn->real_escape_string($_POST['asin']);

                $preco_aq = str_replace(array("#","'",";","*"),'',$preco_aq);
                $asin = str_replace(array("#","'",";","*"),'',$asin);

        
                $query = "SELECT asin FROM products_acquisition_value WHERE asin = '$asin' LIMIT 1";
                $sql_exec = $conn->query($query) or die("Falha na execução da consualta sql: ".$conn->error);
                $sql_cnt = $sql_exec->num_rows;

                if($sql_cnt != 1){
                    die("<script>alert('Produto não encontrado!');</script><script>location.href='?page=listarProdutos';</script>");
                }else{
                    try{
                        $query = $conn->prepare("UPDATE products_acquisition_value SET acquisition_value = ? WHERE asin = ? LIMIT 1");
                        $query->bind_param("ss",$preco_aq,$asin);
                        $query->execute();
                        
                        mysqli_close($conn);
                        print "<script>alert('Atualizado com sucesso!');</script>";
                        print "<script>location.href='painel.php?page=listarProdutos';</script>";
                    }catch(\Exception $e){
                        mysqli_close($conn);
                        die("<script>alert('Erro ao atualizar preço pago do produto, tente novamente.');</script><script>location.href='?page=listarProdutos';</script>");
                    }
                }
            }
        break;

        default:
        print "";
    }
?>