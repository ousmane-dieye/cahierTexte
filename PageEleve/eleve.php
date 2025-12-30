<?php 
session_start();



if(!isset($_SESSION['id_etudiant'])){
    header('../index.php');
}
require_once "../db.php";

$sql = "SELECT * FROM ETUDIANT WHERE id_etudiant = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$_SESSION['id_etudiant']]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

$sql = "SELECT * FROM classe WHERE id_classe = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$user['classe_id']]);
$classe = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$classe) {
    die("Classe introuvable");
}

$sql = "SELECT count(*) from tache where classe_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$user['classe_id']]);
$nmbre_tache = $stmt->fetchColumn();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="eleve.css">
    <title>Mon Suivi Élève</title>
</head>
<body>
    <aside class="sidebar">
        <div class="logo"><?php echo(strtoupper($classe['nom_classe'])) ?></div>
        <nav>
            <a href="#" class="nav-link"><i>📝</i> <span>Mes Devoirs</span></a>
            <a href="#" class="nav-link"><i>📊</i> <span>Progression</span></a>
        </nav>
    </aside>

    <main class="main-content">
        <header class="header-welcome">
        <p class="welcome-message">Bienvenue <strong><?php echo ucwords($user['nom'])," ", ucwords($user['prenom']) ?></strong></p>
        <h1>Mes Devoirs à Faire</h1>
        </header>
        <div class="task-grid">
            <?php if($nmbre_tache == 0){ ?>
                <div class="card-todo">
                    <!-- <input type="checkbox" class="task-check"> -->
                    <div class="info">
                        <h3>Aucun travail a faire </h3>
                        <!-- <p>Rapport TP SSH</p> -->
                    </div>
                </div>
            <?php }?>
            <?php for($i=0; $i < $nmbre_tache; $i++){ ?>
                <div class="card-todo">
                    <input type="checkbox" class="task-check">
                    <div class="info">
                        <h3>Administration Réseau</h3>
                        <p>Rapport TP SSH</p>
                    </div>
                </div>
            <?php } ?>
        </div>
    </main>
    <script src="eleve.js"></script>
</body>
</html>