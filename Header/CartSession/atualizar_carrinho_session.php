<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['action'] == 'update_cart' && isset($_POST['cartItems'])) {
        $cartItems = json_decode($_POST['cartItems'], true);

        $_SESSION['cart'] = $cartItems;

        echo 'Carrinho atualizado com sucesso.';
    }
}
?>
