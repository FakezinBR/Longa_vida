<?php
include('conexao.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['alterar'])) {
    $plan_codigo = $_POST['plan_codigo'];
    $numero = $_POST['numero'];
    $descricao = $_POST['descricao'];
    $valor = $_POST['valor'];


    $sql = "UPDATE plano SET numero='$numero', descricao='$descricao', valor='$valor' WHERE plan_codigo='$plan_codigo'";
    
    if ($conn->query($sql) === TRUE) {
        header('Location: index.php?msg=Plano alterado com sucesso!');
    } else {
        header('Location: index.php?msg=Erro ao alterar o plano: ' . $conn->error);
    }
}

$conn->close();
?>
