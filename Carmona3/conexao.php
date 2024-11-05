<?php
$host = 'localhost'; 
$dbname = 'Longa_vida';
$username = 'root'; 
$password = '';    


$conn = new mysqli($host, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>
