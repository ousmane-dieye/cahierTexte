<?php 


    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        try{
            require_once "./db.php";
            

            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $email = $_POST['email'];
            $classe = $_POST['classe'];
            $mot_de_passe = $_POST['mot_de_passe'];
            $confirmer_mdp = $_POST['confirmer_mdp'];

            if (!$nom){
                exit("Champs Nom manquant");
            }elseif(!$prenom){
                exit("Champs Prenom manquant");
            }elseif(!$email){
                exit("Champs email manquant");
            }elseif(!$classe){
                exit("Champs classe manquant");
            }elseif(!$mot_de_passe){
                exit("Champs mot de passe manquant");
            }elseif(!$confirmer_mdp){
                exit("Champs confirmer mot de passe manquant");
            }


            $sql = "SELECT id_etudiant FROM etudiant WHERE email = ? ";
            $stmt = $pdo->prepare($sql);
            
            $stmt->execute([$email]);

            if ($stmt->rowCount() > 0){
                exit("Email deja utilise");
            }

            if(strlen($mot_de_passe) < 6){
                exit("Le mot de passe doit contenir au moins 6 caracteres");
            }

            if ($mot_de_passe !== $confirmer_mdp){
                exit("Les mots de passe ne correspondent pas");
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                exit("Email invalide");
            }
            $sql = "SELECT id_classe FROM classe WHERE nom_classe = ?";
            $stmt = $pdo->prepare($sql);

            $stmt->execute([$classe]);
            $id_classe = $stmt->fetchColumn();

            if(!$id_classe){
                exit("classe introuvable");
            }

            $hash = password_hash($mot_de_passe, PASSWORD_BCRYPT);

            $sql = "INSERT INTO etudiant (nom,prenom, email, mot_de_passe, classe_id) VALUES (?,?,?,?,?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$nom, $prenom, $email, $hash, $id_classe]);

            echo("inscription reussie");
        }
        catch(PDOException $e){
            echo "Erreur : " . $e->getMessage();
        }
    }