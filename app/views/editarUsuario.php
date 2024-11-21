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
                        <option value="<?php echo $accessLevels['level_access'];?>"><?php echo $accessLevels['level_description']?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3" id="loja">
                    <label for="loja" class="form-label">Terá acesso a qual loja?</label>
                    <select id="select_loja" name="loja" class="form-control" required>
                        <?php
                        if($dadosModel['accessLevels']['accessStore'][0]['loja_acesso']=='Ambas'){
                        ?>
                        <option id="valorCondicional" value=<?php echo $dadosModel['userInfo']['loja_acesso'];?>><?php echo "Somente ".$dadosModel['userInfo']['loja_acesso'];?></option>
                        <option value="Ergan">Somente Ergan</option>
                        <option value="KO-Star">Somente KO-Star</option>
                        <?php
                        }else{
                        ?>
                        <option value="<?php echo $dadosModel['userInfo']['loja_acesso'];?>"><?php echo $dadosModel['userInfo']['loja_acesso']?></option>
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
const valorCondicional = document.getElementById('valorCondicional');
const campoLoja = document.getElementById('select_loja');

// Função para mostrar ou ocultar o campo
function verificarOpcao() {

    // Se o valor selecionado for 'mostrar', mostramos o campo
    if (select.value === '3' || select.value === '4') {
        campoCondicional.style.display = 'block'; // Torna o campo visível
        campoLoja.setAttribute('required', 'required');
    } else {
        campoCondicional.style.display = 'none'; // Oculta o campo
        campoLoja.removeAttribute('required');
        campoLoja.value = 'Ambas'; // O valor da opção selecionada será "Ergan"
    }
}

// Função para mostrar ou ocultar o campo
function verificarOpcao2() {

    if (select.value === '3' || select.value === '4') {
        // Exibe o campo condicional quando a opção "3" ou "4" for selecionada
        valorCondicional.style.display = 'none';
        campoLoja.value = 'Ergan'; // O valor da opção selecionada será "Ergan"
    } else {
        // Caso contrário, esconde o campo
        valorCondicional.style.display = 'block';
    }
}


// Executar a função assim que a página for carregada
window.onload = verificarOpcao;


// Adicionar um ouvinte de evento para verificar quando o valor do select mudar
document.getElementById('nivel').addEventListener('change', verificarOpcao);
document.getElementById('nivel').addEventListener('change', verificarOpcao2);
</script>