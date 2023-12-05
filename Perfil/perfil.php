<?php
session_start();

include $_SERVER['DOCUMENT_ROOT'] . '/Header/header.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: /Conta/login/Login.php");
    exit();
}

$servername = "localhost"; 
$username = "root";
$password = "thiagobar8"; 
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




if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST['nome'] ?? null;
    $email = $_POST['email'] ?? null;
    $telefone = $_POST['telefone'] ?? null;
    $cpf = $_POST['cpf'] ?? null;
    $cep = $_POST['cep'] ?? null;
    $rua = $_POST['rua'] ?? null;
    $numeroCasa = $_POST['numero'] ?? null;
    $bairro = $_POST['bairro'] ?? null;
    $cidade = $_POST['cidade'] ?? null;
    $estado = $_POST['estado'] ?? null;

    $queryUpdate = "UPDATE usuarios SET nome=?, email=?, numero=?, cep=?, rua=?, numcasa=?, bairro=?, cidade=?, estado=? WHERE id=?";

    $stmt = $conn->prepare($queryUpdate);
    $stmt->bind_param("sssssssssi", $nome, $email, $telefone, $cep, $rua, $numeroCasa, $bairro, $cidade, $estado, $usuario_id);

    if ($stmt->execute()) {

        header("Location: /Perfil/perfil.php");
        exit(); 
    } else {

        echo "Erro ao atualizar dados: " . $conn->error;
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil do Usuário</title>
    <link rel="stylesheet" href="/Perfil/css/stylePe.css"> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    

    <div class="container mt-5">
        <h2 id="titulo">Perfil do Usuário</h2>
        <div class="perfil-box">
    <form method="POST" action="/Perfil/perfil.php" onsubmit="salvarAlteracoes(event)">

    <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $dadosUsuario['nome']; ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $dadosUsuario['email']; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="telefone">Telefone:</label>
            <input type="tel" class="form-control" id="telefone" name="telefone" value="<?php echo $dadosUsuario['numero']; ?>" required>
        </div>
        <div class="form-group">
            <label for="cpf">CPF:</label>
            <input type="text" class="form-control" id="cpf" name="cpf"  value="<?php echo $dadosUsuario['cpf']; ?>" readonly>
        </div>
        
     

        <button type="button"  class="btn btn-primary" onclick="location.href='/Conta/redefinir_senha/redefinirsenha.php'">Redefinir Senha</button>
   
</div>

        <div class="endereco-box">
        <div class="form-group">
                <label for="cep">CEP:</label>
                <input type="text" class="form-control" id="cep" name="cep" value="<?php echo $dadosUsuario['cep']; ?>" required onblur="buscarEndereco()" >
            </div>
            <div class="form-group">
                <label for="rua">Rua:</label>
                <input type="text" class="form-control" id="rua" name="rua" value="<?php echo $dadosUsuario['rua']; ?>" required>
            </div>
            <div class="form-group">
                <label for="numero">Número:</label>
                <input type="text" class="form-control" id="numero" name="numero" value="<?php echo $dadosUsuario['numcasa']; ?>" required>
            </div>
            <div class="form-group">
                <label for="bairro">Bairro:</label>
                <input type="text" class="form-control" id="bairro" name="bairro" value="<?php echo $dadosUsuario['bairro']; ?>" required>
            </div>
            <div class="form-group">
                <label for="cidade">Cidade:</label>
                <input type="text" class="form-control" id="cidade" name="cidade" value="<?php echo $dadosUsuario['cidade']; ?>" required>
            </div>
            <div class="form-group">
                <label for="estado">Estado:</label>
                <input type="text" class="form-control" id="estado" name="estado" value="<?php echo $dadosUsuario['estado']; ?>" required>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        </form>
    </div>
   

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function buscarEndereco() {
            var cep = document.getElementById("cep").value;
            var url = "https://viacep.com.br/ws/" + cep + "/json/";


            var xhr = new XMLHttpRequest();
            xhr.open("GET", url, true);

            xhr.onload = function () {
                if (xhr.status === 200) {
                    var endereco = JSON.parse(xhr.responseText);

                    if (!endereco.erro) {
                        document.getElementById("rua").value = endereco.logradouro;
                        document.getElementById("bairro").value = endereco.bairro;
                        document.getElementById("cidade").value = endereco.localidade;
                        document.getElementById("estado").value = endereco.uf;
                    } else {
                        alert("CEP não encontrado.");
                    }
                } else {
                    alert("Erro ao consultar o CEP.");
                }
            };

            xhr.send();
        }

    </script>
    
<script>

function salvarAlteracoes(event) {
        event.preventDefault(); 

        var nome = document.getElementById("nome").value;
        var email = document.getElementById("email").value;
        var telefone = document.getElementById("telefone").value;
        var cpf = document.getElementById("cpf").value;
        var cep = document.getElementById("cep").value;
        var rua = document.getElementById("rua").value;
        var numero = document.getElementById("numero").value;
        var bairro = document.getElementById("bairro").value;
        var cidade = document.getElementById("cidade").value;
        var estado = document.getElementById("estado").value;

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "/Perfil/perfil.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {

                location.reload(); 
            }
        };


        var data = "nome=" + nome + "&email=" + email + "&telefone=" + telefone + "&cpf=" + cpf + "&cep=" + cep + "&rua=" + rua + "&numero=" + numero + "&bairro=" + bairro + "&cidade=" + cidade + "&estado=" + estado;
        xhr.send(data);
    }
</script>



    <?php
include $_SERVER['DOCUMENT_ROOT'] . '/Footer/footer.php';
?>
</body>
</html>
