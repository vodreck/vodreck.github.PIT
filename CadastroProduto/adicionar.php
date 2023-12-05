<?php

session_start();

include $_SERVER['DOCUMENT_ROOT'] . '/Header/header.php';



include 'conexao.php';

$mensagemSucesso = $mensagemErro = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['adicionar'])) {
        $nome = $_POST['nome'];
        $descricao = $_POST['descricao'];
        $preco = $_POST['preco'];

        if (!empty($nome) && !empty($descricao) && !empty($preco) && isset($_FILES['imagem'])) {
            $imagem = $_FILES['imagem'];
            $imagem_nome = $imagem['name'];
            $imagem_temp = $imagem['tmp_name'];

            $allowed_extensions = array('jpg', 'jpeg', 'png', 'gif');
            $ext = pathinfo($imagem_nome, PATHINFO_EXTENSION);
            if (in_array($ext, $allowed_extensions)) {
                $diretorio_destino = 'imagens_produtos/';

                $imagem_nome_unica = uniqid() . '_' . $imagem_nome;

                if (move_uploaded_file($imagem_temp, $diretorio_destino . $imagem_nome_unica)) {
                    $sql = "INSERT INTO produtos (nome, descricao, preco, imagem) VALUES (?, ?, ?, ?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("ssss", $nome, $descricao, $preco, $imagem_nome_unica);

                    if ($stmt->execute()) {
                        $mensagemSucesso = "Produto adicionado com sucesso!";
                    } else {
                        $mensagemErro = "Erro ao adicionar produto: " . $conn->error;
                    }
                } else {
                    $mensagemErro = "Erro ao mover a imagem para o diretório de destino.";
                }
            } else {
                $mensagemErro = "Tipo de arquivo de imagem não suportado. Use JPG, JPEG, PNG ou GIF.";
            }
        } else {
            $mensagemErro = "Todos os campos devem ser preenchidos e uma imagem deve ser selecionada.";
        }
    }

    if (isset($_POST['remover'])) {
        $ids = $_POST['ids'];
    
        if (!empty($ids)) {
            $id_array = explode(',', $ids);
    
            foreach ($id_array as $id) {
                $sql = "DELETE FROM produtos WHERE id=?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $id);
    
                if ($stmt->execute()) {
                    $mensagemSucesso .= "Produto com ID $id removido com sucesso!<br>";
                } else {
                    $mensagemErro .= "Erro ao remover produto com ID $id: " . $conn->error . "<br>";
                }
            }
        } else {
            $mensagemErro .= "Nenhum ID foi especificado para remover.<br>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/CadastroProduto/css/styleA.css">
    
    <title>Adicionar/Remover Produtos</title>
    <script>
        function formatarPreco(input) {
            let valor = input.value;
            
            valor = valor.replace(/[^\d,.]/g, '');
            
            valor = valor.replace('.', ',');
            
            input.value = valor;
        }

        function validarNome(input) {
            let nome = input.value.trim();
            
            if (!/[a-zA-Z]/.test(nome)) {
                input.setCustomValidity("O nome deve conter pelo menos uma letra.");
            } else {
                input.setCustomValidity("");
            }
        }
    </script>
 
</head>
<body>

<div class="container">
<h2>Adicionar Produto</h2>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
    <span>Nome:</span> <input type="text" name="nome" required oninput="validarNome(this)"><br>
    <span>Descrição:</span> <input type="text" name="descricao"><br>
    <span>Preço:</span> <input type="text" name="preco"><br>
    <span>Imagem:</span> <input type="file" name="imagem" accept="image/*" required><br>
    <input type="submit" name="adicionar" value="Adicionar Produto">
</form>


<h2>Remover Produto</h2>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <span>IDs (separados por vírgulas):</span> <input type="text" name="ids"><br>
    <input type="submit" name="remover" value="Remover Produto(s)">
</form>
</div>

<?php
if (!empty($mensagemSucesso)) {
    echo '<p class="success-message">' . $mensagemSucesso . '</p>';
}

if (!empty($mensagemErro)) {
    echo '<p class="error-message">' . $mensagemErro . '</p>';
}
?>
</body>
</html>
