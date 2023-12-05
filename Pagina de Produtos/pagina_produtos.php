<?php
include $_SERVER['DOCUMENT_ROOT'] . '/session_start/session.php';
include $_SERVER['DOCUMENT_ROOT'] . '/Header/header.php';
include '/xampp/htdocs/CadastroProduto/conexao.php';






$sort = $_GET['sort'] ?? 'az'; 


$sql = "SELECT * FROM produtos";

switch ($sort) {
    case 'lowToHigh':
        $sql .= " ORDER BY preco ASC";
        break;
    case 'highToLow':
        $sql .= " ORDER BY preco DESC";
        break;
    case 'az':
        $sql .= " ORDER BY nome ASC";
        break;
    case 'za':
        $sql .= " ORDER BY nome DESC";
        break;
    default:
        break;
}

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Produtos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/Pagina de Produtos/css/styleP.css">
</head>

<body>


<form action="" method="GET"> 
    <div class="search-container">

    <input type="text" id="searchInput" placeholder="Buscar produtos...">
        <button type="button" onclick="searchProducts()" class="searchButton">Buscar</button>



        <select id="sortProducts" onchange="sortProducts()">
    <option value="az">A-Z</option>
    <option value="za">Z-A</option>
    <option value="lowToHigh">Menor Preço</option>
    <option value="highToLow">Maior Preço</option>
</select>
    </div>
</form>


    <div class="container mt-5">
        <h1 class="text-center mb-5">Nossos Produtos</h1>
        <div class="row">

            <?php
        

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="col-md-4 product-grid">';
                    echo '<div class="product-card" data-price="' . $row["preco"] . '" data-name="' . $row["nome"] . '">';                    
                    echo '<img src="/CadastroProduto/imagens_produtos/' . $row["imagem"] . '" class="product-img" alt="' . $row["nome"] . '">';
                    echo '<h5 class="mt-3">' . $row["nome"] . '</h5>';
                    echo '<p>' . $row["descricao"] . '</p>';
                    echo '<p class="font-weight-bold">Preço: R$' . number_format($row["preco"], 2, ',', '.') . '</p>';
                    

                    echo '<a href="/Pagina_Produto/produto.php?id=' . $row["id"] . '" class="btn btn-primary">Ver Detalhes</a>';

                    
                    
                    if (verificarCliente()) {

                        echo '<button class="btn btn-success add-to-cart-btn" data-product-id="' . $row["id"] . '" data-product-name="' . addslashes($row["nome"]) . '" data-product-price="' . addslashes(number_format($row["preco"], 2, ',', '.')) . '" data-product-image="' . addslashes("/CadastroProduto/imagens_produtos/" . $row["imagem"]) . '" onclick="addToCartClicked(event)">Adicionar ao Carrinho</button>';
                    }
                  
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<div class="col text-center">';
                echo '<p>Nenhum produto disponível.</p>';
                echo '</div>';
            }
            ?>
        </div>
    </div>

    <script>

function searchProducts() {
    var input, filter, products, product, txtValue;
    input = document.getElementById('searchInput');
    filter = input.value.toLowerCase();
    products = document.getElementsByClassName('col-md-4');

    for (var i = 0; i < products.length; i++) {
        product = products[i];
        txtValue = product.textContent || product.innerText;

        if (txtValue.toLowerCase().indexOf(filter) > -1) {
            product.classList.remove('d-none'); 
        } else {
            product.classList.add('d-none'); 
        }
    }
    

    sortProducts();
}



function sortProducts() {
    var sortType = document.getElementById('sortProducts').value;
    var products = document.querySelectorAll('.product-grid');

    var sortedProducts = Array.from(products);

    switch (sortType) {
        case 'lowToHigh':
            sortedProducts.sort(function (a, b) {
                return parseFloat(a.querySelector('.product-card').getAttribute('data-price')) - parseFloat(b.querySelector('.product-card').getAttribute('data-price'));
            });
            break;
        case 'highToLow':
            sortedProducts.sort(function (a, b) {
                return parseFloat(b.querySelector('.product-card').getAttribute('data-price')) - parseFloat(a.querySelector('.product-card').getAttribute('data-price'));
            });
            break;
        case 'az':
            sortedProducts.sort(function (a, b) {
                var nameA = a.querySelector('.product-card').getAttribute('data-name').toUpperCase();
                var nameB = b.querySelector('.product-card').getAttribute('data-name').toUpperCase();
                if (nameA < nameB) {
                    return -1;
                }
                if (nameA > nameB) {
                    return 1;
                }
                return 0;
            });
            break;
        case 'za':
            sortedProducts.sort(function (a, b) {
                var nameA = a.querySelector('.product-card').getAttribute('data-name').toUpperCase();
                var nameB = b.querySelector('.product-card').getAttribute('data-name').toUpperCase();
                if (nameA < nameB) {
                    return 1;
                }
                if (nameA > nameB) {
                    return -1;
                }
                return 0;
            });
            break;
        default:
            break;
    }

    var container = document.querySelector('.container .row');

    container.innerHTML = '';

    sortedProducts.forEach(function (product) {
        container.appendChild(product);
    });
}


</script>
            

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <script>

window.addEventListener('load', function () {
    loadCartFromSession();
});

function loadCartFromSession() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
                cartItems = response.cartItems || [];

                cartItemCount = cartItems.length;
                updateCartItemCount();

                updateCartContent();

                updateTotal();
            }
        }
    };

    xhr.open('POST', '/Header/CartSession/atualizar_carrinho_session.php', true);
    xhr.send();
}


function updateCartContent() {
    var cartContent = document.getElementsByClassName('cart-content')[0];
    cartContent.innerHTML = ''; 

    for (var i = 0; i < cartItems.length; i++) {
        var cartBoxContent = `
            <img src="${cartItems[i].imgSrc}" alt="" class="cart-img">
            <div class="detail-box">
                <div class="cart-product-title">${cartItems[i].title}</div>
                <div class="cart-price">${cartItems[i].price}</div>
                <input type="number" value="1" class="cart-quantity">
            </div>
            <i class="fa-solid fa-trash cart-remove"></i>
        `;

        var cartShop = document.createElement('div');
        cartShop.classList.add('cart-box');
        cartShop.innerHTML = cartBoxContent;

        cartShop.getElementsByClassName('cart-remove')[0].addEventListener('click', removeCartItem);
        cartShop.getElementsByClassName('cart-quantity')[0].addEventListener('change', quantityChanged);

        cartContent.appendChild(cartShop);
    }
}

</script>
    
    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/Footer/footer.php';
    ?>
    <script>

function addToCartClicked(event) {
    var button = event.target;
    var productId = button.getAttribute('data-product-id');


    var product = {
        id: productId,
        name: button.getAttribute('data-product-name'),
        price: button.getAttribute('data-product-price'),
        image: button.getAttribute('data-product-image')
    };


    addProductsCart(product.name, product.price, product.image);
    updateTotal();
}


var addToCartButtons = document.querySelectorAll('.add-to-cart-btn');


for (var i = 0; i < addToCartButtons.length; i++) {
    addToCartButtons[i].addEventListener('click', addToCartClicked);
}
</script>
</body>

</html>
