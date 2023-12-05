<?php

require_once '/xampp/htdocs/session_start/session.php';

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
   
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="/Header/styles/reset.min.css" />
    <link rel="stylesheet" href="/Header/styles/styleHeader.css" />
    <link rel="stylesheet" href="/Header/styles/header.css" />
    <link rel="stylesheet" href="/Header/assets/css/cart.css" />
    <script src="https://kit.fontawesome.com/6716068f67.js" crossorigin="anonymous"></script>
    <base href="/Header/" />
  </head>
  <body>
   
    <header class="site-header">
      <div class="wrapper site-header__wrapper">
        <div class="site-header__start">
          <a href="/Home/home.php" class="brand">
            <img src="/Header/img/logo.png" alt="Logo da Marca">
          </a>
          <nav class="nav">
            <button class="nav__toggle" aria-expanded="false" type="button"></button>

            <?php if (verificarCliente()): ?>
    <nav class="nav">
        <ul class="nav__wrapper">
            <li class="nav__item"><a class="href_nav" href="/Home/home.php">Início</a></li>
            <li class="nav__item"><a class="href_nav" href="/Perfil/perfil.php">Perfil</a></li>
            <li class="nav__item"><a class="href_nav" href="/Pagina de Produtos/pagina_produtos.php">Produtos</a></li>
            <li class="nav__item"><a class="href_nav" href="/sobre-nos/sobre-nos.php">Sobre-nós</a></li>
            <li class="nav__item"><a class="href_nav" href="/Contato/contato.php">Contato</a></li>
            <li class="nav__item"><a class="href_nav" href="/Conta/login/Logout.php">Sair</a></li>
        </ul>
    </nav>
<?php endif; ?>

<?php if (verificarAdministrador()): ?>
    <nav class="nav">
        <ul class="nav__wrapper">
            <li class="nav__item"><a class="href_nav" href="/Perfil/perfil.php">Perfil</a></li>
            <li class="nav__item"><a class="href_nav" href="/gerenciar_pedidos/gerenciador_pedidos.php">Pedidos</a></li>
            <li class="nav__item"><a class="href_nav" href="/Clientes/Cliente.php">Lista de Clientes</a></li>
            <li class="nav__item"><a class="href_nav" href="/CadastroProduto/ListaProdutos.php">Lista de Produtos</a></li>
            <li class="nav__item"><a class="href_nav" href="/Dashboard/dash.php">Dashboard</a></li>
            <li class="nav__item"><a class="href_nav" href="/CadastroProduto/adicionar.php">Adicionar/Remover Produtos</a></li>
            <li class="nav__item"><a class="href_nav" href="/Conta/login/Logout.php">Sair</a></li>
            <li class="nav__item"><a class="href_nav" href="/Error/error.php">Error</a></li>
        </ul>
    </nav>
<?php endif; ?>





        </div>
        <div class="site-header__end">
          <ul class="sub-nav">
            <li class=""><a class="href_nav" href="/Home/home.php">Início</a></li>
            <li class=""><a class="href_nav" href="/Pagina de Produtos/pagina_produtos.php">Produtos</a></li>
            <li class=""><a class="href_nav" href="/sobre-nos/sobre-nos.php">Sobre-nós</a></li>
            <li class=""><a class="href_nav" href="/Contato/contato.php">Contato</a></li>


    

  </a>
</li>
            <li class="cart-icon"> 
              <i class="fa-solid fa-cart-shopping" id="cart-icon"></i>
              <span id="cart-item-count">0</span> 
            </li>
          </ul>
        </div>
      </div>
      <div class="nav-container">
        
        <div class="cart">
          <h2 class="cart-title">Seu Carrinho</h2>
         
          <div class="cart-content" id="cart-content-id">
            
          </div>
        
          <div class="total">
            <div class="total-title">Total</div>
            <div class="total-price">R$ 0,00</div>
          </div>
       
          <button type="button" class="btn-buy" id="finishShopping">Fechar Compra</button>
         
          <i class="fa-solid fa-xmark" id="close-cart"></i>
        </div>
      </div>
    </header>
   
    <script src="/Header/jsHeader/header-13.js"></script>
    <script src="/Header/jsHeader/Cartscript.js"></script>

    
    

  </body>
</html>
