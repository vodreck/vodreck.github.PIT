<?php
$servername = "localhost";
$username = "root";
$password = "thiagobar8";
$dbname = "estoque";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>
