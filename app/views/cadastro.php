<style>
        /* Inicialmente, o campo estará oculto */
        #loja {
            display: none;
        }
</style>
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Cadastre um usuário:</h2>
        </div>
        <div class="card-body">
            <!-- Formulário -->
            <form action="./cadastro/cadastrar" method="POST">
                <input type="hidden" name="acao" value="cadastrar">
                <div class="mb-3">
                    <label for="name" class="form-label">Nome:</label>
                    <input type="text" name="nome" class="form-control" placeholder="Digite o nome" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail:</label>
                    <input type="email" name="email" class="form-control" placeholder="Digite o e-mail" required>
                </div>
                <div class="mb-3">
                    <label for="senha" class="form-label">Senha:</label>
                    <input type="password" name="senha" class="form-control" placeholder="Digite a senha" required>
                </div>
                <div class="mb-3">
                    <label for="nivel" class="form-label">Nivel de acesso:</label>
                    <select id="nivel" name="nivel" class="form-control" required>
                        <option>Selecione</option>
                        <?php foreach ($dadosModel['accessLevel'] as $accessLevels): ?>
                        <option value="<?php echo $accessLevels['level_access']?>"><?php echo $accessLevels['level_description']?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3" id="loja">
                    <label for="loja" class="form-label">Terá acesso a qual loja?</label>
                    <select name="loja" class="form-control" required>
                        <option value>Selecione</option>
                        <?php
                        if($dadosModel['accessStore'][0]['loja_acesso']=='Ambas'){
                        ?>
                        <option value="Ergan">Somente Ergan</option>
                        <option value="KO-Star">Somente KO-Star</option>
                        <?php
                        }else{
                        ?>
                        <option value="<?php echo $dadosModel['accessStore'][0]['loja_acesso']?>"><?php echo $dadosModel['accessStore'][0]['loja_acesso']?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary w-100">Cadastrar <i class="fas fa-paper-plane"></i></button>
            </form>
        </div>
    </div>
</div>
<script>
    // Captura o select e o campo condicional
    const select = document.getElementById('nivel');
    const campoCondicional = document.getElementById('loja');

    // Função para verificar a seleção e mostrar/esconder o campo
    select.addEventListener('change', function() {
        if (select.value === '3' || select.value === '4') {
            // Exibe o campo condicional quando a opção "3" ou "4" for selecionada
            campoCondicional.style.display = 'block';
        } else {
            // Caso contrário, esconde o campo
            campoCondicional.style.display = 'none';
        }
    });
</script>