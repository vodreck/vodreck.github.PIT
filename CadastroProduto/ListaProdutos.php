<?php
include 'conexao.php';

$sql = "SELECT * FROM produtos";
$result = $conn->query($sql);
?>

<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/Header/header.php';

    ?> 
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/CadastroProduto/css/styleL.css">

    <title>Lista de Produtos</title>


    
</head>
<body>

<h1>LISTA DE PRODUTOS</h1>

<table>
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Descrição</th>
        <th>Preço</th>
        <th>Imagem</th>
    </tr>

    <?php
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
    echo "<td>" . $row["id"]. "</td>";
    echo "<td>" . $row["nome"]. "</td>";
    echo "<td>" . $row["descricao"]. "</td>";
    echo "<td>" . $row["preco"]. "</td>";
    echo "<td><img src='/CadastroProduto/imagens_produtos/" . $row["imagem"] . "' alt='Imagem do produto' class='imagem-produto'></td>";
    echo "</tr>";

}
    ?>

</table>

</body>
</html>
