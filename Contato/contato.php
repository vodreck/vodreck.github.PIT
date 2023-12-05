<?php
include $_SERVER['DOCUMENT_ROOT'] . '/Header/header.php';


if (!isset($_SESSION['usuario_id'])) {
  header("Location: /Conta/login/Login.php");
  exit();
}

$servername = "localhost"; 
$username = "root";
$password = "senha 123"; 
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contato</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/Contato/css/styleC.css" />
</head>
<body>

<div class="container mt-5">
  <h2>Entre em Contato</h2>
  <form id="contactForm">
    <div class="form-group">
      <label for="nome">Nome:</label>
      <input type="text" class="form-control" id="nome" placeholder="Seu nome" value="<?php echo $nomeUsuario; ?>" readonly>
    </div>
    <div class="form-group">
      <label for="email">E-mail:</label>
      <input type="email" class="form-control" id="email" placeholder="Seu e-mail" value="<?php echo $emailUsuario; ?>" readonly>
    </div>
    <div class="form-group">
      <label for="mensagem">Mensagem:</label>
      <textarea class="form-control" id="mensagem" rows="4" placeholder="Sua mensagem"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Enviar</button>
  </form>
</div>

<div class="container mt-3" id="successMessage" style="display: none;">
  <div class="alert alert-success">
    Mensagem enviada com sucesso!
  </div>
</div>

<div class="container mt-5">
  <h2>Informações de Contato da Empresa</h2>
  <p><strong>E-mail:</strong> Petescoffeesupport@gmail.com</p>
  <p><strong>Telefone:</strong> (11) 9-1234-5678</p>
  <p><strong>Endereço:</strong> Rua Cruzeiro, número 830</p>
  <p><strong>Bairro:</strong> Barra Funda</p>
  <p><strong>Cidade:</strong> São Paulo</p>
  <p><strong>CEP:</strong> 01137-000</p>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
$("#contactForm").submit(function(event) {
  event.preventDefault(); 
  
  if ($("#nome").val() && $("#email").val() && $("#mensagem").val()) {
    $("#contactForm").hide(); 
    $("#successMessage").show(); 
  } else {
    alert("Por favor, preencha todos os campos antes de enviar.");
  }
});
</script>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '\Footer\footer.php';
?>

</body>
</html>
