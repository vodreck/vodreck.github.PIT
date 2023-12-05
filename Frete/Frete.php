<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: /Conta/login/Login.php");
    exit();
}

include $_SERVER['DOCUMENT_ROOT'] . '/Header/header.php';

$servername = "localhost";
$username = "root";
$password = "senha123";
$database = "usuarios";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$usuario_id = $_SESSION['usuario_id'];

$query = "SELECT * FROM usuarios WHERE id = $usuario_id";
$resultado = $conn->query($query);

if ($resultado) {
    if ($resultado->num_rows > 0) {
        $dadosUsuario = $resultado->fetch_assoc();
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/Frete/css/Style.css">
    <title>Pagina de Frete</title>
</head>
<body>

<div id="Container26" class="container mt-5">
    <h1>Informações de Entrega</h1>
    <form>
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" class="form-control" id="nome" value="<?php echo $dadosUsuario['nome']; ?>" readonly>
        </div>
        <h2>Detalhes do Endereço</h2>
    <div class="address-info">
        <strong>CEP:</strong>
        <p><?php echo $dadosUsuario['cep']; ?></p>
    </div>
    <div class="address-info">
        <strong>Rua:</strong>
        <p><?php echo $dadosUsuario['rua']; ?></p>
    </div>
    <div class="address-info">
        <strong>Número:</strong>
        <p><?php echo $dadosUsuario['numcasa']; ?></p>
    </div>
    <div class="address-info">
        <strong>Bairro:</strong>
        <p><?php echo $dadosUsuario['bairro']; ?></p>
    </div>
    <div class="address-info">
        <strong>Cidade:</strong>
        <p><?php echo $dadosUsuario['cidade']; ?></p>
    </div>
    <div class="address-info">
        <strong>Estado:</strong>
        <p><?php echo $dadosUsuario['estado']; ?></p>
    </div>

   
    <a href="/Perfil/perfil.php">Alterar Endereço</a>
   
</div>
    </form>
    <div id="Container26"class="container mt-5">
    <form>
        <h2>Informações de Frete</h2>
        <div class="form-group">
            <p>Frete grátis💲</p>
        </div>
        <div class="form-group">
            <p>Tempo estimado de entrega: 40 minutos🛵</p>
        </div>
    </form>
    
    
    <a href="/Pagamento-Frete/Pagamento.php" class="btn btn-primary">Prosseguir para Pagamento</a>
</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



<?php
include $_SERVER['DOCUMENT_ROOT'] . '\Footer\footer.php';
?>
</body>
</html>
