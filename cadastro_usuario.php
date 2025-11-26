<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Criar Conta</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background-color: #f0f2f5; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .card { background: white; padding: 40px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); width: 320px; text-align: center; }
        h2 { color: #333; margin-bottom: 20px; }
        input { width: 100%; padding: 12px; margin: 8px 0; border: 1px solid #ddd; border-radius: 6px; box-sizing: border-box; }
        button { width: 100%; padding: 12px; background-color: #42b72a; color: white; border: none; border-radius: 6px; cursor: pointer; font-size: 16px; font-weight: bold; margin-top: 10px;}
        button:hover { background-color: #36a420; }
        .link-voltar { display: block; margin-top: 20px; color: #1877f2; text-decoration: none; font-size: 14px; }
        .link-voltar:hover { text-decoration: underline; }
        .msg-erro { color: #dc3545; background: #f8d7da; padding: 10px; border-radius: 4px; font-size: 14px; margin-bottom: 15px; }
    </style>
</head>
<body>
    <div class="card">
        <h2>Nova Conta</h2>

        <?php if(isset($_GET['erro'])): ?>
            <div class="msg-erro">
                <?php
                if($_GET['erro'] == 'senhas_diferentes') echo "As senhas não conferem.";
                else if($_GET['erro'] == 'email_existente') echo "Este e-mail já está cadastrado.";
                else echo "Erro ao criar conta. Tente novamente.";
                ?>
            </div>
        <?php endif; ?>

        <form action="inserir_usuario.php" method="POST">
            <input type="email" name="email" placeholder="Seu melhor e-mail" required>
            <input type="password" name="senha" placeholder="Crie uma senha" required>
            <input type="password" name="confirma_senha" placeholder="Confirme a senha" required>
            
            <button type="submit">Cadastrar</button>
        </form>

        <a href="login.php" class="link-voltar">Já tenho uma conta</a>
    </div>
</body>
</html>