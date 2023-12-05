document.addEventListener("DOMContentLoaded", function() {
    const buttonRecuperar = document.getElementById("Recuperar");
    const overlay = document.getElementById("overlay");
  
    buttonRecuperar.addEventListener("click", (event) => {
      event.preventDefault();
  
      overlay.style.display = "block";
  
      setTimeout(() => {
        window.location.href = "../Conta/redefinir_senha/redefinirsenha.html";
      }, 500);
    });
  });
  