<?php 
    include $_SERVER['DOCUMENT_ROOT'] . '/Header/header.php';
 
    ?> 
<!DOCTYPE html>
<html lang="pt-br">
<head>



    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Redefinir Senha</title>
    <link rel="stylesheet" href="/Conta/redefinir_senha/redefinirsenha.css">

</head>
<body>
    <main>
        <h1>Redefinir Senha</h1>
        <form class="formulario" action="/Conta/redefinir_senha/processar_redefinir_senha.php" id="senhaForm" method="post">
    <div class="linha">
        <label for="email">
            <span>Email*</span>
            <input
                type="email"
                id="email"
                name="email"
                required
            >
        </label>
        <label for="cpf">
            <span>CPF*</span>
            <input
                type="text"
                id="CPF"
                name="CPF"
                required
                pattern="\d{3}\.\d{3}\.\d{3}-\d{2}"
                title="Digite um CPF válido (XXX.XXX.XXX-XX)"
            >
        </label>
    </div>
    <div class="linha">
        <label for="senha">
            <span>Nova Senha*</span>
            <input
                type="password"
                id="senha"
                name="senha"
                required
            >
        </label>
        <label for="confirmarSenha">
            <span>Confirmar Senha*</span>
            <input
                type="password"
                id="confirmarSenha"
                name="confirmarSenha"
                required
            >
        </label>
    </div>
    <div class="linha">
        <label for="resposta1">
            <span>Qual o nome do seu primeiro Pet?</span>
            <input
                type="text"
                id="resposta1"
                name="resposta1"
                required
            >
        </label>
        <label for="resposta2">
            <span>Qual sua comida preferida?</span>
            <input
                type="text"
                id="resposta2"
                name="resposta2"
                required
            >
        </label>
    </div>
    <input type="submit" value="Alterar">


  
</form>

<form action="/Conta/login/Login.php" method="get">
<label for="rec" id="rec-label"></label>
            <button type="submit" id="rec">Voltar ao Login</button>
        </form>
       
        <div>
            <p id="senhaMatchMessage"></p>
        </div>
        <?php
$message = $_GET['message'] ?? null;

if ($message === "success") {
    echo '<div class="message success">
            <div class="message-box">Senha redefinida com sucesso. <button class="fecharMensagem" onclick="fecharMensagem()">Fechar</button></div>
          </div>';
} elseif ($message === "password_mismatch") {
    echo '<div class="message">
            <div class="message-box">As senhas não coincidem. <button class="fecharMensagem" onclick="fecharMensagem()">Fechar</button></div>
          </div>';
} elseif ($message === "invalid_answers") {
    echo '<div class="message">
            <div class="message-box">Respostas de segurança inválidas. <button class="fecharMensagem" onclick="fecharMensagem()">Fechar</button></div>
          </div>';
} elseif ($message === "invalid_user") {
    echo '<div class="message">
            <div class="message-box">Usuário não encontrado ou inválido. <button class="fecharMensagem" onclick="fecharMensagem()">Fechar</button></div>
          </div>';
}
?>



    </main>
    <section class="imagens">
        <img src="/Conta/redefinir_senha/imagens/logo-sem-fundo.png" alt="Imagem mobile">
        <div class="circulo"></div>
    </section>
    
    <script src="/Conta/redefinir_senha/scriptR/script.js"></script>

</body>
</html>
