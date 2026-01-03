<?php 


    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        session_start();
        if(!isset($_SESSION['id_etudiant'])){
        header('../inscription/index.php');
    }   
        require_once "../db.php";
        $id  = $_POST['id_classe'] ?? null;
        $root_id = $_SESSION['id_etudiant'];
        $nom_classe = $_POST['nom_classe'];
        $niveau = $_POST['niveau'];
        if ($id) {
            // MODIFIER
            $sql = "UPDATE classe 
                    SET nom_classe = ?, niveau = ?
                    WHERE id_classe = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$nom_classe, $niveau, $id]);
            header("location: admin.php#classes");
        } else {
        if(!$nom_classe){
            exit("Champs nom classe requis");
        }else if(!$niveau){
            exit("Champs niveau requis");
        }else if(!$root_id){
            header('location: ../connexion/connexion.php');
        }

        $sql = "SELECT * from classe where nom_classe = ?";
        $stmt = $pdo->prepare($sql);

        $stmt->execute([$nom_classe]);

        $stmt->fetch(PDO::FETCH_ASSOC);

        if ($stmt -> rowCount() > 0){
            echo ("nom deja utilise");
            exit;     
        }

        $sql = "INSERT into classe(nom_classe, niveau, root_id) values (?,?,?)";
        $stmt = $pdo ->  prepare($sql);

        $stmt->execute([$nom_classe, $niveau,$root_id]);
        header("location: admin.php#classes");
    
    }
}