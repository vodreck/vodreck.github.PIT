<?php

session_start();

include $_SERVER['DOCUMENT_ROOT'] . '/Header/header.php';




$servername = "localhost";
$username = "root";
$password = "thiagobar8";
$database = "usuarios";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$query = "SELECT * FROM usuarios";
$resultado = $conn->query($query);

if ($resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        ?>
        <!DOCTYPE html>
        <html lang="pt-br">
        <head>
            <meta charset="UTF-8">
            <title>Clientes</title>
            <link rel="stylesheet" href="/Clientes/css/style.css">
        </head>
        <body>

            <h2>Informações do Usuário</h2>

            <div class="container mt-5">
            <form  method="post" action="/Clientes/Salvar_Cliente.php">
                <input type="hidden" name="usuario_id" value="<?php echo $row['id']; ?>">
                <div class="form-group">
                    <label for="id_<?php echo $row['id']; ?>">ID:</label>
                    <input type="text" class="form-control" id="id_<?php echo $row['id']; ?>" name="id" value="<?php echo $row['id']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="nome_<?php echo $row['id']; ?>">Nome:</label>
                    <input type="text" class="form-control" id="nome_<?php echo $row['id']; ?>" name="nome" value="<?php echo $row['nome']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="email_<?php echo $row['id']; ?>">Email:</label>
                    <input type="email" class="form-control" id="email_<?php echo $row['id']; ?>" name="email" value="<?php echo $row['email']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="cpf_<?php echo $row['id']; ?>">CPF:</label>
                    <input type="text" class="form-control" id="cpf_<?php echo $row['id']; ?>" name="cpf" value="<?php echo $row['cpf']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="numero_<?php echo $row['id']; ?>">Número:</label>
                    <input type="text" class="form-control" id="numero_<?php echo $row['id']; ?>" name="numero" value="<?php echo $row['numero']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="senha_<?php echo $row['id']; ?>">Senha:</label>
                    <input type="password" class="form-control" id="senha_<?php echo $row['id']; ?>" name="senha" value="<?php echo $row['senha']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="resposta_seguranca_1_<?php echo $row['id']; ?>">Resposta Segurança 1:</label>
                    <input type="text" class="form-control" id="resposta_seguranca_1_<?php echo $row['id']; ?>" name="resposta_seguranca_1" value="<?php echo $row['resposta_seguranca_1']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="resposta_seguranca_2_<?php echo $row['id']; ?>">Resposta Segurança 2:</label>
                    <input type="text" class="form-control" id="resposta_seguranca_2_<?php echo $row['id']; ?>" name="resposta_seguranca_2" value="<?php echo $row['resposta_seguranca_2']; ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </form>
            </div>


        </body>
        </html>
        <?php
    }
} else {
    echo "Nenhum usuário encontrado.";
}
$conn->close();
?>