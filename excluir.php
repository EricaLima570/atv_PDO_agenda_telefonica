<?php
include 'conexao.php';

try {
    $pdo = Conexao::conectar();

    
    if (isset($_GET['id'])) {
        $id = intval($_GET['id']); 
    } else {
        
        $id = 1; // Exemplo de ID fixo
    }

    // Preparação da query SQL que fará a exclusão
    $sql = "DELETE FROM contatos WHERE id = :id";
    $stmt = $pdo->prepare($sql);

    
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

  
    if ($stmt->execute()) {
        echo "<script>alert('Registro excluído com sucesso!');</script>";
    } else {
        echo "<script>alert('Erro ao excluir registro.');</script>";
    }

} catch (PDOException $e) {
    echo "<script>alert('Erro: " . $e->getMessage() . "');</script>";
}
?>
