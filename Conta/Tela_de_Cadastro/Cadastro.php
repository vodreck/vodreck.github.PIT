<?php

include $_SERVER['DOCUMENT_ROOT'] . '/Conta/SQL/conexao.php';
require_once '/xampp/htdocs/session_start/session.php'; 

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'] ?? null;
    $email = $_POST['email'] ?? null;
    $cpf = $_POST['CPF'] ?? null;
    $numero = $_POST['numero'] ?? null;
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT) ?? null;
    $resposta1 = $_POST['resposta1'] ?? null;
    $resposta2 = $_POST['resposta2'] ?? null;

    $cep = $_POST['cep'] ?? null;
    $rua = $_POST['rua'] ?? null;
    $numeroCasa = $_POST['numeroCasa'] ?? null;
    $bairro = $_POST['bairro'] ?? null;
    $cidade = $_POST['cidade'] ?? null;
    $estado = $_POST['estado'] ?? null;

    $cpf_check_query = "SELECT * FROM usuarios WHERE cpf='$cpf'";
    $cpf_result = $conn->query($cpf_check_query);

    $email_check_query = "SELECT * FROM usuarios WHERE email='$email'";
    $email_result = $conn->query($email_check_query);

    if ($cpf_result->num_rows == 0 && $email_result->num_rows == 0) {
        $sql = "INSERT INTO usuarios (nome, email, cpf, numero, senha, resposta_seguranca_1, resposta_seguranca_2, cep, rua, numcasa, bairro, cidade, estado) VALUES ('$nome', '$email', '$cpf', '$numero', '$senha', '$resposta1', '$resposta2', '$cep', '$rua', '$numeroCasa', '$bairro', '$cidade', '$estado')";

        if ($conn->query($sql) === TRUE) {
            $usuario_id = $conn->insert_id; 
            loginUsuario($usuario_id, 'cliente'); 

            
            $message = "Cadastro realizado com sucesso!";
        } else {
            $message = "Erro ao cadastrar: " . mysqli_error($conn);
        }
    } elseif ($cpf_result->num_rows > 0) {
        $message = "CPF já está em uso.";
    } elseif ($email_result->num_rows > 0) {
        $message = "E-mail já está em uso.";
    }
}

?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/Header/header.php';?> 

<!DOCTYPE html>
<html>
<head>
    <title>Cadastro</title>
   
</head>
<body>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Cadastro</title>
    <link rel="stylesheet" href="/Conta/Tela_de_Cadastro/Cadastro.css">
</head>
<body>

    <main>
        <h1>Criar Conta</h1>

            <form class="formulario" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="senhaForm">
    <div class="row">
        <div class="column">
            <label for="Nome">
                <span>Nome Completo*</span>
                <input type="text" id="nome" name="nome" required>
            </label>
        </div>
        <div class="column">
            <label for="email">
                <span>Email*</span>
                <input type="email" id="email" name="email" required>
            </label>
        </div>
    </div>

    <div class="row">
        <div class="column">
            <label for="senha">
                <span>Senha*</span>
                <input type="password" id="senha" name="senha" required>
            </label>
        </div>
        <div class="column">
            <label for="confirmarSenha">
                <span>Confirmar Senha*</span>
                <input type="password" id="confirmarSenha" name="confirmarSenha" required>
            </label>
        </div>
    </div>

    <div class="row">
        <div class="column">
            <label for="CPF">
                <span>CPF*</span>
                <input type="text" id="CPF" name="CPF" required pattern="\d{3}\.\d{3}\.\d{3}-\d{2}"
                       title="Digite um CPF válido (XXX.XXX.XXX-XX)">
            </label>
        </div>
        <div class="column">
            <label for="numero">
                <span>Telefone Celular*</span>
                <input type="tel" id="numero" name="numero" required>
            </label>
        </div>
    </div>
<h2>Perguntas de segurança:</h2>

    <div class="row">
        <div class="column">
            <label for="resposta1">
                <span>Qual o nome do seu primeiro Pet?</span>
                <input type="text" id="resposta1" name="resposta1" required>
            </label>
        </div>
        <div class="column">
            <label for="resposta2">
                <span>Qual sua comida preferida?

                </span>
                <input type="text" id="resposta2" name="resposta2" required>
            </label>
        </div>
    </div>

    <div class="row">
                <div class="column">
                    <label for="cep">
                        <span>CEP*</span>
                        <input type="text" class="form-control" id="cep" name="cep" onblur="buscarEndereco()" required>
                    </label>
                </div>
                <div class="column">
                    <label for="rua">
                        <span>Rua*</span>
                        <input type="text" id="rua" name="rua" required>
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="column">
                    <label for="numeroCasa">
                        <span>Número da Casa*</span>
                        <input type="text" id="numeroCasa" name="numeroCasa" required>
                    </label>
                </div>
                <div class="column">
                    <label for="bairro">
                        <span>Bairro*</span>
                        <input type="text" id="bairro" name="bairro" required>
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="column">
                    <label for="cidade">
                        <span>Cidade*</span>
                        <input type="text" id="cidade" name="cidade" required>
                    </label>
                </div>
                <div class="column">
                    <label for="estado">
                        <span>Estado*</span>
                        <input type="text" id="estado" name="estado" required>
                    </label>
                </div>
            </div>


    <input type="submit" value="Continuar">
</form>
<?php if (!empty($message)) : ?>
        <div class="message">
            <div class="message-box">
                <?php echo $message; ?>
                <button id="fecharMensagem">Fechar</button>
            </div>
        </div>
    <?php endif; ?>
              
            </div>
        </form>

        <form action="/Conta/login/Login.php" method="get">
<label for="rec" id="rec-label">Ja tem uma Conta?</label>
            <button type="submit" id="rec">Entrar</button>
        </form>




        <div>
            <p id="senhaMatchMessage"></p>
        </div>
    </main>
    <?php if (!empty($mensagem)) : ?>
    <div><?php echo $mensagem; ?></div>
<?php endif; ?>

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

    document.getElementById("cep").addEventListener("blur", buscarEndereco);
</script>
    <script src="/Conta/Tela_de_Cadastro/scriptC/script.js"></script>
    <script>
    document.getElementById('fecharMensagem').addEventListener('click', function() {
        window.location.href = '/Home/home.php';
    });
</script>
    <?php
        include $_SERVER['DOCUMENT_ROOT'] . '\Footer\footer.php';
        ?> 
</body>
</html>
