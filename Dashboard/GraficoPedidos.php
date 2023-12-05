<?php
$servername = "localhost";
$username = "root";
$password = "thiagobar8";
$dbname = "estoque";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
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

<script>
    var dataPedidos = [{
        x: <?php echo json_encode($dates); ?>,
        y: <?php echo json_encode($orders); ?>,
        type: 'bar'
    }];

    var layoutPedidos = {
        title: 'Crescimento de Pedidos',
        xaxis: { title: 'Data' },
        yaxis: { title: 'Quantidade de Pedidos' }
    };

    Plotly.newPlot('chart-container', dataPedidos, layoutPedidos);
</script>
