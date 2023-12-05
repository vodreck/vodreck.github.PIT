<?php
$connVendas = new mysqli("localhost", "root", "senha123", "estoque");

if ($connVendas->connect_error) {
    die("Falha na conexão com o banco de dados de vendas: " . $connVendas->connect_error);
}

$queryVendas = "SELECT DATE(data_venda) as data, COUNT(*) as quantidade_vendas 
                FROM vendas 
                GROUP BY data 
                ORDER BY data";

$resultVendas = $connVendas->query($queryVendas);

$datesVendas = [];
$quantidadeVendas = [];

if ($resultVendas->num_rows > 0) {
    while ($rowVendas = $resultVendas->fetch_assoc()) {
        $datesVendas[] = $rowVendas["data"];
        $quantidadeVendas[] = $rowVendas["quantidade_vendas"];
    }
}

$connVendas->close();
?>

<script>
    var dataVendas = [{
        x: <?php echo json_encode($datesVendas); ?>,
        y: <?php echo json_encode($quantidadeVendas); ?>,
        type: 'bar'
    }];

    var layoutVendas = {
        title: 'Gráfico de Vendas',
        xaxis: { title: 'Data' },
        yaxis: { title: 'Quantidade de Vendas' }
    };

    Plotly.newPlot('vendas-chart-container', dataVendas, layoutVendas);
</script>
