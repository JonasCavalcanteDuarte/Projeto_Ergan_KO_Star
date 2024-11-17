<div class="container">
        <div class="card">
            <div class="card-header">
                <h2>Preencha o formulário:</h2>
            </div>
            <div class="card-body">
                <!-- Formulário -->
                <form action="./editUser/editar" method="POST">
                    <input type="hidden" name="id" value="<?php echo $dadosModel['id'];?>">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome:</label>
                        <input type="text" name="nome" value="<?php echo $dadosModel['nome']; ?>" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail:</label>
                        <input type="email" name="email" value="<?php echo $dadosModel['email']; ?>" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="senha" class="form-label">Senha:</label>
                        <input type="password" name="senha" placeholder="Digite a senha atual ou uma nova senha" name="r_token" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="nivel" class="form-label">Nivel de acesso:</label>
                        <select name="nivel" class="form-control" required>
                            <option value=<?php echo $dadosModel['nivel'];?>><?php if($dadosModel['nivel']==1){echo "Nivel 1 (ADM)";}else{echo "Nivel 2 (Leitor)";}?></option>
                            <option value="1">Nivel 1 (ADM)</option>
                            <option value="2">Nivel 2 (Leitor)</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Atualizar dados <i class="fas fa-paper-plane"></i></button>
                </form>
            </div>
        </div>
    </div>