<?php
$servername = "localhost";
$username = "root";
$password = "senha123";
$database = "usuarios";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $usuario_id = $_POST['usuario_id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $cpf = $_POST['cpf'];
    $numero = $_POST['numero'];
    $senha = $_POST['senha'];
    $resposta_seguranca_1 = $_POST['resposta_seguranca_1'];
    $resposta_seguranca_2 = $_POST['resposta_seguranca_2'];


    $sql = "UPDATE usuarios SET nome='$nome', email='$email', cpf='$cpf', numero='$numero', senha='$senha', resposta_seguranca_1='$resposta_seguranca_1', resposta_seguranca_2='$resposta_seguranca_2' WHERE id='$usuario_id'";

    if ($conn->query($sql) === TRUE) {
        echo "Dados atualizados com sucesso!";
    } else {
        echo "Erro ao atualizar dados: " . $conn->error;
    }
}

$conn->close();
?>
