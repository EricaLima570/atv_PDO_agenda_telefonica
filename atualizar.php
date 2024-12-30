<?php
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Código para atualizar os dados do contato
    if (isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['celular']) && isset($_GET['id'])) {
        $id = intval($_GET['id']);
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $celular = $_POST['celular'];

        try {
            $pdo = Conexao::conectar();
            $sql = "UPDATE contatos SET nome = :nome, email = :email, celular = :celular WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':celular', $celular);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            
            if ($stmt->execute()) {
                echo "<script>alert('Contato atualizado com sucesso!'); window.location.href = 'agenda.php';</script>";
            } else {
                echo "<script>alert('Erro ao atualizar o contato.');</script>";
            }
        } catch (PDOException $e) {
            echo "<script>alert('Erro: " . $e->getMessage() . "');</script>";
        }
    } else {
        echo "<script>alert('Dados insuficientes para atualizar o contato.'); window.location.href = 'agenda.php';</script>";
    }
} else {
    // Código para carregar os dados do contato
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
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda de Contatos - Atualizar Contato</title>
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
        <form method="POST" action="atualizar.php?id=<?php echo $id; ?>">
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $contato['nome']; ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $contato['email']; ?>" required>
            </div>
            <div class="form-group">
                <label for="celular">Celular</label>
                <input type="text" class="form-control" id="celular" name="celular" value="<?php echo $contato['celular']; ?>" required>
            </div>
            <button type="submit" class="btn btn-warning">Alterar</button>
        </form>
    </div>
</body>
</html>
