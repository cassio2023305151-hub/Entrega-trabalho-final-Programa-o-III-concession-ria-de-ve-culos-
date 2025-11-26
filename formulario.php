<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Veículo</title>
    
    <style>
        /* Estilos CSS (sem alteração) */
        body {
             font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
             background-color: #f0f2f5; 
        }
        .form-container {
            background-color: #ffffff;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            margin: 40px auto; 
        }
        h2 { color: #1c1e21; text-align: center; margin-bottom: 25px; }
        .input-group { margin-bottom: 18px; }
        label { display: block; margin-bottom: 6px; font-weight: 600; color: #333; }
        input[type="text"],
        input[type="number"],
        input[type="file"] {
            width: 100%; padding: 10px; border: 1px solid #dddfe2;
            border-radius: 6px; font-size: 16px; box-sizing: border-box;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        input[type="text"]:focus,
        input[type="number"]:focus {
            border-color: #1877f2;
            box-shadow: 0 0 0 2px rgba(24, 119, 242, 0.2);
            outline: none;
        }
        button[type="submit"] {
            width: 100%; padding: 12px; background-color: #1877f2;
            border: none; border-radius: 6px; color: #ffffff;
            font-size: 18px; font-weight: bold; cursor: pointer;
            transition: background-color 0.2s;
        }
        button[type="submit"]:hover { background-color: #166fe5; }
        #mensagem-retorno {
            margin-top: 15px; padding: 10px; border-radius: 6px;
            text-align: center; font-weight: bold; display: block; 
        }
        .sucesso { background-color: #e6ffed; color: #28a745; border: 1px solid #c3e6cb; }
        .erro { background-color: #f8d7da; color: #dc3545; border: 1px solid #f5c6cb; }
    </style>
</head>
<body>

    <div class="form-container">
        <form id="form-cadastro-veiculo" action="inserir_ajax.php" method="POST" enctype="multipart/form-data">
            <h2>Cadastrar Veículo</h2>

            <div class="input-group">
                <label for="marca">Marca:</label>
                <input type="text" id="marca" name="marca" required>
            </div>
            <div class="input-group">
                <label for="modelo">Modelo:</label>
                <input type="text" id="modelo" name="modelo" required>
            </div>
            <div class="input-group">
                <label for="ano">Ano:</label>
                <input type="number" id="ano" name="ano" min="1900" max="2099" step="1" required>
            </div>
            <div class="input-group">
                <label for="imagem">Imagem:</label>
                <input type="file" id="imagem" name="imagem" accept="image/*">
            </div>

            <button type="submit">Cadastrar</button>
            <div id="mensagem-retorno"></div>
        </form>
    </div>

    
    <script>
    $(document).ready(function() {
        
        $('#form-cadastro-veiculo').on('submit', function(e) {
            
            e.preventDefault(); 
            var $form = $(this);
            var $mensagemDiv = $('#mensagem-retorno');
            var formData = new FormData(this);

            $.ajax({
                url: $form.attr('action'), 
                type: 'POST',
                data: formData,
                dataType: 'json', 
                cache: false,
                contentType: false,
                processData: false,

                beforeSend: function() {
                    $mensagemDiv.html('Salvando...').removeClass('erro sucesso');
                },
                
                success: function(response) {
                    if (response.success) {
                        $mensagemDiv.html('Cadastrado com sucesso!').addClass('sucesso');
                        $form[0].reset(); 
                        
                        // ========== INÍCIO DA ALTERAÇÃO ==========
                        // Dispara o evento customizado para a página principal ouvir
                        $(document).trigger('crud:success');
                        // ========== FIM DA ALTERAÇÃO ==========

                    } else {
                        $mensagemDiv.html('Erro: ' + response.message).addClass('erro');
                    }
                },
                
                error: function() {
                    $mensagemDiv.html('Erro de conexão. Tente novamente.').addClass('erro');
                }
            });
        });
    });
    </script>
    </body>
</html>