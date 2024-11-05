<?php
include('conexao.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['inserir'])) {
    $numero = $_POST['numero'];
    $descricao = $_POST['descricao'];
    $valor = $_POST['valor'];


    $sql = "INSERT INTO plano (numero, descricao, valor) VALUES ('$numero', '$descricao', '$valor')";
    
    if ($conn->query($sql) === TRUE) {
        header('Location: index.php?msg=Plano inserido com sucesso!');
    } else {
        header('Location: index.php?msg=Erro ao inserir o plano: ' . $conn->error);
    }
}

$conn->close();
?>
