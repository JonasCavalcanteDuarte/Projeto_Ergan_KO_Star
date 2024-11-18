<div class="container">
        <div class="card">
            <div class="card-header">
                <h2>Preencha o formulário:</h2>
            </div>
            <div class="card-body">
                <!-- Formulário -->
                <form action="./editCred/editarCred" method="POST">
                    <div class="mb-3">
                        <input type="hidden" name="nm_loja" value="<?php echo $dadosModel['nm_loja'];?>">
                        <label for="nm_loja" class="form-label">Loja:</label>
                        <select name="nm_loja_d" class="form-control" disabled>
                            <option><?php echo $dadosModel['nm_loja'];?></option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="client_id" class="form-label">Client ID:</label>
                        <input type="text" placeholder="Client ID" name="client_id" class="form-control" value="<?php echo $dadosModel['client_id'];?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="client_s" class="form-label">Client Secret:</label>
                        <input type="text" placeholder="Client Secret" name="client_s" class="form-control" value="<?php echo $dadosModel['client_secret'];?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="r_token" class="form-label">Refresh Token:</label>
                        <input type="text" placeholder="Refresh Token" name="r_token" class="form-control" value="<?php echo $dadosModel['refresh_token'];?>" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Atualizar credenciais <i class="fas fa-paper-plane"></i></button>
                </form>
            </div>
        </div>
    </div>