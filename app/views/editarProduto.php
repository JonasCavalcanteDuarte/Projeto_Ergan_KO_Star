<div class="container">
        <div class="card">
            <div class="card-header">
                <h2>Preencha o formulário:</h2>
            </div>
            <div class="card-body">
                <!-- Formulário -->
                <form action="./editProduct/editarProduto" method="POST">
                    <input type="hidden" name="sku" value="<?php echo $dadosModel['seller_sku'];?>">                    
                    <div class="mb-3">
                        <label for="nm_loja" class="form-label">Loja:</label>
                        <input type="text" name="nm_loja" value="<?php echo $dadosModel['nm_loja']; ?>" class="form-control" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="item_name" class="form-label">Produto:</label>
                        <input type="text" name="item_name" value="<?php echo $dadosModel['item_name']; ?>" class="form-control" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="seller_sku" class="form-label">Seller SKU:</label>
                        <input type="text" name="seller_sku" value="<?php echo $dadosModel['seller_sku']; ?>" class="form-control" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="asin" class="form-label">ASIN:</label>
                        <input type="text" name="asin" value="<?php echo $dadosModel['asin']; ?>" class="form-control" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Preço anunciado:</label>
                        <input type="text" name="price" value="<?php echo $dadosModel['price']; ?>" class="form-control" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantidade em estoque:</label>
                        <input type="text" name="quantity" value="<?php echo $dadosModel['quantity']; ?>" class="form-control" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="open_date" class="form-label">DH Anuncio:</label>
                        <input type="text" name="open_date" value="<?php echo $dadosModel['open_date']; ?>" class="form-control" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="acquisition_value" class="form-label">Preço pago:</label>
                        <input type="text" name="acquisition_value" value="<?php echo $dadosModel['acquisition_value']; ?>" class="form-control" required>
                    </div>
                    
                    

                    <button type="submit" class="btn btn-primary w-100">Atualizar dados <i class="fas fa-paper-plane"></i></button>
                </form>
            </div>
        </div>
    </div>