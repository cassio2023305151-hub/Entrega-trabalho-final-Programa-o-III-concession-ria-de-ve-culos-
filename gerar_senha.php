<?php
include("conecta.php");

$email = "admin@teste.com"; // O email que você quer arrumar
$senha_desejada = "123";    // A senha que você quer usar

// 1. Gera o HASH seguro da senha
$hash = password_hash($senha_desejada, PASSWORD_DEFAULT);

echo "<h3>Diagnóstico de Senha</h3>";
echo "Senha digitada: <strong>$senha_desejada</strong><br>";
echo "Hash gerado: <strong>$hash</strong><br><br>";

// 2. Atualiza no Banco de Dados
try {
    $stmt = $pdo->prepare("UPDATE usuarios SET senha = :senha WHERE email = :email");
    $stmt->bindParam(':senha', $hash);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo "<h3 style='color:green'>Sucesso! Senha atualizada no Banco.</h3>";
        echo "Agora tente logar com a senha: <strong>$senha_desejada</strong>";
    } else {
        echo "<h3 style='color:orange'>Atenção: Nenhuma linha alterada.</h3>";
        echo "Verifique se o email <strong>$email</strong> realmente existe na tabela 'usuarios'.";
    }

} catch (PDOException $e) {
    echo "Erro no banco: " . $e->getMessage();
}
?>