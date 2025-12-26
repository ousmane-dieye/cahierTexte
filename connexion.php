_<?php
    require_once "./db.php";

    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    if(!$email){
        exit("Le champs email est requis");
    }
    if(!$mot_de_passe){
        exit("Le champs mot de passe est requis");
    }
    
    $sql = "SELECT mot_de_passe FROM ETUDIANT WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->exevute([$email]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if(!$user){
        exit("email introuvable");
    }

    if(!password_verify($mot_de_passe, $user['mot_de_passe'])){
        exit("mot de passe introuvable");
    }


    // connexion reussie

    $_SESSION['user_id'] = $user[$id_etudiant];
    $_SESSION['nom'] = $user[$nom];
    $_SESSION['prenom'] = $user[$prenom];
    $_SESSION['id_classe'] = $user[$id_classe];
    $_SESSION['email'] = $user[$email];

    echo "connexion reussie";