function showSection(sectionId) {
    const sections = document.querySelectorAll('.section');
    sections.forEach(s => s.classList.remove('active'));

    const buttons = document.querySelectorAll('aside button');
    buttons.forEach(b => b.classList.remove('active'));

    document.getElementById(sectionId).classList.add('active');
    document.querySelector(`aside button[onclick="showSection('${sectionId}')"]`).classList.add('active');
    
}


const showFormBtn = document.getElementById("showClassForm");
const formBox = document.getElementById("classFormBox");
const cancelForm = document.getElementById("cancelForm");
const classForm = document.getElementById("classForm");
const classCards = document.getElementById("classCards");

showFormBtn.onclick = () => {
    formBox.style.display = "block";
};

cancelForm.onclick = () => {
    formBox.style.display = "none";
};

classForm.onsubmit = function(e) {
    e.preventDefault();

    const name = className.value;
    const students = classStudents.value;
    const manager = classManager.value || "Aucun";
    const level = classLevel.value;

    const card = document.createElement("div");
    card.className = "card";

    card.innerHTML = `
        <p>Niveau ${level}</p>
        <h2>${name}</h2>
        <small>${students} élèves</small><br>
        <small>Responsable : ${manager}</small>

        <div class="class-actions">
            <button class="edit">Modifier</button>
            <button class="delete">Supprimer</button>
        </div>
    `;

    card.querySelector(".delete").onclick = () => card.remove();

    classCards.appendChild(card);

    classForm.reset();
    formBox.style.display = "none";
};


