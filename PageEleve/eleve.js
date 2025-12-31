const linkDevoirs = document.querySelector('.nav-link:nth-child(1)');
const linkProgression = document.querySelector('.nav-link:nth-child(2)');
const viewDevoirs = document.getElementById('view-devoirs');
const viewProgression = document.getElementById('view-progression');
const mainTitle = document.getElementById('main-title');


function switchView(view) {
    if (view === 'progression') {
        viewDevoirs.style.display = 'none';
        viewProgression.style.display = 'grid';
        mainTitle.innerText = "Ma Progression";
        updateStats(); 
    } else {
        viewDevoirs.style.display = 'block';
        viewProgression.style.display = 'none';
        mainTitle.innerText = "Mes Devoirs à Faire";
    }
}

linkDevoirs.addEventListener('click', () => {
    linkDevoirs.classList.add('active');
    linkProgression.classList.remove('active');
    switchView('devoirs');
});

linkProgression.addEventListener('click', () => {
    linkProgression.classList.add('active');
    linkDevoirs.classList.remove('active');
    switchView('progression');
});

// Calcul des statistiques 
function updateStats() {
    const total = document.querySelectorAll('.task-check').length;
    const done = document.querySelectorAll('.task-check:checked').length;
    const remaining = total - done;
    const percentage = total > 0 ? Math.round((done / total) * 100) : 0;

    // Injection si HTML bi
    document.getElementById('stat-perc').innerText = percentage + "%";
    document.getElementById('stat-rem').innerText = remaining;
    document.getElementById('stat-done').innerText = done;
    document.getElementById('stat-ratio-done').innerText = done;
    document.getElementById('stat-total').innerText = total;
}

const links = document.querySelectorAll('.nav-link');

links.forEach(link => {
    link.addEventListener('click', function() {
        // Enlever la classe active de tous les liens
        links.forEach(l => l.classList.remove('active'));
        // ajouter ko uniquement sur le lien cliqué
        this.classList.add('active');
    });
});

// Gerer tâches yignou marquer comme "terminées"
document.querySelectorAll('.task-check').forEach(checkbox => {
    checkbox.addEventListener('change', function() {
        const taskCard = this.closest('.card-todo');
        
        if (this.checked) {
            // Applique le style .completed défini dans le fichier eleve.css
            taskCard.classList.add('completed');
            console.log("Tâche marquée comme terminée."); // Utile pour le futur suivi individuel [1]
        } else {
            taskCard.classList.remove('completed');
        }
        
        // Optionnel : Mise à jour simulée des statistiques personnelles(pour le moment si console bi rk ley afficher)
        updateProgress();
    });
});

function updateProgress() {
    const total = document.querySelectorAll('.task-check').length;
    const done = document.querySelectorAll('.task-check:checked').length;
    const percentage = Math.round((done / total) * 100);
    console.log("Progression actuelle : " + percentage + "%");
}

// function updateAllCountdowns() {
//     const now = new Date().getTime();
//     const tasks = document.querySelectorAll('.card-todo');

//     tasks.forEach(task => {
//         if (task.classList.contains('completed')) {
//             return; // On passe à la tâche suivante sans modifier le texte
//         }

//         const deadlineAttr = task.getAttribute('data-deadline');
//         const deadline = new Date(deadlineAttr).getTime();
//         const timeLeft = deadline - now;

//         const timerDisplay = task.querySelector('.countdown-timer');

//         if (timeLeft <= 0) {
//             task.style.opacity = '0';
//             setTimeout(() => task.remove(), 500);
//             return;
//         }

//         const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
//         const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
//         const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
//         const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

//         if (days >= 1) {
//             timerDisplay.innerHTML = `${days}j ${hours}h`;
//         } else {
//             timerDisplay.innerHTML = `${hours}h ${minutes}m ${seconds}s`;
//         }

//         if (timeLeft < (3 * 60 * 60 * 1000)) {
//             timerDisplay.classList.add('urgent-timer');
//         } else {
//             timerDisplay.classList.remove('urgent-timer');
//         }
//     });
// }

// setInterval(updateAllCountdowns, 1000);
// updateAllCountdowns(); // Lancement immédiat