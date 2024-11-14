<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Cadastre um usuário:</h2>
        </div>
        <div class="card-body">
            <!-- Formulário -->
            <form action="#" method="POST">
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

                <button type="submit" class="btn btn-primary w-100">Cadastrar <i class="fas fa-paper-plane"></i></button>
            </form>
        </div>
    </div>
</div>