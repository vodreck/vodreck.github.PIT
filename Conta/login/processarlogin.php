<?php
session_start();

include $_SERVER['DOCUMENT_ROOT'] . '/Conta/SQL/conexao.php';
require_once '/xampp/htdocs/session_start/session.php'; 

$message = ''; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? null;
    $senha = $_POST['senha'] ?? null;

    $sql = "SELECT * FROM usuarios WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($senha, $row['senha'])) {
            
            loginUsuario($row['id']); 
            header("Location: dashboard.php");
            exit();
        } else {
            $message = "Senha incorreta.";
        }
    } else {
        $message = "Email não encontrado.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Processando Login</title>
    <style>
        .message {
            background-color: #F1CFA7;
            padding: 20px;
            border-radius: 5px;
            text-align: center;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            margin-top: 20px;
        }
        .message-box {
            color: red;
        }
    </style>
</head>
<body>
    <?php if (!empty($message)) : ?>
        <div class="message">
            <div class="message-box">
                <?php echo $message; ?>
            </div>
        </div>
    <?php endif; ?>
</body>
</html>
