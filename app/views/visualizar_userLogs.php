<?php
    $page = $dadosPaginacao['page'];
    $total_pages = $dadosPaginacao['total_pages'];
?>
<div class="container mt-5">
    <h2>Logs de ações feitas pelos usuários:</h2>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Id Log</th>
                <th>Usuário responsável</th>
                <th>Ação executada</th>
                <th>Objeto afetado</th>
                <th>Data e Hora</th>
            </tr>
        </thead>

        <tbody>
        <?php foreach ($dadosModel as $index => $log): ?>
            <!-- Linha principal -->
            <tr class="clickable-row" data-target="#sub-row-<?php echo $index; ?>" style="cursor: pointer;">
                <td><?php echo $log['id']; ?></td>
                <td><?php echo $log['nm_user']; ?></td>
                <td><?php echo $log['acao']; ?></td>
                <td><?php echo $log['alvo']; ?></td>
                <td><?php echo $log['dh_execucao']; ?></td>
            </tr>

            <!-- Sub-linha -->
            <tr id="sub-row-<?php echo $index; ?>" class="sub-row" style="display: none;">
                <td colspan="5">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Valor 1</th>
                                <th>Valor 2</th>
                                <th>Valor 3</th>
                                <th>Valor 4</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Antes:</td>
                                <?php if (!is_null($log['old_values']) && $log['old_values'] !== "") {$old_values = explode("|", $log['old_values']);} else{$new_values = [];} ?>
                                <td><?php if(!empty($old_values) && isset($old_values[0])){echo $old_values[0];} else{echo "";} ?></td>
                                <td><?php if(!empty($old_values) && isset($old_values[1])){echo $old_values[1];} else{echo "";} ?></td>
                                <td><?php if(!empty($old_values) && isset($old_values[2])){echo $old_values[2];} else{echo "";} ?></td>
                                <td><?php if(!empty($old_values) && isset($old_values[3])){echo $old_values[3];} else{echo "";} ?></td>
                            </tr>
                            <tr>
                                <td>Depois:</td>
                                <?php if (!is_null($log['new_values']) && $log['new_values'] !== "") {$new_values = explode("|", $log['new_values']);} else{$new_values = [];} ?>
                                <td><?php if(!empty($new_values) && isset($new_values[0])){echo $new_values[0];} else{echo "";} ?></td>
                                <td><?php if(!empty($new_values) && isset($new_values[1])){echo $new_values[1];} else{echo "";} ?></td>
                                <td><?php if(!empty($new_values) && isset($new_values[2])){echo $new_values[2];} else{echo "";} ?></td>
                                <td><?php if(!empty($new_values) && isset($new_values[3])){echo $new_values[3];} else{echo "";} ?></td>
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
                    <a class="page-link" href="../public/router_log.php?pagina=visualizar_userLogs&page=<?php echo $page - 1; ?>" aria-label="Anterior">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>

                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                        <a class="page-link" href="../public/router_log.php?pagina=visualizar_userLogs&page=<?php echo $i;?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>

                <li class="page-item <?php if ($page >= $total_pages) echo 'disabled'; ?>">
                    <a class="page-link" href="../public/router_log.php?pagina=visualizar_userLogs&page=<?php echo $page + 1; ?>" aria-label="Próximo">
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
