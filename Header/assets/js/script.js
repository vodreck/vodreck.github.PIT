
      var cartItems = [];

      let cartIcon = document.querySelector('#cart-icon')
      let cart = document.querySelector('.cart')
      let closeCart = document.querySelector('#close-cart')

      cartIcon.onclick = () => {
          cart.classList.add("active")
      };

      closeCart.onclick = () => {
          cart.classList.remove("active")
      };

      var removeCartButton = document.getElementsByClassName('cart-remove')
      for (var i = 0; i < removeCartButton.length; i++) {
          var button = removeCartButton[i]
          button.addEventListener('click', removeCartItem)
      }

      function removeCartItem(event) {
          var buttonClicked = event.target
          buttonClicked.parentElement.remove()
          updateTotal()
      }

      var quantityInput = document.getElementsByClassName('cart-quantity')
      for (var i = 0; i < quantityInput.length; i++) {
          var input = quantityInput[i]
          input.addEventListener('change', quantityChanged)
      }

      function quantityChanged(event) {
          var input = event.target
          if (isNaN(input.value) || input.value <= 0) {
              input.value = 1
          }
          updateTotal()
      }

      var addCart = document.getElementsByClassName("add-icon")
      for (var i = 0; i < addCart.length; i++) {
          var button = addCart[i]
          button.addEventListener("click", addCartClicked)
      }  

      function addCartClicked(event) {
          var button = event.target;
          var products = button.parentElement;
          var title = products.getElementsByClassName('product-title')[0].innerText;
          var price = products.getElementsByClassName('price')[0].innerText;
          var imgSrc = products.getElementsByClassName('product-img')[0].src;

          var cartItem = {
              title: title,
              price: price,
              imgSrc: imgSrc
          };
          cartItems.push(cartItem);

          updateTotal();
      }

      document.getElementsByClassName('btn-buy')[0].addEventListener('click', buyButtonClicked)

      function buyButtonClicked() {
          var cartContent = document.getElementsByClassName('cart-content')[0]
          if (cartContent.hasChildNodes()) {
              alert('Seus produtos estão na aba de pagamento!')
              while (cartContent.hasChildNodes()) {
                  cartContent.removeChild(cartContent.firstChild);
              }
          } else {
              alert('Você não possui itens no carrinho.')
          }
          updateTotal()
      }

      function updateTotal() {
          var cartContent = document.getElementsByClassName('cart-content')[0];
          var cartHeaderContent = document.getElementsByClassName('cart-content-header')[0];
          var total = 0;

          cartHeaderContent.innerHTML = '';

          for (var i = 0; i < cartItems.length; i++) {
              var cartItem = cartItems[i];
              var cartBox = document.createElement('div');
              cartBox.classList.add('cart-box');

              var cartBoxContent = `
                  <img src="${cartItem.imgSrc}" alt="" class="cart-img">
                  <div class="detail-box">
                      <div class="cart-product-title">${cartItem.title}</div>
                      <div class="cart-price">R$ ${parseFloat(cartItem.price).toFixed(2).replace('.', ',')}</div>
                  </div>
                  <i class="fa-solid fa-trash cart-remove"></i>
              `;

              var cartBoxHeader = document.createElement('div');
              cartBoxHeader.classList.add('cart-box-header');
              cartBoxHeader.innerHTML = cartBoxContent;
              cartHeaderContent.appendChild(cartBoxHeader);

              var priceRS = cartItem.price.replace('R$', '');
              var priceDot = priceRS.replace('.', '');
              var price = priceDot.replace(',', '.');
              total += parseFloat(price);
          }

          var formatter = new Intl.NumberFormat('pt-BR', {
              style: 'currency',
              currency: 'BRL',
              minimumFractionDigits: 2,
          });

          document.getElementsByClassName('total-price')[0].innerText = `R$ ${total.toFixed(2).replace('.', ',')}`;
      }

      updateTotal();
  
