<?php
include('conexao.php');


$sql = "SELECT * FROM plano";
$result = $conn->query($sql);


$planos = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $planos[] = $row;
    }
}

$conn->close();
?>
