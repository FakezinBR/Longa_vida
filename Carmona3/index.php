<?php
include('conexao.php');

$plano = null;
$msg = "";

if (isset($_GET['buscar']) && !empty($_GET['numero'])) {
    $numero = $_GET['numero'];
    
    $sql = "SELECT * FROM plano WHERE numero = '$numero'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $plano = $result->fetch_assoc();
    } else {
        $msg = "Plano não encontrado!";
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['inserir'])) {
    $numero = $_POST['numero'];
    $descricao = $_POST['descricao'];
    $valor = $_POST['valor'];

    $sql = "INSERT INTO plano (numero, descricao, valor) VALUES ('$numero', '$descricao', '$valor')";
    if ($conn->query($sql) === TRUE) {
        header('Location: index.php?msg=Plano inserido com sucesso!');
        exit;
    } else {
        echo "Erro ao inserir plano: " . $conn->error;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['alterar'])) {
    $plan_codigo = $_POST['plan_codigo'];
    $numero = $_POST['numero'];
    $descricao = $_POST['descricao'];
    $valor = $_POST['valor'];

    $sql = "UPDATE plano SET numero='$numero', descricao='$descricao', valor='$valor' WHERE plan_codigo='$plan_codigo'";
    if ($conn->query($sql) === TRUE) {
        header('Location: index.php?msg=Plano alterado com sucesso!');
        exit;
    } else {
        echo "Erro ao alterar plano: " . $conn->error;
    }
}

if (isset($_GET['excluir'])) {
    $plan_codigo = $_GET['excluir'];

    $sql = "DELETE FROM plano WHERE plan_codigo='$plan_codigo'";
    if ($conn->query($sql) === TRUE) {
        header('Location: index.php?msg=Plano excluído com sucesso!');
        exit;
    } else {
        echo "Erro ao excluir plano: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Planos</title>
</head>
<body>

<h1>Gerenciamento de Planos</h1>

<?php if (isset($_GET['msg'])) { echo "<p><strong>" . $_GET['msg'] . "</strong></p>"; } ?>
<?php if ($msg) { echo "<p><strong>$msg</strong></p>"; } ?>

<h2>Buscar Plano</h2>
<form action="index.php" method="GET">
    <label for="numero_busca">Número do Plano:</label>
    <input type="text" name="numero" id="numero_busca" value="<?php echo isset($_GET['numero']) ? $_GET['numero'] : ''; ?>" required>
    <button type="submit" name="buscar">Buscar</button>
</form>

<hr>

<h2>Inserir ou Alterar Plano</h2>
<form action="index.php" method="POST">
    <input type="hidden" name="plan_codigo" id="plan_codigo" value="<?php echo isset($plano['plan_codigo']) ? $plano['plan_codigo'] : ''; ?>">

    <label for="numero">Número:</label>
    <input type="text" name="numero" id="numero" value="<?php echo isset($plano['numero']) ? $plano['numero'] : ''; ?>" required><br><br>

    <label for="descricao">Descrição:</label>
    <input type="text" name="descricao" id="descricao" value="<?php echo isset($plano['descricao']) ? $plano['descricao'] : ''; ?>" required><br><br>

    <label for="valor">Valor:</label>
    <input type="number" name="valor" id="valor" value="<?php echo isset($plano['valor']) ? $plano['valor'] : ''; ?>" step="0.01" required><br><br>

    <?php if ($plano) { ?>
        <button type="submit" name="alterar">Alterar Plano</button>
        <a href="index.php?excluir=<?php echo $plano['plan_codigo']; ?>" onclick="return confirm('Você tem certeza que deseja excluir?');"><button type="button">Excluir Plano</button></a>
    <?php } else { ?>
        <button type="submit" name="inserir">Inserir Plano</button>
    <?php } ?>
</form>

</body>
</html>
