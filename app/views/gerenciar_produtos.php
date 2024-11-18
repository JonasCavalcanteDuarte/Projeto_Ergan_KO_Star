<?php
$page = $dadosPaginacao['page'];
$total_pages = $dadosPaginacao['total_pages'];
?>

<body>
    <div class="container mt-4">
        <h1>Lista de Produtos</h1>
        
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Loja</th>
                    <th>Produto</th>
                    <th>Seller SKU</th>
                    <th>ASIN</th>
                    <th>Preço anunciado</th>
                    <th>Quantidade</th>
                    <th>DH anuncio</th>
                    <th>Valor de aquisição</th>
                    <th>Alterado em</th>
                    <th>Alterado por</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dadosModel as $product): ?>
                    <tr>
                        <td><?php echo $product['nm_loja']; ?></td>
                        <td><?php echo $product['item_name']; ?></td>
                        <td><?php echo $product['seller_sku']; ?></td>
                        <td><?php echo $product['asin']; ?></td>
                        <td><?php echo $product['price']; ?></td>
                        <td><?php echo $product['quantity']; ?></td>
                        <td><?php echo $product['open_date']; ?></td>
                        <td><?php echo $product['acquisition_value']; ?></td>
                        <td><?php echo $product['dh_last_update']; ?></td>
                        <td><?php echo $product['alterado_por']; ?></td>
                        <?php
                        print "<td>
                                    <button onclick=\"location.href='../public/router_product.php?pagina=editar_produto&sku=".$product['seller_sku']."';\"  class='btn btn-success'>Editar</button>
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
                    <a class="page-link" href="../public/router_product.php?pagina=gerenciar_produtos&page=<?php echo $page - 1; ?>" aria-label="Anterior">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>

                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                        <a class="page-link" href="../public/router_product.php?pagina=gerenciar_produtos&page=<?php echo $i;?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>

                <li class="page-item <?php if ($page >= $total_pages) echo 'disabled'; ?>">
                    <a class="page-link" href="../public/router_product.php?pagina=gerenciar_produtos&page=<?php echo $page + 1; ?>" aria-label="Próximo">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
