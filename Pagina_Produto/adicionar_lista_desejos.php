<?php
session_start();

if (isset($_SESSION['usuario_id']) && isset($_POST['product_id'])) {

    include("/xampp/htdocs/Estoque/conexao.php");
    include("/xampp/htdocs/Conta/SQL/conexao.php");

    
    $userId = $_SESSION['usuario_id'];



    $sqlWishlist = "SELECT wishlist FROM usuarios WHERE id = $userId";
    $resultWishlist = $conn->query($sqlWishlist);

    if ($resultWishlist) {
        $row = $resultWishlist->fetch_assoc();
        $wishlist = $row['wishlist'];


        $wishlistArray = explode(',', $wishlist);
        $placeholders = rtrim(str_repeat('?,', count($wishlistArray)), ',');
        

        $sqlProducts = "SELECT * FROM produtos WHERE id IN ($placeholders)";
        $stmt = $conn->prepare($sqlProducts);


        $types = str_repeat('i', count($wishlistArray));
        $stmt->bind_param($types, ...$wishlistArray);
        $stmt->execute();
        $resultProducts = $stmt->get_result();

        if ($resultProducts->num_rows > 0) {

            while ($rowProduct = $resultProducts->fetch_assoc()) {
                echo "<h2>" . $rowProduct['nome'] . "</h2>";
                echo "<p>Preço: R$ " . $rowProduct['preco'] . "</p>";
                echo "<p>Descrição: " . $rowProduct['descricao'] . "</p>";
                echo "<hr>";
            }
        } else {
            echo "Nenhum produto na lista de desejos.";
        }
    } else {
        echo "Erro ao buscar a lista de desejos do usuário: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Usuário não autenticado.";
}
?>