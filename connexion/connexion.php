<?php
    require_once "../db.php";

    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    if(!$email){
        exit("Le champs email est requis");
    }
    if(!$mot_de_passe){
        exit("Le champs mot de passe est requis");
    }
    
    $sql = "SELECT * FROM ETUDIANT WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if(!$user){
        exit("email introuvable");
    }

    if(!password_verify($mot_de_passe, $user['mot_de_passe'])){
        exit("mot de passe invalide");
    }

 
    session_start();

    $_SESSION['id_etudiant'] = $user['id_etudiant'];
    if($user['role'] === 'root'){
        header('location: ../admin/admin.php');
        exit;
    }else{
        header('location: ../PageEleve/eleve.php');
        exit;    
    }
