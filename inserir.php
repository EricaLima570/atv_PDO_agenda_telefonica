<?php
include 'conexao.php';
include 'criar.php';

try {
    $pdo = Conexao::conectar();
    echo "Conexão estabelecida com sucesso.<br>";

    
    if (!empty($_POST['nome']) && !empty($_POST['email']) && !empty($_POST['celular'])) {
      
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $celular = $_POST['celular'];

 
        $sql = "INSERT INTO contatos (nome, email, celular) VALUES (:nome, :email, :celular)";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':celular', $celular);

        // Executar a query preparada:
        if ($stmt->execute()) {
            echo "<script>alert('Dados inseridos com sucesso!'); window.location.href = 'agenda.php';</script>";
        } else {
            echo "<script>alert('Erro ao inserir dados.');</script>";
        }
    } else {
        echo "Dados não enviados corretamente.<br>";
    }

} catch (PDOException $e) {
    echo "<script>alert('Erro: " . $e->getMessage() . "');</script>";
}
?>
