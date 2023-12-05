<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/Header/header.php';

    ?> 
  

<!DOCTYPE html>
<html>
<head>
    <title>Página de Pagamento</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/Pagamento-Frete/css/stylePa.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<div id="Container26" class="container mt-5">
        <h2>Detalhes de Pagamento</h2>
        <form action="processar_pagamento.php" method="post" id="pagamentoForm">
            <div class="form-group">
                <label for="metodo_pagamento"></label>
                <select class="form-control" id="metodo_pagamento" name="metodo_pagamento" required>
                    <option value="cartao_credito">Escolher método de pagamento</option>
                    <option value="cartao_credito">Cartão de Crédito</option>
                    <option value="pix">PIX</option>
                </select>
            </div>

            <div    id="campos_cartao" style="display: none;">
                <div class="form-group">
                    <label for="nome">Nome no Cartão:</label>
                    <input type="text" class="form-control" id="nome" name="nome_cartao" placeholder="Digite o Nome Escrito no Cartão" required>
                </div>
                <div class="form-group">
                    <label for="numero_cartao">Número do Cartão:</label>
                    <input type="text" class="form-control" id="numero_cartao" name="numero_cartao"  maxlength="19" placeholder="XXXX XXXX XXXX XXXX" oninput="formatarNumeroCartao(this)" required>
                </div>
                <div class="form-group">
                    <label for="data_validade">Data de Validade:</label>
                    <input type="text" class="form-control" id="data_validade" name="data_validade" placeholder="MM/AA" maxlength="5" oninput="formatarDataValidade(this)" required>
                </div>
                <div class="form-group">
                    <label for="cvv">CVV:</label>
                    <input type="text" class="form-control" id="cvv" name="cvv" placeholder="XXX" maxlength="3" onkeypress="return onlyNumbers(event)" required>
            </div>

            <div id="carregamento">
        <div id="statusPagamento">
        <p style="color: red;">Pendente</p>
            <button type="button" type="button" type="button" id="confirmarPagamento" onclick="verificarPagamento()">Confirmar Pagamento</button>
        </div>

        <div id="verificando" style="display: none;">
            <p style="color: coral;">Verificando pagamento...</p>
            <img id="img2" src="/Pagamento-Frete/img/carregando.gif" alt="Loading">
        </div>

        <div id="pagamentoRecebido" style="display: none;">
            <p style="color: green;">Pagamento recebido</p>
            <button type="button" type="button" type="button" id="acompanharPedido" onclick="irParaAcompanhamento()">Acompanhar Pedido</button>
        </div>
    </div>
    
            </div>

           
            <div id="qr_code_pix" style="display: none;">
                <h4>QR Code PIX:</h4>
                <img src="/Pagamento-Frete/img/QRCODE-pagamento.png" alt="QR Code PIX">
                <p>Chave aleatória PIX : 1234567890115165156451251563145314521515615451521545145641</p>

                <div id="carregamento">
        <div id="statusPagamento2">
            <p style="color: red;">Pendente</p>
            <button type="button" type="button" type="button" id="confirmarPagamento" onclick="verificarPagamento2()">Confirmar Pagamento</button>
        </div>

        <div id="verificando2" style="display: none;">
            <p style="color: coral;">Verificando pagamento...</p>
            <img id="img2" src="/Pagamento-Frete/img/carregando.gif" alt="Loading">
        </div>

        <div id="pagamentoRecebido2" style="display: none;">
            <p style="color: green;">Pagamento recebido</p>
            <button type="button" type="button" type="button" id="acompanharPedido" onclick="irParaAcompanhamento2()">Acompanhar Pedido</button>
        </div>
    </div>
                
            </div>
            
          
        </form>
    </div>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
       
        document.getElementById('metodo_pagamento').addEventListener('change', function () {
            var camposCartao = document.getElementById('campos_cartao');
            var qrCodePix = document.getElementById('qr_code_pix');
            
            if (this.value === 'cartao_credito') {
                camposCartao.style.display = 'block';
                qrCodePix.style.display = 'none';
            } else if (this.value === 'pix') {
                camposCartao.style.display = 'none';
                qrCodePix.style.display = 'block';
            } else {
                camposCartao.style.display = 'none';
                qrCodePix.style.display = 'none';
            }
        });
    </script>


<script>
        function verificarPagamento() {
            document.getElementById('statusPagamento').style.display = 'none';
            document.getElementById('verificando').style.display = 'block';

            setTimeout(function () {
                document.getElementById('verificando').style.display = 'none';
                document.getElementById('pagamentoRecebido').style.display = 'block';
            }, 5000);
        }

        function irParaAcompanhamento() {
           
            window.location.href = '/Acompanhamento/acompanhamento.php'}
    </script>



<script>
        function verificarPagamento2() {
            document.getElementById('statusPagamento2').style.display = 'none';
            document.getElementById('verificando2').style.display = 'block';

            setTimeout(function () {
                document.getElementById('verificando2').style.display = 'none';
                document.getElementById('pagamentoRecebido2').style.display = 'block';
            }, 5000);
        }

        function irParaAcompanhamento2() {
           
            window.location.href = '/Acompanhamento/acompanhamento.php'}
    </script>


<script>
function formatarNumeroCartao(input) {
   
    input.value = input.value.replace(/\D/g, '');

   
    input.value = input.value.replace(/(\d{4})(?=\d)/g, '$1 ');
}
</script>

<script>
function onlyNumbers(event) {
    const charCode = (event.which) ? event.which : event.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        event.preventDefault();
        return false;
    }
    return true;
}
</script>

<script>
function formatarDataValidade(input) {
   
    input.value = input.value.replace(/\D/g, '');

   
    if (input.value.length > 2) {
        input.value = input.value.replace(/(\d{2})(\d{2})/, '$1/$2');
    }
}
</script>
</body>
</html>
