<?php
include $_SERVER['DOCUMENT_ROOT'] . '/session_start/session.php';
include $_SERVER['DOCUMENT_ROOT'] . '/Header/header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Agradecimento pela Compra</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/agradecimento/css/style.css">
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3 text-center">
                <h1>Obrigado por sua compra!</h1>
                <p>Sua compra foi concluída com sucesso. Agradecemos por escolher nossa loja.</p>
                
                <div class="animation">
                    <img src="/agradecimento/img/agrade.gif" alt="Animação de agradecimento">
                </div>
                
                <a href="/Home/home.php" class="btn btn-primary">Voltar para a página inicial</a>
            </div>
        </div>
    </div>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/Footer/footer.php'; ?>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
