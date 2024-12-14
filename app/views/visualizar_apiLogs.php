<?php
    $page = $dadosPaginacao['page'];
    $total_pages = $dadosPaginacao['total_pages'];
?>
<div class="container mt-5">
    <h2>Logs de erros nas APIs Amazon:</h2>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Id Log</th>
                <th>Loja</th>
                <th>Tabela BD</th>
                <th>Data e Hora</th>
            </tr>
        </thead>

        <tbody>
        <?php foreach ($dadosModel as $index => $log): ?>
            <!-- Linha principal -->
            <tr class="clickable-row" data-target="#sub-row-<?php echo $index; ?>" style="cursor: pointer;">
                <td><?php echo $log['id']; ?></td>
                <td><?php echo $log['nm_loja']; ?></td>
                <td><?php echo $log['nm_table']; ?></td>
                <td><?php echo $log['dh_request']; ?></td>
            </tr>

            <!-- Sub-linha -->
            <tr id="sub-row-<?php echo $index; ?>" class="sub-row" style="display: none;">
                <td colspan="4">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Endpoint</th>
                                <th>Relatório</th>
                                <th>Status</th>
                                <th>Status Code</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo $log['nm_API']; ?></td>
                                <td><?php echo $log['nm_report']; ?></td>
                                <td><?php echo $log['ds_resp_API']; ?></td>
                                <td><?php echo $log['nu_status_code']; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Botões de navegação -->
<nav>
            <ul class="pagination justify-content-center">
                <li class="page-item <?php if ($page <= 1) echo 'disabled'; ?>">
                    <a class="page-link" href="../public/router_log.php?pagina=visualizar_apiLogs&page=<?php echo $page - 1; ?>" aria-label="Anterior">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>

                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                        <a class="page-link" href="../public/router_log.php?pagina=visualizar_apiLogs&page=<?php echo $i;?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>

                <li class="page-item <?php if ($page >= $total_pages) echo 'disabled'; ?>">
                    <a class="page-link" href="../public/router_log.php?pagina=visualizar_apiLogs&page=<?php echo $page + 1; ?>" aria-label="Próximo">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>

<!-- Script para controle do clique e exibição das sub-linhas -->
<script>
    // Ação de clique na linha principal
    document.querySelectorAll('.clickable-row').forEach(row => {
        row.addEventListener('click', function() {
            var targetId = this.getAttribute('data-target');
            var subRow = document.querySelector(targetId);
            
            // Alterna a exibição da sub-linha
            if (subRow.style.display === "none" || subRow.style.display === "") {
                subRow.style.display = "table-row";
            } else {
                subRow.style.display = "none";
            }
        });
    });
</script>
