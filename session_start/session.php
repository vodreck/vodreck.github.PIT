<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
function verificarCliente() {
    if (isset($_SESSION['usuario_id']) && isset($_SESSION['permissoes']) && $_SESSION['permissoes'] === 'cliente') {
        return true;
    } else {
        return false;
    }
}

function verificarAdministrador() {
    if (isset($_SESSION['usuario_id']) && isset($_SESSION['permissoes']) && $_SESSION['permissoes'] === 'admin') {
        return true;
    } else {
        return false;
    }
}



function gerarTokenUnico() {
    return bin2hex(openssl_random_pseudo_bytes(32)); 
}


function loginUsuario($usuario_id, $permissao) {
    $_SESSION['usuario_id'] = $usuario_id;
    $_SESSION['permissoes'] = $permissao;
    $_SESSION['session_token'] = gerarTokenUnico(); 
    $_SESSION['data_registro'] = date('Y-m-d H:i:s'); 

    $_SESSION['ultima_atualizacao_sessao'] = date('Y-m-d H:i:s');
}


function logoutCliente() {

    session_unset();
    session_destroy();
}

function verificarAtualizarSessao() {
    if (isset($_SESSION['ultima_atualizacao_sessao']) && time() - strtotime($_SESSION['ultima_atualizacao_sessao']) > 30 * 60) {
        $_SESSION['ultima_atualizacao_sessao'] = date('Y-m-d H:i:s');
    }
}

verificarAtualizarSessao();
?>
