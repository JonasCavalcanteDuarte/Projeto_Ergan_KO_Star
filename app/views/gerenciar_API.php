<?php
$page = $dadosPaginacao['page'];
$total_pages = $dadosPaginacao['total_pages'];
?>

<body>
    <div class="container mt-4">
        <h1>Lista de Credenciais</h1>
        
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Loja</th>
                    <th>Client ID</th>
                    <th>Client Secret</th>
                    <th>Refesh Token</th>
                    <th>Alterado em</th>
                    <th>Alterado por</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dadosModel as $cred): ?>
                    <tr>
                        <td><?php echo $cred['nm_loja']; ?></td>
                        <td><?php echo $cred['client_id']; ?></td>
                        <td><?php echo $cred['client_secret']; ?></td>
                        <td><?php echo $cred['refresh_token']; ?></td>
                        <td><?php echo $cred['dh_last_update']; ?></td>
                        <td><?php echo $cred['alterado_por']; ?></td>
                        <?php
                        print "<td>
                                    <button onclick=\"location.href='../public/router_cred.php?pagina=editar_credencial&nm_loja=".$cred['nm_loja']."';\"  class='btn btn-success'>Editar</button>
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
                    <a class="page-link" href="../public/router_cred.php?pagina=gerenciar_API&page=<?php echo $page - 1; ?>" aria-label="Anterior">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>

                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                        <a class="page-link" href="../public/router_cred.php?pagina=gerenciar_API&page=<?php echo $i;?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>

                <li class="page-item <?php if ($page >= $total_pages) echo 'disabled'; ?>">
                    <a class="page-link" href="../public/router_cred.php?pagina=gerenciar_API&page=<?php echo $page + 1; ?>" aria-label="Próximo">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
