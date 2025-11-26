<?php
include("conecta.php");

// ========== INÍCIO DA ALTERAÇÃO (JSON) ==========
// Define o cabeçalho como JSON e prepara uma resposta padrão
header('Content-Type: application/json');
$response = [
    'success' => false,
    'message' => 'Ocorreu um erro desconhecido.',
    'novo_caminho_imagem' => null // Informação extra para o JS
];
// ========== FIM DA ALTERAÇÃO (JSON) ==========

try {
    // --- DADOS DO FORMULÁRIO (Lógica original) ---
    $id = $_POST['id'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $ano = $_POST['ano'];

    // 1. Recebe o caminho da imagem que já estava salva (do input hidden)
    $caminho_imagem_atual = $_POST['imagem_atual']; 

    // 2. Define o caminho final da imagem. Por padrão, será o mesmo.
    $caminho_final_da_imagem = $caminho_imagem_atual; 

    // 3. Verifica se um ARQUIVO NOVO foi enviado (Lógica original)
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
        
        // Se uma imagem antiga existia, apaga ela
        if (!empty($caminho_imagem_atual) && file_exists($caminho_imagem_atual)) {
            unlink($caminho_imagem_atual);
        }

        // Processa o upload da NOVA imagem
        $upload_dir = 'uploads/';
        $imagem_temp_path = $_FILES['imagem']['tmp_name'];
        $extensao = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
        $novo_nome_imagem = uniqid('veiculo_') . '.' . $extensao;
        
        $caminho_final_da_imagem = $upload_dir . $novo_nome_imagem;

        // Tenta mover o arquivo novo
        if (!move_uploaded_file($imagem_temp_path, $caminho_final_da_imagem)) {
            // ========== INÍCIO DA ALTERAÇÃO (JSON) ==========
            $response['message'] = "Houve um erro ao salvar a nova imagem. A imagem anterior foi mantida.";
            $caminho_final_da_imagem = $caminho_imagem_atual; // Reverte para a imagem antiga
            // Não damos 'exit' aqui, continuamos para salvar os outros dados
            // ========== FIM DA ALTERAÇÃO (JSON) ==========
        }
    }

    // --- ATUALIZAÇÃO NO BANCO (Lógica original) ---
    $stmt = $pdo->prepare("UPDATE veiculos SET marca = :marca, modelo = :modelo, ano = :ano, imagem = :imagem WHERE id = :id");

    $stmt->bindParam(':marca', $marca);
    $stmt->bindParam(':modelo', $modelo);
    $stmt->bindParam(':ano', $ano);
    $stmt->bindParam(':imagem', $caminho_final_da_imagem);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // ========== INÍCIO DA ALTERAÇÃO (JSON) ==========
    if ($stmt->execute()) {
        $response['success'] = true;
        $response['message'] = 'Veículo atualizado com sucesso!';
        // Envia de volta o novo caminho da imagem, caso ela tenha mudado
        $response['novo_caminho_imagem'] = $caminho_final_da_imagem;
    } else {
        $response['message'] = 'Erro ao salvar as alterações no banco de dados.';
    }
    // ========== FIM DA ALTERAÇÃO (JSON) ==========

} catch (Exception $e) {
    // Captura exceções (ex: erro de conexão)
    $response['message'] = 'Exceção no servidor: ' . $e->getMessage();
}

// ========== INÍCIO DA ALTERAÇÃO (JSON) ==========
// Em vez de redirecionar, imprime a resposta JSON
echo json_encode($response);
exit;
// ========== FIM DA ALTERAÇÃO (JSON) ==========
?>