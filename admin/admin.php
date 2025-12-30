<?php 
    session_start();
    require_once "../db.php";

    if(!isset($_SESSION['id_etudiant'])){
        header('loaction: ../index.php');
    }

    $sql = "select count(*) from classe";
    $stmt = $pdo->prepare($sql);      
    $stmt->execute([]);
    $nmb_classe = $stmt->fetchColumn();

    $sql = "select count(id_etudiant) from etudiant";
    $stmt = $pdo->prepare($sql);
            
    $stmt->execute([]);
    $nmb_etudiant = $stmt->fetchColumn();


    $sql = "select count(id_etudiant) from etudiant where role = 'delegue'";
    $stmt = $pdo->prepare($sql);
            
    $stmt->execute([]);
    $nmb_delegue = $stmt->fetchColumn();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Root</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>

<div class="container">

    <aside class="sidebar">
        <h2 class="logo">Cahier de Texte</h2>

        <nav>
            <p class="menu-title">MAIN</p>
            <button onclick="showSection('dashboard')" class="active">🏠 Dashboard</button>

            <p class="menu-title">CLASSES</p>
            <button onclick="showSection('classes')">🏫 Gestion des Classes</button>
            <button onclick="showSection('delegates')">👥 Gestion des Délégués</button>

            <p class="menu-title">USERS</p>
            <button onclick="showSection('users')">👥 Gestion des Users</button>

            <p class="menu-title">SITE MANAGEMENT</p>
            <button onclick="showSection('settings')">⚙️ Paramètres</button>
        </nav>

        <div class="btn_logout">
        <button class="logout" onclick="window.location.href='../connexion/connexion.html'">LOGOUT</button>
        </div>
    </aside>

    <main class="main">

        
        <section id="dashboard" class="section active">
            <header class="topbar">
                <div>
                    <small>Pages / Dashboard</small>
                    <h1>Dashboard</h1>
                </div>
                <div class="badge">Admin</div>
            </header>

            <div class="cards">
                <div class="card">
                    <p>Total Classes</p>
                    <h2><?php echo($nmb_classe); ?></h2>
                </div>
                <div class="card">
                    <p>Total Users</p>
                    <h2><?php echo($nmb_etudiant); ?></h2>
                </div>
                <div class="card">
                    <p>Total Delegates</p>
                    <h2><?php echo($nmb_delegue); ?></h2>
                </div>
            </div>
        </section>



        <section id="classes" class="section">
        <h2>Gestion des Classes</h2>

        <button class="add_classe" id="add_classe">➕ Ajouter une Classe</button>

            <div class="form-box" id="formBox">
                <form id="classForm" action="ajouterClasse.php" method="post" >
                    <input type="text" id="name" name = "nom_classe" value ="<?= $_SESSION['old']['nom_classe'] ?? '' ?>" placeholder="Nom de la classe" required>
                    <input type="number" id="students"  name= "nmr_eleve" placeholder="Nombre d'élèves" >
                    <input type="text" id="delegue" name = "resp" placeholder="Responsable (ou aucun)"> 
                    <select id="level" name = "niveau" required>
                        <option value="">Année</option>
                        <option value="premiere_annee">1</option>
                        <option value="deuxieme_annee">2</option>
                        <option value="troisieme_annee">3</option>
                        <option value="quatrieme_annee">4</option>
                        <option value="cinquieme_annee">5</option>
                    </select>
                    <button type="submit">Ajouter</button>
                    <button type="button" onclick="formBox.style.display='none'">Annuler</button>
                </form>
            </div>

            <div class="cards" id="classCards"></div>
        </section>

        


        <section id="users" class="section">  
            <h2>Gestion des Users</h2>

            <div class="users-controls">
                <button id="addUserBtn">➕ Ajouter un Étudiant</button>
                <input type="text" id="searchUser" placeholder="🔍 Rechercher un utilisateur">
            </div>

            <div class="form-box" id="userFormBox">
                <form id="userForm">

                    <input type="text" id="userFirstName" placeholder="Prénom" required>
                    <input type="text" id="userLastName" placeholder="Nom" required>

                    <input type="email" id="userEmail" placeholder="Email" required>

                    <input type="text" id="userClass" placeholder="Classe " required>

                    <select id="userRole" required>
                        <option value="">Rôle</option>
                        <option>Admin</option>
                        <option>Étudiant</option>
                        <option>Délégué</option>
                    </select>

                    <button type="submit">Enregistrer</button>
                    <button type="button" onclick="closeUser()">Annuler</button>

                </form>
            </div>

            <div class="cards" id="usersCards"></div> 
        </section>



        <section id="delegates" class="section">
            <h2>Gestion des Délégués</h2>

                <div class="users-controls">
                    <button id="addDelegateBtn">➕ Ajouter un Délégué</button>
                    <input type="text" id="searchDelegate" placeholder="🔍 Rechercher un délégué">
                </div>

                <div class="form-box" id="delegateFormBox">
                    <form id="delegateForm">

                        <input type="text" id="delFirstName" placeholder="Prénom" required>
                        <input type="text" id="delLastName" placeholder="Nom" required>

                        <input type="email" id="delEmail" placeholder="Email" required>

                        <input type="text" id="delClass" placeholder="Classe (ex : L2 Info)" required>

                        <button type="submit">Enregistrer</button>
                        <button type="button" onclick="closeDelegate()">Annuler</button>

                    </form>
                </div>

                <div class="cards" id="delegatesCards"></div>

        </section>




        <section id="settings" class="section">
            <h2>Paramètres</h2>
            <p>Configuration du site...</p>
        </section>

        <footer>
            © 2026, cahierTexte , Made by 36G ESP.
        </footer>

    </main>
