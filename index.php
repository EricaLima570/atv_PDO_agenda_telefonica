<?php
    require "./conexao.php";

    $pdo = Conexao::conectar();
    $result = $pdo->query("SELECT * FROM clientes");

    $dados = $result->fetchAll(); #Existe algum diferença entre fetch e fetchAll

    $nlinhas = count($dados);
    $ncolunas = count($dados[0]) / 2;



?>
<!DOCTYPE html>
<html lang=”pt-br”>
	<head>
		<meta charset=”utf8”>
		<title>Dados em Tabela</title>
	</head>
	<body>

		<table border=”1”>

<$php
for ($i = 1; $i < count($dados); $i++) {	// número de repetições igual ao número de linhas
        echo "<tr>";				// em cada repetição, abrir uma tag <tr> (p/ nova linha na tabela)
        foreach ($dados[$i] as $celula) {	// número de subrepetições igual ao número de colunas
            echo "<td> $celula </td>";		// em cada subrepetição, abrir uma tag <td> (p/ nova célula)
        }
        echo "</tr>";				// antes de encerrar a repetição de linha, fechar a </tr>
    }
?>

</table>
</body>
</html>
