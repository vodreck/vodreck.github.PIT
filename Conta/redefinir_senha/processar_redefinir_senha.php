<?php
include $_SERVER['DOCUMENT_ROOT'] . '/Conta/SQL/conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? null;
    $cpf = $_POST['CPF'] ?? null;
    $resposta1 = $_POST['resposta1'] ?? null;
    $resposta2 = $_POST['resposta2'] ?? null;

    $verificacao_sql = "SELECT id, resposta_seguranca_1, resposta_seguranca_2 FROM usuarios WHERE email = ? AND cpf = ?";
    
    $stmt = $conn->prepare($verificacao_sql);
    $stmt->bind_param("ss", $email, $cpf);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($usuario_id, $resposta_seguranca_1_db, $resposta_seguranca_2_db);
        $stmt->fetch();

       

        if ($resposta1 === $resposta_seguranca_1_db && $resposta2 === $resposta_seguranca_2_db) {
            $nova_senha = $_POST['nova_senha'] ?? null;
            $confirmar_nova_senha = $_POST['confirmar_nova_senha'] ?? null;

           

            if ($nova_senha == $confirmar_nova_senha) {
                $hashed_password = password_hash($nova_senha, PASSWORD_DEFAULT);

               

                $update_sql = "UPDATE usuarios SET senha = ? WHERE id = ?";
                
                $stmt = $conn->prepare($update_sql);
                $stmt->bind_param("si", $hashed_password, $usuario_id);
                $stmt->execute();

                header("Location: redefinirsenha.php?message=success");
                exit();
            } else {
                header("Location: redefinirsenha.php?message=password_mismatch");
                exit();
            }
        } else {
            header("Location: redefinirsenha.php?message=invalid_answers");
            exit();
        }
    } else {
        header("Location: redefinirsenha.php?message=invalid_user");
        exit();
    }
}
?>
