<form action="buscar_veiculos_ajax.php" method="GET" id="form-pesquisa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesquisar Veículo</title>
    <link rel="stylesheet" href="estilo-pesquisa.css">
    
</head>
   
    <fieldset>
        <legend>Selecione o tipo de pesquisa:</legend>

        <input type="radio" id="por_id" name="tipo_pesquisa" value="id" >
        <label for="por_id">ID(pesquise pelo ID exato)</label><br>

        <input type="radio" id="por_marca" name="tipo_pesquisa" value="marca">
        <label for="por_marca">Marca(pesquise pela marca)</label><br>

        <input type="radio" id="por_modelo" name="tipo_pesquisa" value="modelo" checked>
        <label for="por_modelo">Modelo(pesquise pelo modelo)</label><br>
    </fieldset>

    <input type="text" name="campo_pesquisa" placeholder="Digite sua pesquisa aqui" required>

    <button type="submit">Pesquisar</button>
</form>

<div class="results-container" id="resultados-ajax">
    </div>


<script>
$(document).ready(function() {
    $('#form-pesquisa').on('submit', function(e) {
        
        e.preventDefault();

        var $form = $(this);
        var url = $form.attr('action');
        var formData = $form.serialize(); 

        $.ajax({
            url: url,
            type: 'GET',
            data: formData,
            
            beforeSend: function() {
                $('#resultados-ajax').html('Carregando...');
            },
            
            success: function(responseHtml) {
                $('#resultados-ajax').html(responseHtml);
            },
            
            error: function() {
                $('#resultados-ajax').html('<p style="color:red;">Erro ao buscar. Tente novamente.</p>');
            }
        });
    });
});
</script>