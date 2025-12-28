// Sélection des éléments de la fenêtre contextuelle (Modal)
const modal = document.getElementById("taskModal");
const btnOpen = document.getElementById("openModal");
const btnClose = document.getElementById("closeModal");

// Fonction pour oubi la modal
btnOpen.onclick = function() {
    modal.style.display = "flex";
}

// Fonction pour teudj la modal via le bouton annuler
btnClose.onclick = function() {
    modal.style.display = "none";
}

// teudj la modal si l'utilisateur clique en dehors de la fenêtre blanche
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

// Simulation de la publication d'une tâche (en attendant PHP bi nieuw)
document.querySelector(".btn-primary").addEventListener("click", function(e) {
    const title = document.querySelector('input[type="text"]').value;
    if(title) {
        alert("Le devoir '" + title + "' a été ajouté à la classe !");
        modal.style.display = "none";
    }
});