<?php
if(!isset($_SESSION)) {
    session_start();
}

// Verifica se existe a variável de sessão 'id_usuario'
if(!isset($_SESSION['id_usuario'])) {
    // Se não estiver logado, mata o script e redireciona
    header("Location: login.php");
    exit; // O exit é crucial para garantir que nada abaixo seja executado
}
?>