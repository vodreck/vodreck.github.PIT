<?php
$servername = "localhost"; 
$username = "root"; 
$password = "senha123"; 
$database = "estoque"; 

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>
