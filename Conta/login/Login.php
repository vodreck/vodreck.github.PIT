<?php


include $_SERVER['DOCUMENT_ROOT'] . '/session_start/session.php';


include $_SERVER['DOCUMENT_ROOT'] . '/Conta/SQL/conexao.php';

$message = ''; 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? null;
    $senha = $_POST['senha'] ?? null;

    $sql = "SELECT * FROM usuarios WHERE email = ?";
    
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
    
        if (password_verify($senha, $row['senha'])) {
          
            $_SESSION['usuario_id'] = $row['id'];
    
            if ($row['permissoes'] === 'admin') {
                $_SESSION['permissoes'] = 'admin';
                header("Location: /Perfil/perfil.php");
                exit();
            } else {
                $_SESSION['permissoes'] = 'cliente';
                header("Location: /Home/home.php");
                exit();
            }
        } else {
           
            $message = "Senha incorreta.";
        }
    } else {
       
        $message = "Email não encontrado.";
    }
}
?> 


<?php   include $_SERVER['DOCUMENT_ROOT'] . '/Header/header.php';?> 
    
<!DOCTYPE html>
<html lang="pt-br">
<head>


    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Login</title>
    <link rel="stylesheet" href="/Conta/login/css/Login.css">
    
  
</head>
<body>
   

    <main class="content">
        <h1>Entrar</h1>
       
        <div class="alternativa">
        
        </div>

        <div class="content-container">
            
        <form class="formulario" action="" method="post">
        <img src="/Conta/login/imagens/logo-sem-fundo.png" alt="Imagem mobile" class="logo">
            <label for="email">
                <span>Email</span>
                <input
                    type="email"
                    id="email"
                    name="email"
                    required
                >
            </label>
            <label for="senha">
                <span>Senha</span>
                <input
                    type="password"
                    id="senha"
                    name="senha"
                    required
                >
                </label>
                <input type="submit" value="Entrar">

                <div class="ou-no-meio">Ou</div>
           
            <button class="botao1" onclick="window.location.href='/Conta/Tela_de_Cadastro/Cadastro.php'" type="button">Cadastrar</button>

        </form>
       

        </div>


        <form action="/Conta/redefinir_senha/redefinirsenha.php" method="get">
            <button type="submit" id="rec">Esqueci minha senha</button>
        </form>
        
    </main>
    <section class="imagens">
       
        <div class="circulo"></div>
    </section>
    <script>
        var email = document.getElementById('email');
        var senha = document.getElementById('senha');

        email.addEventListener('focus',()=>{
            email.style.borderColor= "#4A5F6A";
        });

        email.addEventListener('blur',()=>{
            email.style.borderColor= "#ccc";
        });

        senha.addEventListener('focus',()=>{
            senha.style.borderColor= "#4A5F6A";
        });

        senha.addEventListener('blur',()=>{
            senha.style.borderColor= "#ccc";
        });
    </script>

<?php if (!empty($message)) : ?>
    <div class="message">
    <div class="message-box">
        <?php echo $message; ?>
        <button id="fecharMensagem">Fechar</button>
    </div>
</div>
    <?php endif; ?>
    <script>

        
        document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('fecharMensagem').addEventListener('click', function () {
            document.querySelector('.message').style.display = 'none';
        });
    });
    </script>


<?php
include $_SERVER['DOCUMENT_ROOT'] . '/Footer/footer.php';
?> 


</body>
<footer>
</footer>
</html>
