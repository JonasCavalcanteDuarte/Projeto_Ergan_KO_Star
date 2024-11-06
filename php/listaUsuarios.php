<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/style_php.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <title>Gerenciar acessos</title>
</head>
<body>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <h1>Lista de usuários</h1>
<?php
    include('conexao.php');
    $pagina = 1;
    if(isset($_GET['pagina'])){
        $pagina = filter_input(INPUT_GET, "pagina", FILTER_VALIDATE_INT);
    }
    if(!$pagina){
        $pagina = 1;
    }

    $limite = 10;
    $inicio = ($pagina * $limite) - $limite;

    $query = "SELECT * FROM users ORDER BY id LIMIT $inicio,$limite";
    $sql_exec = $conn->query($query) or die("Falha na execução da consualta sql: ".$conn->error);
    $sql_cnt = $sql_exec->num_rows;
    
    $queryqtdpg = "SELECT * FROM users";
    $sql_execqtdpg = $conn->query($queryqtdpg) or die("Falha na execução da consualta sql: ".$conn->error);
    $qtd_pg = $sql_execqtdpg->num_rows;

    $paginas = ceil($qtd_pg / $limite);

    mysqli_close($conn);
    if($sql_cnt > 0){
        print "<table class='table table-hover'>";
        print "<tr>";
        print "<th>ID</th>";
        print "<th>Nome</th>";
        print "<th>E-mail</th>";
        print "<th>DH Criação</th>";
        print "<th>Ações</th>";
        print "</tr>";
        while($row = $sql_exec->fetch_object()){
            print "<tr>";
            print "<td>".$row->id."</td>";
            print "<td>".$row->nome."</td>";
            print "<td>".$row->email."</td>";
            print "<td>".$row->dh_criacao."</td>";
            print "<td>
                        <button onclick=\"location.href='?page=editarUsuario&id=".$row->id."';\"  class='btn btn-success'>Editar</button>
                        <button onclick=\"if(confirm('Tem certeza que deseja excluir este usuário?')){location.href='?page=gerirUsuario&acao=excluir&id=".$row->id."';}else{false;}\"  class='btn btn-danger'>Excluir</button>
                   </td>";
            print "</tr>";

        }
        print "</table>";

        if($pagina>1){
            print "<a href='painel.php?page=listaUser&pagina=1'>Primeira Página </a>";
            print "<a href='painel.php?page=listaUser&pagina=".($pagina-1)."'> << </a>";
        }
        echo $pagina;

        if($pagina<$paginas){
            print "<a href='painel.php?page=listaUser&pagina=".($pagina+1)."'> >> </a>";
            print "<a href='painel.php?page=listaUser&pagina=".$paginas."'> Última Página</a>";
        }

    }else{
        print "<p class='alert alert-danger'>Não encontrou usuários.</p>";
    }
?>

</body>
</html>