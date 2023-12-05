const cpfInput = document.getElementById("CPF");

cpfInput.addEventListener("input", function () {
    // Remove tudo exceto números
    this.value = this.value.replace(/\D/g, "");

    // Aplica a formatação do CPF: XXX.XXX.XXX-XX
    if (this.value.length > 9) {
        this.value = this.value.replace(/^(\d{3})(\d{3})(\d{3})(\d{2}).*/, "$1.$2.$3-$4");
    } else if (this.value.length > 6) {
        this.value = this.value.replace(/^(\d{3})(\d{3})(\d{0,3}).*/, "$1.$2.$3");
    } else if (this.value.length > 3) {
        this.value = this.value.replace(/^(\d{3})(\d{0,3}).*/, "$1.$2");
    }
});

// Restante do seu JavaScript

const numeroInput = document.getElementById("numero");

numeroInput.addEventListener("input", function () {
// Remove tudo exceto números
this.value = this.value.replace(/\D/g, "");

// Formatação de máscara: (xx) xxxxx-xxxx
if (this.value.length > 10) {
this.value = this.value.replace(/^(\d{2})(\d{5})(\d{4}).*/, "($1) $2-$3");
} else if (this.value.length > 6) {
this.value = this.value.replace(/^(\d{2})(\d{4})(\d{0,4}).*/, "($1) $2-$3");
} else if (this.value.length > 2) {
this.value = this.value.replace(/^(\d{2})(\d{0,5}).*/, "($1) $2");
}
});
const senhaInput = document.getElementById("senha");
const confirmarSenhaInput = document.getElementById("confirmarSenha");
const senhaMatchMessage = document.getElementById("senhaMatchMessage");
const senhaForm = document.getElementById("senhaForm");

function checkSenhaMatch() {
  senhaMatchMessage.classList.add("show");

    if (senhaInput.value !== confirmarSenhaInput.value) {
        senhaMatchMessage.textContent = "As senhas não coincidem.";
        senhaMatchMessage.style.color = "red";
        
    } else {
        senhaMatchMessage.textContent = "As senhas coincidem.";
        senhaMatchMessage.style.color = "green";
    }
}

senhaForm.addEventListener("submit", function(event) {
    if (senhaInput.value !== confirmarSenhaInput.value) {
        event.preventDefault();
        senhaMatchMessage.textContent = "As senhas não coincidem.";
        senhaMatchMessage.style.color = "red";
    }
});

senhaInput.addEventListener("input", checkSenhaMatch);
confirmarSenhaInput.addEventListener("input", checkSenhaMatch);

document.addEventListener('DOMContentLoaded', function () {
document.getElementById('fecharMensagem').addEventListener('click', function () {
    document.querySelector('.message').style.display = 'none';
});
});