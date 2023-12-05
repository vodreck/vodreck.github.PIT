<?php

$servername = "localhost";
$username = "root";
$password = "senha123";
$dbname = "estoque";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

include $_SERVER['DOCUMENT_ROOT'] . '/Header/header.php';


function escapeString($conn, $value) {
    return $conn->real_escape_string($value);
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_id'])) {
    $delete_id = escapeString($conn, $_POST['delete_id']);

    $delete_sql = "DELETE FROM pedidos WHERE id = $delete_id";

    if ($conn->query($delete_sql) === TRUE) {
        echo "Pedido apagado com sucesso!";
    } else {
        echo "Erro ao apagar o pedido: " . $conn->error;
    }

   
  
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $cliente_nome = escapeString($conn, $_POST['cliente_nome']);
    $produto_id = intval($_POST['produto_id']); 
    $quantidade = intval($_POST['quantidade']);
    

    $servername_produtos = "localhost";
    $username_produtos = "root";
    $password_produtos = "senha123";
    $dbname_produtos = "estoque"; 

    $conn_produtos = new mysqli($servername_produtos, $username_produtos, $password_produtos, $dbname_produtos);

    if ($conn_produtos->connect_error) {
        die("Erro de conexão com o banco de dados de produtos: " . $conn_produtos->connect_error);
    }

 
    $produto_sql = "SELECT nome, preco FROM produtos WHERE id = $produto_id";
    $produto_result = $conn_produtos->query($produto_sql);

    if ($produto_result->num_rows > 0) {
        $row = $produto_result->fetch_assoc();
        $produto_nome = $row['nome'];
        $preco_produto = $row['preco'];
        $valor_total = $preco_produto * $quantidade;


$servername_usuarios = "localhost";
$username_usuarios = "root";
$password_usuarios = "senha123";
$dbname_usuarios = "usuarios"; 

$conn_usuarios = new mysqli($servername_usuarios, $username_usuarios, $password_usuarios, $dbname_usuarios);

if ($conn_usuarios->connect_error) {
    die("Erro de conexão com o banco de dados de clientes: " . $conn_usuarios->connect_error);
}


$cliente_sql = "SELECT id FROM usuarios WHERE nome = '$cliente_nome'";
$cliente_result = $conn_usuarios->query($cliente_sql);

if ($cliente_result->num_rows > 0) {
    $cliente_row = $cliente_result->fetch_assoc();
    $id_cliente = $cliente_row['id'];

    
    $produto_sql = "SELECT nome FROM produtos WHERE id = $produto_id";
    $produto_result = $conn_produtos->query($produto_sql);

    if ($produto_result->num_rows > 0) {
     
        $produto_row = $produto_result->fetch_assoc();
        $produto_nome = $produto_row['nome'];
        $valor_total = $preco_produto * $quantidade;

        $create_sql = "INSERT INTO pedidos (id_cliente, cliente_nome, produto_nome, quantidade, valor_total) VALUES ($id_cliente, '$cliente_nome', '$produto_nome', $quantidade, $valor_total)";

        if ($conn->query($create_sql) === TRUE) {
            echo "Pedido criado com sucesso!";
        } else {
            echo "Erro ao criar o pedido: " . $conn->error;
        }
    } else {
        echo "Produto não encontrado.";
    }
} else {
    echo "Cliente não encontrado.";
}
    }

   
    $conn_produtos->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gerenciamento de Vendas</title>
    <link rel="stylesheet" href="/gerenciar_pedidos/css/style.css" />
</head>
<body>
    <h2>Criar Pedidos</h2>

   
    <form class="formulario" method="post">
        <input type="text" name="cliente_nome" placeholder="Nome do Cliente" required>
        <input type="number" name="produto_id" placeholder="ID do Produto" required>
        <input type="number" name="quantidade" placeholder="Quantidade" required>
        <input type="submit" name="submit" value="Criar Pedido">
    </form>

    <table>
        <tr>
            <th>ID</th>
            <th>Cliente</th>
            <th>Produto</th>
            <th>Quantidade</th>
            <th>Valor Total (R$)</th>
            <th>Data do Pedido</th>
            <th>Ação</th>
        </tr>

        <h2>Lista de Pedidos</h2>

        <?php
        
        $sql = "SELECT * FROM pedidos";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['cliente_nome'] . "</td>";
                echo "<td>" . $row['produto_nome'] . "</td>";
                echo "<td>" . $row['quantidade'] . "</td>";
                echo "<td>R$" . number_format($row['valor_total'], 2) . "</td>";
                echo "<td>" . $row['data_pedido'] . "</td>";
                echo "<td>
                      <form method='post' action=''>
                          <input type='hidden' name='delete_id' value='" . $row['id'] . "'>
                          <input type='submit' value='Apagar' onclick='return confirm(\"Tem certeza de que deseja apagar este pedido?\")'>
                      </form>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>Nenhum pedido encontrado.</td></tr>";
        }
        ?>

    </table>
</body>
</html>

<?php

$conn->close();
?>
<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/Footer/footer.php';

    ?>