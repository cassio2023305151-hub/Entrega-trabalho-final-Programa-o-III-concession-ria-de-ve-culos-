<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login - Sistema</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background-color: #f0f2f5; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .login-box { background: white; padding: 40px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); width: 320px; text-align: center; }
        h2 { color: #1877f2; margin-bottom: 20px; }
        input { width: 100%; padding: 12px; margin: 8px 0; border: 1px solid #ddd; border-radius: 6px; box-sizing: border-box; }
        button { width: 100%; padding: 12px; background-color: #1877f2; color: white; border: none; border-radius: 6px; cursor: pointer; font-size: 16px; font-weight: bold; margin-top: 10px; }
        button:hover { background-color: #166fe5; }
        .btn-cadastro { display: inline-block; margin-top: 20px; background-color: #42b72a; color: white; padding: 10px 20px; text-decoration: none; border-radius: 6px; font-weight: bold; font-size: 14px; }
        .btn-cadastro:hover { background-color: #36a420; }
        .divider { border-bottom: 1px solid #ddd; margin: 20px 0; }
        .msg-sucesso { color: #155724; background-color: #d4edda; padding: 10px; border-radius: 5px; margin-bottom: 15px; }
        .msg-erro { color: #721c24; background-color: #f8d7da; padding: 10px; border-radius: 5px; margin-bottom: 15px; }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Entrar</h2>
        
        <?php if(isset($_GET['sucesso'])): ?>
            <div class="msg-sucesso">Conta criada! Faça login.</div>
        <?php endif; ?>

        <?php if(isset($_GET['erro'])): ?>
            <div class="msg-erro">E-mail ou senha incorretos.</div>
        <?php endif; ?>

        <form action="login_validar.php" method="POST">
            <input type="email" name="email" placeholder="E-mail" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <button type="submit">Acessar Sistema</button>
        </form>

        <div class="divider"></div>
        
        <p>Não tem acesso?</p>
        <a href="cadastro_usuario.php" class="btn-cadastro">Criar nova conta</a>
    </div>
</body>
</html>