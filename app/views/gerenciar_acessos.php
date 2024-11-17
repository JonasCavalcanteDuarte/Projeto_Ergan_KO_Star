<?php
$page = $dadosPaginacao['page'];
$total_pages = $dadosPaginacao['total_pages'];
?>

<body>
    <div class="container mt-4">
        <h1>Lista de Usuários</h1>
        
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Nivel acesso</th>
                    <th>Criado em</th>
                    <th>Criado por</th>
                    <th>Alterado em</th>
                    <th>Alterado por</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dadosModel as $user): ?>
                    <tr>
                        <td><?php echo $user['id']; ?></td>
                        <td><?php echo $user['nome']; ?></td>
                        <td><?php echo $user['email']; ?></td>
                        <td><?php echo $user['nivel']; ?></td>
                        <td><?php echo $user['dh_criacao']; ?></td>
                        <td><?php echo $user['criado_por']; ?></td>
                        <td><?php echo $user['dh_ultima_modificacao']; ?></td>
                        <td><?php echo $user['alterado_por']; ?></td>
                        <?php
                        print "<td>
                                    <button onclick=\"location.href='../public/router_user.php?pagina=editar_usuario&userId=".$user['id']."';\"  class='btn btn-success'>Editar</button>
                                    <button onclick=\"if(confirm('Tem certeza que deseja excluir este usuário?')){location.href='?page=gerirUsuario&acao=excluir&id=".$user['id']."';}else{false;}\"  class='btn btn-danger'>Excluir</button>
                                </td>";
                        ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Botões de navegação -->
        <nav>
            <ul class="pagination justify-content-center">
                <li class="page-item <?php if ($page <= 1) echo 'disabled'; ?>">
                    <a class="page-link" href="../public/router_user.php?pagina=gerenciar_acessos&page=<?php echo $page - 1; ?>" aria-label="Anterior">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>

                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                        <a class="page-link" href="../public/router_user.php?pagina=gerenciar_acessos&page=<?php echo $i;?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>

                <li class="page-item <?php if ($page >= $total_pages) echo 'disabled'; ?>">
                    <a class="page-link" href="../public/router_user.php?pagina=gerenciar_acessos&page=<?php echo $page + 1; ?>" aria-label="Próximo">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
