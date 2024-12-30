<?php
include 'conexao.php';

try {
    $conexao = Conexao::conectar();
    echo "<script>alert('Conexão com o banco de dados bem-sucedida!');</script>";
} catch (PDOException $e) {
    echo "<script>alert('Falha na conexão: " . $e->getMessage() . "');</script>";
}
?>