</div>

<script >

function showSection(id) {
    document.querySelectorAll('.section').forEach(s => s.classList.remove('active'));
    document.querySelectorAll('.sidebar button').forEach(b => b.classList.remove('active'));

    document.getElementById(id).classList.add('active');

    event.target.classList.add('active');
}


const add_classe = document.getElementById("add_classe");
const formBox = document.getElementById("formBox");
const form = document.getElementById("classForm");
const cards = document.getElementById("classCards");

const nameInput = document.getElementById("name");
const studentsInput = document.getElementById("students");
const delegueInput = document.getElementById("delegue");
const levelInput = document.getElementById("level");

add_classe.onclick = () => formBox.style.display = "block";

function updateTotal() {
    const total = document.getElementById("totalClasses");
    if (total) total.textContent = cards.children.length;
}

form.onsubmit = e => {
    e.preventDefault();

    const nameVal = nameInput.value.trim();
    const studentsVal = studentsInput.value.trim();
    const delegueVal = delegueInput.value.trim();
    const levelVal = levelInput.value;

    if (!nameVal || !studentsVal || !levelVal) return; 

    const card = document.createElement("div");
    card.className = "card";

    card.innerHTML = `
        <p>Niveau ${levelVal}</p>
        <h2>${nameVal}</h2>
        <small>${studentsVal} élèves</small><br>
        <small>Responsable : ${delegueVal || "Aucun"}</small>
        <div class="class-actions">
            <button class="edit">Modifier</button>
            <button class="delete">Supprimer</button>
        </div>
    `;

    card.querySelector(".delete").onclick = () => {
        card.remove();
        updateTotal();
    };

    card.querySelector(".edit").onclick = () => {
        nameInput.value = nameVal;
        studentsInput.value = studentsVal;
        delegueInput.value = delegueVal;
        levelInput.value = levelVal;

        formBox.style.display = "block";
        card.remove();
        updateTotal();
    };

    cards.appendChild(card);
    updateTotal();

    form.reset();
    formBox.style.display = "none";
};



const addUserBtn = document.getElementById("addUserBtn");
const userFormBox = document.getElementById("userFormBox");
const userForm = document.getElementById("userForm");
const usersCards = document.getElementById("usersCards");
const searchUser = document.getElementById("searchUser");

const userFirstNameInput = document.getElementById("userFirstName");
const userLastNameInput  = document.getElementById("userLastName");
const userEmailInput     = document.getElementById("userEmail");
const userClassInput     = document.getElementById("userClass");
const userRoleInput      = document.getElementById("userRole");

let users = [];
let editIndex = null;

addUserBtn.onclick = () => {
    userForm.reset();
    editIndex = null;
    userFormBox.style.display = "block";
};

function closeUser() {
    userFormBox.style.display = "none";
}

userForm.onsubmit = e => {
    e.preventDefault();

    const user = {
        firstName: userFirstNameInput.value.trim(),
        lastName: userLastNameInput.value.trim(),
        email: userEmailInput.value.trim(),
        className: userClassInput.value.trim(),
        role: userRoleInput.value
    };

    if (editIndex !== null) {
        users[editIndex] = user;
        editIndex = null;
    } else {
        users.push(user);
    }

    trierUsers();
    afficherUsers(searchUser.value);
    closeUser();
};

