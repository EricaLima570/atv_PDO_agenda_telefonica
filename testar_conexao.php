<?php
//arquivo de conexao de Diego 

include 'Conexao.php';

$db = Conexao::conectar();

if ($db instanceof PDO) {
    echo "Conexão estabelecida com sucesso!";
} else {
    echo "Conexão falhou. A instância retornada não é válida.";
}

