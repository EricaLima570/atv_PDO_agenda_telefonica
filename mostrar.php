<?php
include 'conexao.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    try {
        $pdo = Conexao::conectar();
        $sql = "SELECT * FROM contatos WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $contato = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$contato) {
            echo "<script>alert('Contato não encontrado.'); window.location.href = 'agenda.php';</script>";
            exit;
        }
    } catch (PDOException $e) {
        echo "<script>alert('Erro: " . $e->getMessage() . "');</script>";
    }
} else {
    echo "<script>alert('ID não fornecido.'); window.location.href = 'agenda.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda de Contatos - Mostrar Contato</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .no-decoration {
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><a href="agenda.php" class="no-decoration">Agenda de Contatos</a></h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?php echo $contato['nome']; ?></h5>
                <p class="card-text"><strong>Email:</strong> <?php echo $contato['email']; ?></p>
                <p class="card-text"><strong>Celular:</strong> <?php echo $contato['celular']; ?></p>
                <a href="atualizar.php?id=<?php echo $id; ?>" class="btn btn-warning">Alterar</a>
                <a href="excluir.php?id=<?php echo $id; ?>" class="btn btn-danger">Excluir</a>
                <a href="agenda.php?id=<?php echo $id; ?>"class="btn btn-secondary btn-custom">Home</a>

            </div>
        </div>
    </div>
</body>
</html>
