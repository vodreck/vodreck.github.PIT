<?php
include $_SERVER['DOCUMENT_ROOT'] . '/CadastroProduto/conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $produto_id = $_POST['produto_id'];
    $nome = $_POST['nome'];
    $avaliacao = $_POST['avaliacao'];
    $comentario = $_POST['comentario'];

    $sql = "INSERT INTO comentarios (produto_id, nome, avaliacao, comentario) 
            VALUES ('$produto_id', '$nome', '$avaliacao', '$comentario')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Comentário e avaliação adicionados com sucesso!";
    } else {
        echo "Erro ao adicionar o comentário e avaliação: " . $conn->error;
    }
}

$conn->close();
?>
