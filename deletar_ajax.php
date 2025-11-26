<?php
include("conecta.php");

// ========== INÍCIO DA ALTERAÇÃO (JSON) ==========
header('Content-Type: application/json');
$response = [
    'success' => false,
    'message' => 'ID não informado.'
];
// ========== FIM DA ALTERAÇÃO (JSON) ==========

// ========== INÍCIO DA ALTERAÇÃO (POST) ==========
// Usamos $_POST pois o AJAX enviou como POST
if (isset($_POST['id'])) {
    $id = $_POST['id'];
// ========== FIM DA ALTERAÇÃO (POST) ==========

    try {
        // BÔNUS: Antes de deletar, vamos buscar a imagem para apagá-la
        $stmt_img = $pdo->prepare("SELECT imagem FROM veiculos WHERE id = :id");
        $stmt_img->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt_img->execute();
        $veiculo = $stmt_img->fetch(PDO::FETCH_ASSOC);

        if ($veiculo && !empty($veiculo['imagem']) && file_exists($veiculo['imagem'])) {
            unlink($veiculo['imagem']); // Apaga o arquivo de imagem do servidor
        }

        // Prepara a exclusão (lógica original)
        $stmt = $pdo->prepare("DELETE FROM veiculos WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        
        // ========== INÍCIO DA ALTERAÇÃO (JSON) ==========
        if ($stmt->execute()) {
            // Sucesso!
            $response['success'] = true;
            $response['message'] = 'Veículo excluído com sucesso.';
        } else {
            $response['message'] = 'Erro ao executar a exclusão no banco.';
        }
        // ========== FIM DA ALTERAÇÃO (JSON) ==========

    } catch (Exception $e) {
        $response['message'] = 'Erro no servidor: ' . $e->getMessage();
    }
}

// ========== INÍCIO DA ALTERAÇÃO (JSON) ==========
// Em vez de redirecionar, imprime a resposta JSON
echo json_encode($response);
exit;
// ========== FIM DA ALTERAÇÃO (JSON) ==========
?>