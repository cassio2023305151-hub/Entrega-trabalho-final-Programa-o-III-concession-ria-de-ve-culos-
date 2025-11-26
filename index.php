<?php
include("conecta.php");
$stmt = $pdo->prepare("SELECT * FROM veiculos");
$stmt->execute();
$dados = $stmt->fetchAll();

foreach ($dados as $veiculos) {
    echo $veiculos['marca'] . " - " . $veiculos['modelo'] . "<br>";
}

?>
