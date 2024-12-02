<?php

require "./conexao.php";
$pdo = Conexao::conectar();
// Dados a serem inseridos na tabela "contatos" : 


//super global referente ao que vem do html 

$nome = $_POST['nome'];
$dt_nasc = $_POST['dt_nasc'];

$sql = "INSERT INTO clientes (nome,dt_nasc)
VALUES ( :nome, :dt_nasc)";
$stmt = $pdo->prepare($sql);

// Bind dos valores nos placeholders

$stmt->bindParam(':nome', $nome);
$stmt->bindParam(':dt_nasc', $dt_nasc);


// Executar a query preparada:
if ($stmt->execute()) {
    echo "Dados inseridos com sucesso!";
} else {
    echo "Erro ao inserir dados.";
}