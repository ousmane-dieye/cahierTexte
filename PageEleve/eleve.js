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