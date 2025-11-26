<?php
// (Este é o arquivo 'buscar_veiculos_ajax.php')

if(isset($_GET['tipo_pesquisa']) && isset($_GET['campo_pesquisa'])) {
    
    $opcao = $_GET['tipo_pesquisa'];
    $campo_pesquisa = $_GET['campo_pesquisa'];
    
    // ========== INÍCIO DA ALTERAÇÃO ==========
    // A lógica '$orderBy = ...' foi removida.
    // ========== FIM DA ALTERAÇÃO ==========


    // --- LÓGICA DE PESQUISA (Original do seu procurar.php) ---
    
    if ($opcao == "id") {
        include("conecta.php");

        $stmt = $pdo->prepare("SELECT * FROM veiculos WHERE id = :id");
        $stmt->bindParam(':id', $campo_pesquisa, PDO::PARAM_INT);
        $stmt->execute();
        $veiculo = $stmt->fetch();

        if ($veiculo) {
            echo "Id: " . htmlspecialchars($veiculo['id']) . "<br>";
            echo "Marca: " . htmlspecialchars($veiculo['marca']) . "<br>";
            echo "Modelo: " . htmlspecialchars($veiculo['modelo']) . "<br>";
            echo "Ano: " . htmlspecialchars($veiculo['ano']) . "<br>";
            echo "<hr>";
        } else {
            echo "Nenhum veículo encontrado com esse ID.";
        }
    }
    
    if($opcao == "marca") {
        include("conecta.php");

        $termo = $campo_pesquisa . "%"; 

        // ========== INÍCIO DA ALTERAÇÃO ==========
        // Removido o 'ORDER BY $orderBy' da consulta
        $stmt = $pdo->prepare("SELECT * FROM veiculos WHERE marca LIKE :marca");
        // ========== FIM DA ALTERAÇÃO ==========
        
        $stmt->bindParam(':marca', $termo);
        $stmt->execute();

        $veiculos = $stmt->fetchAll(); 

        if (count($veiculos) > 0) {
            foreach ($veiculos as $veiculo) {
                echo "Id: " . htmlspecialchars($veiculo['id']) . "<br>";
                echo "Marca: " . htmlspecialchars($veiculo['marca']) . "<br>";
                echo "Modelo: " . htmlspecialchars($veiculo['modelo']) . "<br>";
                echo "Ano: " . htmlspecialchars($veiculo['ano']) . "<br>";
                echo "<hr>";
            }
        } else {
            echo "Nenhum veículo encontrado com essa marca.";
        }
    }
    
    if($opcao == "modelo") {
        include("conecta.php");

        $termo = $campo_pesquisa . "%";

        // ========== INÍCIO DA ALTERAÇÃO ==========
        // Removido o 'ORDER BY $orderBy' da consulta
        $stmt = $pdo->prepare("SELECT * FROM veiculos WHERE modelo LIKE :modelo");
        // ========== FIM DA ALTERAÇÃO ==========
        
        $stmt->bindParam(':modelo', $termo);
        $stmt->execute();

        $veiculos = $stmt->fetchAll();

        if (count($veiculos) > 0) {
            foreach ($veiculos as $veiculo) {
                echo "Id: " . htmlspecialchars($veiculo['id']) . "<br>";
                echo "Marca: " . htmlspecialchars($veiculo['marca']) . "<br>";
                echo "Modelo: " . htmlspecialchars($veiculo['modelo']) . "<br>";
                echo "Ano: " . htmlspecialchars($veiculo['ano']) . "<br>";
                echo "<hr>";
            }
        } else {
            echo "Nenhum veículo encontrado com esse modelo.";
        }
    }
    
} else {
    echo "Por favor, preencha o formulário de pesquisa.";
}
exit;
?>