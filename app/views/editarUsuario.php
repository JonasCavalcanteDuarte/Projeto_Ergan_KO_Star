<style>
        /* Inicialmente, o campo estará oculto */
        #loja {
            display: none;
        }
</style>
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Preencha o formulário:</h2>
        </div>
        <div class="card-body">
            <!-- Formulário -->
            <form action="./editUser/editarUsuario" method="POST">
                <input type="hidden" name="id" value="<?php echo $dadosModel['userInfo']['id'];?>">
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome:</label>
                    <input type="text" name="nome" value="<?php echo $dadosModel['userInfo']['nome']; ?>" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail:</label>
                    <input type="email" name="email" value="<?php echo $dadosModel['userInfo']['email']; ?>" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="senha" class="form-label">Senha:</label>
                    <input type="password" name="senha" placeholder="Digite a senha atual ou uma nova senha" name="r_token" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="nivel" class="form-label">Nivel de acesso:</label>
                    <select id="nivel" name="nivel" class="form-control" required>
                        <option value=<?php echo $dadosModel['userInfo']['nivel'];?>><?php echo "Manter nivel de acesso atual: ".$dadosModel['userInfo']['nivel'];?></option>
                        <?php foreach ($dadosModel['accessLevels']['accessLevel'] as $accessLevels): ?>
                        <option value="<?php echo $accessLevels['level_access']?>"><?php echo $accessLevels['level_description']?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3" id="loja">
                    <label for="loja" class="form-label">Terá acesso a qual loja?</label>
                    <select name="loja" class="form-control" required>
                        <option value>Selecione</option>
                        <?php
                        if($dadosModel['accessLevels']['accessStore'][0]['loja_acesso']=='Ambas'){
                        ?>
                        <option value="Ergan">Somente Ergan</option>
                        <option value="KO-Star">Somente KO-Star</option>
                        <?php
                        }else{
                        ?>
                        <option value="<?php echo $dadosModel['accessLevels']['accessStore'][0]['loja_acesso']?>"><?php echo $dadosModel['accessLevels']['accessStore'][0]['loja_acesso']?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary w-100">Atualizar dados <i class="fas fa-paper-plane"></i></button>
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