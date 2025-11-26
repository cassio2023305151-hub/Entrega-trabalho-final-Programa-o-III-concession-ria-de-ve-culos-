<?php
if(!isset($_SESSION)) {
    session_start();
}

session_destroy(); // Destrói todas as sessões
header("Location: login.php");
exit;
?>