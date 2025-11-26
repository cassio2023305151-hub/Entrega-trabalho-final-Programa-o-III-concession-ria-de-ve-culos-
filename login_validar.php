<?php
session_start();
include("conecta.php");

if(isset($_POST['email']) && isset($_POST['senha'])) {
    $email = $_POST['email'];
    $senha_digitada = $_POST['senha'];

    // 1. Busca APENAS pelo e-mail
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    // 2. Se achou o usuário, verifica a senha
    if($usuario && password_verify($senha_digitada, $usuario['senha'])) {
        // SENHA CORRETA!
        $_SESSION['id_usuario'] = $usuario['id'];
        $_SESSION['email_usuario'] = $usuario['email'];

        header("Location: dashboard.php");
        exit;
    } else {
        // Senha errada OU E-mail não existe (segurança: não diga qual dos dois errou)
        header("Location: login.php?erro=1");
        exit;
    }
} else {
    header("Location: login.php");
    exit;
}
?>