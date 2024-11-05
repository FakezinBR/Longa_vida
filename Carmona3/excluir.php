<?php
include('conexao.php');

if (isset($_GET['plan_codigo'])) {
    $plan_codigo = $_GET['plan_codigo'];


    $sql = "DELETE FROM plano WHERE plan_codigo='$plan_codigo'";
    
    if ($conn->query($sql) === TRUE) {
        header('Location: index.php?msg=Plano excluído com sucesso!');
    } else {
        header('Location: index.php?msg=Erro ao excluir o plano: ' . $conn->error);
    }
}

$conn->close();
?>
