const cpfInput = document.getElementById("CPF");

        cpfInput.addEventListener("input", function () {
            this.value = this.value.replace(/\D/g, "");

            if (this.value.length > 9) {
                this.value = this.value.replace(/^(\d{3})(\d{3})(\d{3})(\d{2}).*/, "$1.$2.$3-$4");
            } else if (this.value.length > 6) {
                this.value = this.value.replace(/^(\d{3})(\d{3})(\d{0,3}).*/, "$1.$2.$3");
            } else if (this.value.length > 3) {
                this.value = this.value.replace(/^(\d{3})(\d{0,3}).*/, "$1.$2");
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




     

        function fecharMensagem() {
    var mensagem = document.querySelector('.message');
    mensagem.style.display = 'none';
}