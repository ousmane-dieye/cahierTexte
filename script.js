const form = document.getElementById("accountForm");
const successMessage = document.getElementById("successMessage");

form.addEventListener("submit", function (e) {
  e.preventDefault();

  document.querySelectorAll(".error-message").forEach((msg) => {
    msg.style.display = "none";
  });

  let isValid = true;

  const prenom = document.getElementById("prenom").value.trim();
  if (prenom === "") {
    document.getElementById("prenomError").style.display = "block";
    isValid = false;
  }

  const nom = document.getElementById("nom").value.trim();
  if (nom === "") {
    document.getElementById("nomError").style.display = "block";
    isValid = false;
  }

  const email = document.getElementById("email").value.trim();
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailRegex.test(email)) {
    document.getElementById("emailError").style.display = "block";
    isValid = false;
  }

  const classe = document.getElementById("classe").value;
  if (classe === "") {
    document.getElementById("classeError").style.display = "block";
    isValid = false;
  }

  const motdepasse = document.getElementById("motdepasse").value;
  if (motdepasse.length < 6) {
    document.getElementById("motdepasseError").style.display = "block";
    isValid = false;
  }

  const confirmation = document.getElementById("confirmation").value;
  if (motdepasse !== confirmation) {
    document.getElementById("confirmationError").style.display = "block";
    isValid = false;
  }

  if (isValid) {
    successMessage.style.display = "block";
    form.reset();

    setTimeout(() => {
      successMessage.style.display = "none";
    }, 3000);

    console.log("Compte créé:", {
      prenom: prenom,
      nom: nom,
      email: email,
      classe: classe,
    });
  }
});
