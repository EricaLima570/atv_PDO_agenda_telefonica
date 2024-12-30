<?php
include 'conexao.php';

try {
    $pdo = Conexao::conectar();
    $sql = "SELECT * FROM contatos";
    $stmt = $pdo->query($sql);
    $contatos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "<script>alert('Erro: " . $e->getMessage() . "');</script>";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda de Contatos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            padding: 20px;
        }
        .no-decoration {
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><a href="agenda.php" class="no-decoration">Agenda de Contatos</a></h1>
        <a href="criar.php" class="btn btn-primary mb-3">Novo</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Celular</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($contatos)): ?>
                    <?php foreach ($contatos as $contato): ?>
                    <tr>
                        <td><a href="mostrar.php?id=<?php echo $contato['id']; ?>"><?php echo $contato['nome']; ?></a></td>
                        <td><?php echo $contato['email']; ?></td>
                        <td><?php echo $contato['celular']; ?></td>
                        <td>
                            <a href="atualizar.php?id=<?php echo $contato['id']; ?>" class="btn btn-warning">Alterar</a>
                            <a href="excluir.php?id=<?php echo $contato['id']; ?>" class="btn btn-danger">Excluir</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">Nenhum contato encontrado.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