function trierUsers() {
    users.sort((a, b) => a.lastName.localeCompare(b.lastName));
}

function afficherUsers(filter = "") {
    usersCards.innerHTML = "";

    users
        .filter(u =>
            (u.firstName + " " + u.lastName)
                .toLowerCase()
                .includes(filter.toLowerCase())
        )
        .forEach((user, index) => {

            const card = document.createElement("div");
            card.className = "card";

            card.innerHTML = `
                <h3>${user.firstName} ${user.lastName}</h3>
                <small>${user.email}</small><br>
                <small>Classe : <b>${user.className}</b></small><br>
                <span>${user.role}</span>

                <div class="class-actions">
                    <button class="edit">Modifier</button>
                    <button class="delete">Supprimer</button>
                </div>
            `;

            card.querySelector(".edit").onclick = () => {
                userFirstNameInput.value = user.firstName;
                userLastNameInput.value  = user.lastName;
                userEmailInput.value     = user.email;
                userClassInput.value     = user.className;
                userRoleInput.value      = user.role;

                editIndex = index;
                userFormBox.style.display = "block";
            };

            card.querySelector(".delete").onclick = () => {
                if (confirm("Supprimer cet utilisateur ?")) {
                    users.splice(index, 1);
                    afficherUsers(searchUser.value);
                }
            };

            usersCards.appendChild(card);
        });
}

searchUser.oninput = () => {
    afficherUsers(searchUser.value);
};





const addDelegateBtn   = document.getElementById("addDelegateBtn");
const delegateFormBox  = document.getElementById("delegateFormBox");
const delegateForm     = document.getElementById("delegateForm");
const delegatesCards   = document.getElementById("delegatesCards");
const searchDelegate   = document.getElementById("searchDelegate");

const delFirstNameInput = document.getElementById("delFirstName");
const delLastNameInput  = document.getElementById("delLastName");
const delEmailInput     = document.getElementById("delEmail");
const delClassInput     = document.getElementById("delClass");

let delegates = [];
let editDelegateIndex = null;

addDelegateBtn.onclick = () => {
    delegateForm.reset();
    editDelegateIndex = null;
    delegateFormBox.style.display = "block";
};

function closeDelegate() {
    delegateFormBox.style.display = "none";
}

delegateForm.onsubmit = e => {
    e.preventDefault();

    const newDelegate = {
        firstName: delFirstNameInput.value.trim(),
        lastName: delLastNameInput.value.trim(),
        email: delEmailInput.value.trim(),
        className: delClassInput.value.trim()
    };

    const exists = delegates.some(
        (d, i) => d.className === newDelegate.className && i !== editDelegateIndex
    );

    if (exists) {
        alert("Cette classe a déjà un délégué !");
        return;
    }

    if (editDelegateIndex !== null) {
        delegates[editDelegateIndex] = newDelegate;
        editDelegateIndex = null;
    } else {
        delegates.push(newDelegate);
    }

    trierDelegues();
    afficherDelegues(searchDelegate.value);
    closeDelegate();
};

function trierDelegues() {
    delegates.sort((a, b) => a.lastName.localeCompare(b.lastName));
}

function afficherDelegues(filter = "") {
    delegatesCards.innerHTML = "";

    delegates
        .filter(d =>
            (d.firstName + " " + d.lastName)
                .toLowerCase()
                .includes(filter.toLowerCase())
        )
        .forEach((delegate, index) => {

            const card = document.createElement("div");
            card.className = "card";

            card.innerHTML = `
                <h3>${delegate.firstName} ${delegate.lastName}</h3>
                <small>${delegate.email}</small><br>
                <small>Classe : <b>${delegate.className}</b></small>

                <div class="class-actions">
                    <button class="edit">Modifier</button>
                    <button class="delete">Supprimer</button>
                </div>
            `;

            card.querySelector(".edit").onclick = () => {
                delFirstNameInput.value = delegate.firstName;
                delLastNameInput.value  = delegate.lastName;
                delEmailInput.value     = delegate.email;
                delClassInput.value     = delegate.className;

                editDelegateIndex = index;
                delegateFormBox.style.display = "block";
            };

            card.querySelector(".delete").onclick = () => {
                if (confirm("Supprimer ce délégué ?")) {
                    delegates.splice(index, 1);
                    afficherDelegues(searchDelegate.value);
                }
            };

            delegatesCards.appendChild(card);
        });
}

searchDelegate.oninput = () => {
    afficherDelegues(searchDelegate.value);
};


</script>

</body>
</html>
