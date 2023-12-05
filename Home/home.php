
<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/Conta/SQL/conexao.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/session_start/session.php'; 


?>

<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/Header/header.php';

    ?> 
  
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Home/css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>
        Início
    </title>
    
</head>
<body>

<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="/Home/img/cafe-completo.png" class="d-block w-100" alt="Imagem 1">
        </div>
        <div class="carousel-item">
            <img src="/Home/img/croissant.png" class="d-block w-100" alt="Imagem 2">
        </div>
        <div class="carousel-item">
            <img src="/Home/img/cafe-grande.png" class="d-block w-100" alt="Imagem 3">
        </div>
    </div>

     <script>
        $(document).ready(function () {
            $('#carouselExampleSlidesOnly').carousel({
                interval: 3000, 
            });
        });
    </script>
</div>


    <div  id="container1" class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <h2>Sobre Nossa Loja</h2>
                <p>Bem-vindo à nossa loja online de produtos gourmet! Somos apaixonados por oferecer uma experiência culinária excepcional, onde a qualidade,
                     sabor e autenticidade são prioridades em cada item que oferecemos.
                     Nossa jornada começa com uma profunda apreciação pela gastronomia de qualidade, e estamos empenhados em compartilhar essa paixão com você.</p>
            </div>
            <div class="col-md-6">
                <img src="/Home/img/logo.png" alt="Nossa Loja" class="img-fluid" >
            </div>
        </div>
    </div>





  
    <div id="container1" class="container mt-5">
    <h2>Nossos Produtos em Destaque</h2>
    <div id="carouselProdutos" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <a href="/Pagina_Produto/produto.php?id=78"> 
                    <img src="/Home/img/combo-pao-cafe.png" class="d-block w-100" alt="Produto 1">
                </a>
            </div>
            <div class="carousel-item">
                <a href="/Pagina_Produto/produto.php?id=67"> 
                    <img src="/Home/img/torta.png" class="d-block w-100" alt="Produto 2">
                </a>
            </div>
            <div class="carousel-item">
                <a href="/Pagina_Produto/produto.php?id=71"> 
                    <img src="/Home/img/pao-de-mel.png" class="d-block w-100" alt="Produto 3">
                </a>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselProdutos" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Anterior</span>
        </a>
        <a class="carousel-control-next" href="#carouselProdutos" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Próximo</span>
        </a>
    </div>
</div>




    <div  id="container1" class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <h2>Pronto Para Entrega</h2>
                <p>Bem-vindo à nossa loja online de produtos gourmet! Aqui oferecemos a você nosso delivery com todo nosso cardápio, venha conhecer nossos produtos</p>
                <button class="botao1" onclick="window.location.href='/Pagina de Produtos/pagina_produtos.php'" type="button">Produtos</button>
            </div>
            
            <div class="col-md-6">

            <img src="/Home/img/Propaganda.png" alt="Nossa Loja" class="img-fluid">
            </div>
            
        </div>
    </div>


  
<div id="container1" class="container mt-5">
    <h2>Novidades</h2>
    <div id="carouselProdutos2" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <a href="/Pagina_Produto/produto.php?id=72"> 
                    <img src="/Home/img/croissant.png" class="d-block w-100" alt="Produto 1">
                </a>
            </div>
            <div class="carousel-item">
                <a href="/Pagina_Produto/produto.php?id=70"> 
                    <img src="/Home/img/pao-de-queijo-gigante.png" class="d-block w-100" alt="Produto 2">
                </a>
            </div>
            <div class="carousel-item">
                <a href="/Pagina_Produto/produto.php?id=73"> 
                    <img src="/Home/img/pao-recheado.png" class="d-block w-100" alt="Produto 3">
                </a>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselProdutos2" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Anterior</span>
        </a>
        <a class="carousel-control-next" href="#carouselProdutos2" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Próximo</span>
        </a>
    </div>
</div>




    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</body>
</html>
<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/Footer/footer.php';
    ?> 