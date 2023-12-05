<?php
session_start(); 

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php"); 
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h2>Bem-vindo ao Dashboard</h2>
    <p>Seu conteúdo protegido está aqui.</p>
    <a href="logout.php">Sair</a> 
</body>
</html>
