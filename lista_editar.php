<?php
include("conecta.php");
// === ADICIONE ESTA LINHA NO TOPO ===
include("protecao.php"); 
// ===================================


// A consulta já busca todas as colunas, incluindo 'imagem'
$stmt = $pdo->prepare("SELECT * FROM veiculos");
$stmt->execute();
$veiculos = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Veículos</title>
    <link rel="stylesheet" href="estilo.css">
    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    
    <style>
        /* Preview flutuante (sem alteração) */
        .modelo-com-imagem {
            position: relative;
            cursor: default;
        }
        .modelo-com-imagem .imagem-preview {
            display: none;
            position: absolute;
            top: 5px;        
            left: 105%;      
            transform: none; 
            margin-bottom: 0; 
            width: 150px;
            height: auto;
            border: 3px solid white;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.3);
            z-index: 10;
        }
        .modelo-com-imagem:hover .imagem-preview {
            display: block;
        }

        /* Estilos dos links de ação na tabela */
        .link-acao {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 0.9em;
            font-weight: bold;
            transition: all 0.2s ease-in-out;
            margin-bottom: 5px; 
        }

        /* ========== INÍCIO DA ALTERAÇÃO (CSS) ========== */
        .link-editar {
            background-color: #ffc107;
            color: #212529;
            margin-right: 5px; /* Editar tem margem */
        }
        .link-editar:hover {
            background-color: #e0a800;
        }
        .link-excluir {
            background-color: #dc3545;
            color: #ffffff;
            margin-right: 5px; /* Excluir agora tem margem */
        }
        .link-excluir:hover {
            background-color: #c82333;
        }
        .link-ver {
            background-color: #007bff; /* Azul */
            color: #ffffff;
            /* margin-right: 5px; FOI REMOVIDO DAQUI */
        }
        .link-ver:hover {
            background-color: #0056b3;
        }
        /* ========== FIM DA ALTERAÇÃO (CSS) ========== */

    </style>
</head>
<body>
	<div style="text-align: right; margin-bottom: 10px;">
    Olá, <?php echo $_SESSION['email_usuario']; ?> | 
    <a href="logout.php" style="color: red; text-decoration: none; font-weight: bold;">Sair</a>
	</div>



    <div class="page-content-wrapper"> 
        <h2>Lista de Veículos Cadastrados</h2>

        <a href="formulario.php" class="nav-link">Adicionar Veículo</a>
		<a href="dashboard.php" class="nav-link">&larr; Painel de Controle</a>
        <a href="procurar.php" class="nav-link">Pesquisar Veículo</a>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Ano</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($veiculos as $veiculo): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($veiculo['id']); ?></td>
                            <td><?php echo htmlspecialchars($veiculo['marca']); ?></td>
                            
                            <td class="modelo-com-imagem">
                                <?php echo htmlspecialchars($veiculo['modelo']); ?>
                                <?php if (!empty($veiculo['imagem'])): ?>
                                    <img src="<?php echo htmlspecialchars($veiculo['imagem']); ?>" alt="Preview" class="imagem-preview">
                                <?php endif; ?>
                            </td>
                            
                            <td><?php echo htmlspecialchars($veiculo['ano']); ?></td>
                            
                            <td>
                                <a href="editar.php?id=<?php echo $veiculo['id']; ?>" class="link-acao link-editar">Editar</a>
                                
                                <a href="#" 
                                   class="link-acao link-excluir" 
                                   data-id="<?php echo $veiculo['id']; ?>">Excluir</a>

                                <?php 
                                if (!empty($veiculo['imagem']) && file_exists($veiculo['imagem'])): 
                                ?>
                                    <a href="<?php echo htmlspecialchars($veiculo['imagem']); ?>" 
                                       target="_blank" 
                                       class="link-acao link-ver">Ver Imagem</a>
                                <?php endif; ?>
                                </td>
                            </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div> 


    <div id="modal-container" class="modal-overlay">
        <div class="modal-content">
            <button id="modal-fechar" class="modal-close-btn">&times;</button>
            <div id="modal-corpo">
                </div>
        </div>
    </div>


    <script>
    $(document).ready(function() {
        
        var $modalContainer = $('#modal-container');
        var $modalCorpo = $('#modal-corpo');
        var $modalFechar = $('#modal-fechar');

        function abrirModal() {
            $modalContainer.css('display', 'flex'); 
        }

        function fecharModal() {
            $modalCorpo.html(''); 
            $modalContainer.hide(); 
        }

        $modalFechar.on('click', fecharModal);
        $modalContainer.on('click', function(e) {
            if ($(e.target).is($modalContainer)) {
                fecharModal();
            }
        });

        // --- Evento: Clicar em "Adicionar Veículo" ---
        $('a.nav-link[href="formulario.php"]').on('click', function(e) {
            e.preventDefault(); 
            $modalCorpo.load('formulario.php', function() {
                abrirModal();
            });
        });

        // --- Evento: Clicar em "Pesquisar Veículo" ---
        $('a.nav-link[href="procurar.php"]').on('click', function(e) {
            e.preventDefault(); 
            $modalCorpo.load('procurar.php', function() {
                abrirModal();
            });
        });


        // --- Evento: Clicar em "Editar" na tabela ---
        $('.table-container').on('click', 'a.link-editar', function(e) {
            e.preventDefault(); 
            var urlEditar = $(this).attr('href'); 
            $modalCorpo.load(urlEditar, function() {
                abrirModal();
            });
        });


        // --- Lógica para DELETAR ---
        $('.table-container').on('click', 'a.link-excluir', function(e) {
            e.preventDefault(); 
            if (!confirm('Tem certeza que deseja excluir?')) return false;

            var $link = $(this);
            var id = $link.data('id');
            var $linhaParaRemover = $link.closest('tr'); 

            $.ajax({
                url: 'deletar_ajax.php',
                type: 'POST',
                data: { id: id },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        $linhaParaRemover.fadeOut(500, function() { $(this).remove(); });
                    } else {
                        alert('Erro ao excluir: ' + response.message);
                    }
                },
                error: function() {
                    alert('Erro de conexão. Tente novamente.');
                }
            });
        });


        // --- Listener para Adicionar/Editar ---
        $(document).on('crud:success', function() {
            
            setTimeout(function() {
                fecharModal();
                location.reload(); 
            }, 1000); 
        });

    });
    </script>

</body>
</html>