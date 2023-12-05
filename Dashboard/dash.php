<?php include $_SERVER['DOCUMENT_ROOT'] . '/Header/header.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard de Vendas</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="/Dashboard/css/style.css">
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h1>Dashboard de Vendas</h1>
        <div class="row">
            <div class="col-md-6">
                <?php
                 
                 $servername = "localhost";
                 $username = "root";
                 $password = "senha123";
                 $dbname = "estoque";
                 $dbnameUsuarios = "usuarios";
 
                
                 $conn = new mysqli($servername, $username, $password, $dbname);
 
              
                 $connUsuarios = new mysqli($servername, $username, $password, $dbnameUsuarios);

               
                $connVendas = new mysqli("localhost", "root", "senha123", "estoque");

        
                if ($connVendas->connect_error) {
                    die("Falha na conexão com o banco de dados de vendas: " . $connVendas->connect_error);
                }
 
         
                 if ($conn->connect_error) {
                     die("Falha na conexão com o banco de dados: " . $conn->connect_error);
                 }
 
           
                 if ($connUsuarios->connect_error) {
                     die("Falha na conexão com o banco de dados de usuários: " . $connUsuarios->connect_error);
                 }
 
       
                 $queryPedidos = "SELECT COUNT(*) as total_pedidos FROM pedidos";
                 $resultPedidos = $conn->query($queryPedidos);
 
                 if ($resultPedidos->num_rows > 0) {
                     $rowPedidos = $resultPedidos->fetch_assoc();
                     $totalPedidos = $rowPedidos["total_pedidos"];
                     echo "<p>Total de Pedidos: $totalPedidos</p>";
                 } else {
                     echo "Nenhum pedido encontrado.";
                 }
 
           
                 $queryProdutos = "SELECT COUNT(*) as total_produtos FROM produtos";
                 $resultProdutos = $conn->query($queryProdutos);
 
                 if ($resultProdutos->num_rows > 0) {
                     $rowProdutos = $resultProdutos->fetch_assoc();
                     $totalProdutos = $rowProdutos["total_produtos"];
                     echo "<p>Total de Produtos: $totalProdutos</p>";
                 } else {
                     echo "Nenhum produto encontrado.";
                 }
 
 
 
                 

 $queryUsuarios = "SELECT COUNT(*) as total_usuarios FROM usuarios";
 $resultUsuarios = $connUsuarios->query($queryUsuarios);
 
 if ($resultUsuarios->num_rows > 0) {
     $rowUsuarios = $resultUsuarios->fetch_assoc();
     $totalUsuarios = $rowUsuarios["total_usuarios"];
     echo "<p>Total de Usuários: $totalUsuarios</p>";
 } else {
     echo "Nenhum usuário encontrado.";
 }
 

$queryTotalVendas = "SELECT SUM(quantidade * valor_total) as total_vendas
                     FROM vendas";

$resultTotalVendas = $connVendas->query($queryTotalVendas);

if ($resultTotalVendas !== false) {
    $rowTotalVendas = $resultTotalVendas->fetch_assoc();
    $totalVendasValor = $rowTotalVendas["total_vendas"];
    echo "<p>Valor Total de Vendas: R$ " . number_format($totalVendasValor, 2, ',', '.') . "</p>";
} else {
    echo "Nenhuma venda encontrada.";
}

                 
                
                 $queryCrescimentoPedidos = "SELECT data_pedido, COUNT(*) as total_pedidos 
                                           FROM pedidos 
                                           GROUP BY data_pedido 
                                           ORDER BY data_pedido";
 
                 $resultCrescimentoPedidos = $conn->query($queryCrescimentoPedidos);
 
                 $dates = [];
                 $orders = [];
 
                 if ($resultCrescimentoPedidos->num_rows > 0) {
                     while ($rowCrescimentoPedidos = $resultCrescimentoPedidos->fetch_assoc()) {
                         $dates[] = $rowCrescimentoPedidos["data_pedido"];
                         $orders[] = $rowCrescimentoPedidos["total_pedidos"];
                     }
                 }
 
 
 
                 $conn->close();
                
                ?>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <h2>Gráfico de Crescimento de Pedidos</h2>
                <div id="chart-container"></div>
            </div>
            <?php
            include $_SERVER['DOCUMENT_ROOT'] . '/Dashboard/GraficoPedidos.php'; 
            ?>
            <div class="col-md-6">
                <h2>Gráfico de Vendas</h2>
                <div id="vendas-chart-container"></div>
            </div>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/Dashboard/GraficoVendas.php'; ?>
        </div>
    </div>

</body>
</html>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/Footer/footer.php'; ?>
