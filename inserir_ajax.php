<?php
include("conecta.php");

// ========== INÍCIO DA ALTERAÇÃO (JSON) ==========
// Define o cabeçalho como JSON e prepara uma resposta padrão
header('Content-Type: application/json');
$response = [
    'success' => false,
    'message' => 'Ocorreu um erro desconhecido.'
];
// ========== FIM DA ALTERAÇÃO (JSON) ==========

try {
    // 1. RECEBER DADOS DO FORMULÁRIO (Lógica original)
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $ano = $_POST['ano'];
    $caminho_final_da_imagem = null; 

    // 2. PROCESSAR O UPLOAD DA IMAGEM (Lógica original)
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
        
        $upload_dir = 'uploads/'; 
        
        $imagem_temp_path = $_FILES['imagem']['tmp_name'];
        $extensao = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
        $novo_nome_imagem = uniqid('veiculo_') . '.' . $extensao;

        $caminho_final_da_imagem = $upload_dir . $novo_nome_imagem;

        if (!move_uploaded_file($imagem_temp_path, $caminho_final_da_imagem)) {
            // ========== INÍCIO DA ALTERAÇÃO (JSON) ==========
            // Em vez de 'echo', define a mensagem de erro e para
            $response['message'] = "Houve um erro ao salvar a imagem.";
            echo json_encode($response);
            exit; 
            // ========== FIM DA ALTERAÇÃO (JSON) ==========
        }
    }

    // 3. INSERIR NO BANCO DE DADOS (Lógica original)
    $stmt = $pdo->prepare("INSERT INTO veiculos (marca, modelo, ano, imagem) VALUES (:marca, :modelo, :ano, :imagem)");
    
    $stmt->bindParam(':marca', $marca);
    $stmt->bindParam(':modelo', $modelo);
    $stmt->bindParam(':ano', $ano);
    $stmt->bindParam(':imagem', $caminho_final_da_imagem);

    // ========== INÍCIO DA ALTERAÇÃO (JSON) ==========
    if ($stmt->execute()) {
        // Sucesso
        $response['success'] = true;
        $response['message'] = 'Veículo cadastrado com sucesso.';
    } else {
        // Erro no banco
        $response['message'] = 'Erro ao salvar no banco de dados.';
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