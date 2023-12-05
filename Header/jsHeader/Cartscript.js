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



var cartItems = [];
var cartIcon = document.querySelector('#cart-icon');
var cart = document.querySelector('.cart');
var closeCart = document.querySelector('#close-cart');
var cartItemCount = 0; 


function updateCartItemCount() {
  
    var itemCountElement = document.getElementById("cart-item-count");

  
    cartItemCount = cartItems.length; 
    itemCountElement.textContent = cartItemCount;
}


cartIcon.onclick = () => {
    cart.classList.add("active");
};


closeCart.onclick = () => {
    cart.classList.remove("active");
};


var removeCartButton = document.getElementsByClassName('cart-remove');
for (var i = 0; i < removeCartButton.length; i++) {
    var button = removeCartButton[i];
    button.addEventListener('click', removeCartItem);
}

function removeCartItem(event) {
    var buttonClicked = event.target;
    buttonClicked.parentElement.remove();
    updateTotal();
   
    cartItemCount--;
    updateCartItemCount();

   
    updateCartSession();
}


var quantityInput = document.getElementsByClassName('cart-quantity');
for (var i = 0; i < quantityInput.length; i++) {
    var input = quantityInput[i];
    input.addEventListener('change', quantityChanged);
}

function quantityChanged(event) {
    var input = event.target;
    if (isNaN(input.value) || input.value <= 0) {
        input.value = 1;
    }
    updateTotal();
    
    updateCartSession();
}

var addCart = document.getElementsByClassName("add-icon");
for (var i = 0; i < addCart.length; i++) {
    var button = addCart[i];
    button.addEventListener("click", addCartClicked);
}  

function addCartClicked(event) {
    var button = event.target;
    var products = button.parentElement;
    var title = products.getElementsByClassName('product-title')[0].innerText;
    var price = products.getElementsByClassName('price')[0].innerText;
   
    var imgSrc = products.getElementsByClassName('product-img')[0].src;

    addProductsCart(title, price, imgSrc);
    updateTotal();
    updateCartCount(); 
}

function addProductsCart(title, price, imgSrc) {
    var cartShop = document.createElement('div');
    cartShop.classList.add('cart-box');
    var cartItemsElement = document.getElementsByClassName('cart-content')[0];


    for (var i = 0; i < cartItems.length; i++) {
        if (cartItems[i].title === title) {
            alert('Você adicionou este item ao carrinho.');
            return;
        }
    }

    var cartBoxContent = `
        <img src="${imgSrc}" alt="" class="cart-img">
        <div class="detail-box">
            <div class="cart-product-title">${title}</div>
            <div class="cart-price">${price}</div>
            <input type="number" value="1" class="cart-quantity">
        </div>
        <i class="fa-solid fa-trash cart-remove"></i>
    `;

    cartShop.innerHTML = cartBoxContent;
    cartItemsElement.append(cartShop);

    cartShop.getElementsByClassName('cart-remove')[0].addEventListener('click', removeCartItem);
    cartShop.getElementsByClassName('cart-quantity')[0].addEventListener('change', quantityChanged);

 
    cartItems.push({
        title: title,
        price: price,
        imgSrc: imgSrc
    });


    updateCartSession();


    cartItemCount++;
    updateCartItemCount();
}

function updateCartSession() {

    var xhr = new XMLHttpRequest();
    xhr.open('POST', '/Header/CartSession/atualizar_carrinho_session.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send('action=update_cart&cartItems=' + JSON.stringify(cartItems));
}


document.getElementsByClassName('btn-buy')[0].addEventListener('click', buyButtonClicked);

function buyButtonClicked() {
    var cartContent = document.getElementsByClassName('cart-content')[0];
    if (cartContent.hasChildNodes()) {
        alert('Redirecionando para aba de Frete');
        while (cartContent.hasChildNodes()) {
            cartContent.removeChild(cartContent.firstChild);
        }
        cartItems = []; 
        cartItemCount = 0; 
        updateCartItemCount();

        
        updateCartSession();

        
        setTimeout(function() {
            window.location.href = '/Frete/Frete.php'; 
        }, 0); 
    } else {
        alert('Você não possui itens no carrinho.');
    }
    updateTotal();
}



function updateTotal() {
    var cartContent = document.getElementsByClassName('cart-content')[0];
    var cartDetail = cartContent.getElementsByClassName('cart-box');
    var total = 0;

    for (var i = 0; i < cartDetail.length; i++) {
        var cartBox = cartDetail[i];
        var priceElement = cartBox.getElementsByClassName('cart-price')[0];
        var quantityElement = cartBox.getElementsByClassName('cart-quantity')[0];

        
        var priceRS = priceElement.innerText.replace('R$', '');
        var priceDot = priceRS.replace('.', '');
        var price = priceDot.replace(',', '.');
        price = parseFloat(price);
        var quantity = quantityElement.value;
        total = total + (price * quantity);
    }
    
   
    var formatter = new Intl.NumberFormat('pt-BR', {
        style: 'currency',
        currency: 'BRL',
        minimumFractionDigits: 2,
    });

    document.getElementsByClassName('total-price')[0].innerText = formatter.format(total);
}


updateCartItemCount();
