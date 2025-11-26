<?php
include("protecao.php"); // Protege a página
include("conecta.php");

// 1. Total de Veículos
$stmt = $pdo->query("SELECT COUNT(*) as total FROM veiculos");
$total_veiculos = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

// 2. Veículo mais novo
$stmt = $pdo->query("SELECT modelo, ano FROM veiculos ORDER BY ano DESC LIMIT 1");
$veiculo_novo = $stmt->fetch(PDO::FETCH_ASSOC);

// 3. Contagem por Marca (Top 3)
$stmt = $pdo->query("SELECT marca, COUNT(*) as qtd FROM veiculos GROUP BY marca ORDER BY qtd DESC LIMIT 3");
$marcas_top = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <style>
        body { font-family: sans-serif; background-color: #f0f2f5; padding: 20px; }
        .container { max-width: 1000px; margin: 0 auto; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
        .btn-sair { color: red; text-decoration: none; font-weight: bold; }
        
        .cards-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; }
        
        .card { background: white; padding: 25px; border-radius: 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .card h3 { margin-top: 0; color: #555; font-size: 16px; }
        .card .numero { font-size: 36px; font-weight: bold; color: #1877f2; margin: 10px 0; }
        .card .detalhe { font-size: 14px; color: #888; }

        .lista-marcas { list-style: none; padding: 0; }
        .lista-marcas li { display: flex; justify-content: space-between; padding: 5px 0; border-bottom: 1px solid #eee; }

        .acoes { margin-top: 40px; text-align: center; }
        .btn-grande { background-color: #1877f2; color: white; padding: 15px 30px; text-decoration: none; border-radius: 8px; font-size: 18px; }
        .btn-grande:hover { background-color: #166fe5; }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h1>Painel de Controle</h1>
        <div>
            Olá, <?php echo $_SESSION['email_usuario']; ?> | 
            <a href="logout.php" class="btn-sair">Sair</a>
        </div>
    </div>

    <div class="cards-grid">
        <div class="card">
            <h3>Total de Veículos</h3>
            <div class="numero"><?php echo $total_veiculos; ?></div>
            
        </div>

        <div class="card">
            <h3>Carro Mais Novo(Ano)</h3>
            <?php if($veiculo_novo): ?>
                <div class="numero"><?php echo $veiculo_novo['ano']; ?></div>
                <div class="detalhe"><?php echo $veiculo_novo['modelo']; ?></div>
            <?php else: ?>
                <div class="detalhe">Nenhum veículo</div>
            <?php endif; ?>
        </div>

        <div class="card">
            <h3>Marcas Populares</h3>
            <ul class="lista-marcas">
                <?php foreach($marcas_top as $m): ?>
                    <li>
                        <span><?php echo $m['marca']; ?></span>
                        <strong><?php echo $m['qtd']; ?></strong>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

    <div class="acoes">
        <a href="lista_editar.php" class="btn-grande">Gerenciar Veículos (Lista)</a>
    </div>
</div>

</body>
</html>