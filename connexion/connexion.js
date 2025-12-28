const form = document.querySelector("form");
const emailInput = document.querySelector('input[type="email"]');
const passwordInput = document.getElementById("password");
const voirIcon = document.querySelector(".voir-password");

const emailError = document.createElement("p");
emailError.style.color = "#d32f2f";
emailError.style.fontSize = "13px";
emailError.style.marginTop = "5px";
emailInput.parentNode.appendChild(emailError);

const passwordError = document.createElement("p");
passwordError.style.color = "#d32f2f";
passwordError.style.fontSize = "13px";
passwordError.style.marginTop = "5px";
passwordInput.parentNode.appendChild(passwordError);


voirIcon.addEventListener("click", () => {
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        voirIcon.classList.replace("fa-eye", "fa-eye-slash");
    } else {
        passwordInput.type = "password";
        voirIcon.classList.replace("fa-eye-slash", "fa-eye");
    }
});



form.addEventListener("submit", (e) => {
    e.preventDefault(); 

    let valid = true;

    emailError.textContent = "";
    passwordError.textContent = "";

    const email = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailInput.value) {
        emailError.textContent = "⚠️ Email obligatoire";
        valid = false;
    } else if (!email.test(emailInput.value)) {
        emailError.textContent = "⚠️ Email invalide (_@_._)";
        valid = false;
    }

    if (!passwordInput.value) {
        passwordError.textContent = "⚠️ Mot de passe obligatoire";
        valid = false;
    } else if (passwordInput.value.length < 6) {
        passwordError.textContent = "⚠️ Au moins 6 caractères";
        valid = false;
    }

    if (valid) {
        form.submit(); 
    }
});
