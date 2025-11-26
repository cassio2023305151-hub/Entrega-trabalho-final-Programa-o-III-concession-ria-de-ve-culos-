<?php
include("conecta.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];
    $confirmar_senha = $_POST['confirma_senha'];

    // 1. Validações Básicas
    if (empty($email) || empty($senha)) {
        header("Location: cadastro_usuario.php?erro=campos_vazios");
        exit;
    }

    if ($senha !== $confirmar_senha) {
        header("Location: cadastro_usuario.php?erro=senhas_diferentes");
        exit;
    }

    try {
        // 2. Verifica se o e-mail já existe
        $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            header("Location: cadastro_usuario.php?erro=email_existente");
            exit;
        }

        // 3. CRIPTOGRAFIA (O Pulo do Gato)
        // O PASSWORD_DEFAULT gera um hash de 60 caracteres que muda sempre
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

        // 4. Salva no Banco
        $stmt_insert = $pdo->prepare("INSERT INTO usuarios (email, senha) VALUES (:email, :senha)");
        $stmt_insert->bindParam(':email', $email);
        $stmt_insert->bindParam(':senha', $senha_hash);
        
        if ($stmt_insert->execute()) {
            // Sucesso: Manda para o login com mensagem positiva
            header("Location: login.php?sucesso=1");
        } else {
            header("Location: cadastro_usuario.php?erro=banco");
        }

    } catch (PDOException $e) {
        // Em produção, não mostre o erro exato ao usuário
        header("Location: cadastro_usuario.php?erro=sistema");
    }
}
?>