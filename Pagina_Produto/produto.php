<?php
 session_start();
    include $_SERVER['DOCUMENT_ROOT'] . '/Header/header.php';



    
$servername = "localhost"; 
$username = "root";
$password = "thiagobar8"; 
$database = "usuarios"; 

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
  die("Conexão falhou: " . $conn->connect_error);
}

$usuario_id = $_SESSION['usuario_id'];

$query = "SELECT nome, email FROM usuarios WHERE id = $usuario_id";
$resultado = $conn->query($query);

$nomeUsuario = "";
$emailUsuario = "";

if ($resultado) {
  if ($resultado->num_rows > 0) {
      $dadosUsuario = $resultado->fetch_assoc();
      $nomeUsuario = $dadosUsuario['nome'];
      $emailUsuario = $dadosUsuario['email'];
  } else {
      echo "Usuário não encontrado.";
  }
} else {
  echo "Erro na consulta: " . $conn->error;
}

$conn->close();
?>




<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Detalhes do Produto</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/Pagina_Produto/css/style.css">
</head>

<body>

    <?php
    include("/xampp/htdocs/Estoque/conexao.php");
  

  
    $productId = $_GET['id'];

   
    $sql = "SELECT * FROM produtos WHERE id = $productId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $productName = $row['nome'];
        $productPrice = $row['preco'];
        $productDescription = $row['descricao'];
        $productImage = '/CadastroProduto/imagens_produtos/' . $row['imagem']; 
    } else {
        echo "Produto não encontrado";
    }
    ?>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <img src='<?php echo $productImage; ?>' alt='<?php echo $productName; ?>' class="img-fluid">
            </div>
            <div class="col-md-6">
                
                <h1><?php echo $productName; ?></h1>
                <p>Preço: R$ <?php echo $productPrice; ?></p>
                <p>Descrição: <?php echo $productDescription; ?></p>
            



                <button class="btn btn-primary add-to-cart-btn" data-product-id="<?php echo $productId; ?>">Adicionar ao Carrinho</button>
            </div>
        </div>

        <h3>Deixe um comentário:</h3>
    <form method="POST" action="/Pagina_Produto/salvar_comentario.php">
    <input type="hidden" name="produto_id" value="<?php echo $productId; ?>">
    
    <div class="form-group">
      <label for="nome">Nome:</label>
      <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $nomeUsuario; ?>" readonly>
    </div>
    
    <div class="form-group">
        <label for="avaliacao">Avaliação (0-5):</label>
        <input type="number" class="form-control" id="avaliacao" name="avaliacao" min="0" max="5" required>
    </div>
    
    <div class="form-group">
        <label for="comentario">Seu Comentário:</label>
        <textarea class="form-control" id="comentario" name="comentario" rows="3" required></textarea>
    </div>
    
    <button type="submit" class="btn btn-primary">Enviar Comentário</button>
</form>


</div>


    <ul class="list-group" id="comentarios-lista">
    <?php
$sql_comentarios = "SELECT * FROM comentarios WHERE produto_id = $productId";
$result_comentarios = $conn->query($sql_comentarios);

if ($result_comentarios->num_rows > 0) {
    ?>
    <div class="container mt-4">
        <h3>Comentários</h3>
        <ul class="list-group">
            <?php
            while ($row_comentario = $result_comentarios->fetch_assoc()) {
                $nome_comentario = $row_comentario['nome'];
                $avaliacao_comentario = $row_comentario['avaliacao'];
                $texto_comentario = $row_comentario['comentario'];
               
                ?>
                <li class="list-group-item">
                    <div class="d-flex w-100 justify-content-between">
                        <div class="d-flex align-items-center">
                            <a href="#">
                                <img src="/Pagina_Produto/img/perfil.png" class="img-fluid rounded-circle mr-2" width="50" height="50" alt="Foto do Usuário">
                            </a>
                            <h5 class="mb-1"><?php echo $nome_comentario; ?></h5>
                        </div>
                        <span class="badge badge-primary"><?php echo $avaliacao_comentario; ?>/5</span>
                    </div>
                    <p class="mb-1"><?php echo $texto_comentario; ?></p>
                </li>
                <?php
            }
            ?>
        </ul>
    </div>
    <?php
} else {
    echo '<div class="container mt-4"><p class="lead">Nenhum comentário ainda.</p></div>';
}
?>


    </ul>
</div>




    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script>
    var j = jQuery.noConflict();
</script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    

    <script>

function addToCartClicked(event) {
    var button = event.target;
    var productId = button.getAttribute('data-product-id');


    var product = {
        id: productId,
        name: '<?php echo addslashes($productName); ?>',
        price: parseFloat('<?php echo addslashes($productPrice); ?>').toFixed(2).replace('.', ','),
        image: '<?php echo addslashes($productImage); ?>'
    };


    addProductsCart(product.name, product.price, product.image);
    updateTotal();
}


var addToCartButtons = document.querySelectorAll('.add-to-cart-btn');


for (var i = 0; i < addToCartButtons.length; i++) {
            addToCartButtons[i].addEventListener('click', addToCartClicked);
        }




    </script>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/Footer/footer.php'; ?>
</body>

</html>
