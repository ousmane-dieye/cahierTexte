<?php 


    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        session_start();
        if(!isset($_SESSION['id_etudiant'])){
        header('../inscription/index.php');
    }   
        require_once "../db.php";
        echo("okkkkkkkkkkk");
        echo($_POST['nom_classe']);
        $root_id = $_SESSION['id_etudiant'];
        $nom_classe = $_POST['nom_classe'];
        $niveau = $_POST['niveau'];

        if(!$nom_classe){
            exit("Champs nom classe requis");
        }else if(!$niveau){
            exit("Champs niveau requis");
        }else if(!$root_id){
            header('location: ../connexion/connexion.php');
        }

        $sql = "select * from classe where nom_classe = ?";
        $stmt = $pdo->prepare($sql);

        $stmt->execute([$nom_classe]);

        $stmt->fetch(PDO::FETCH_ASSOC);

        if ($stmt -> rowCount() > 0){
            echo ("nom deja utilise");
            exit;     
        }

        $sql = "insert into classe(nom_classe, niveau) values (?,?)";
        $stmt = $pdo ->  prepare($sql);

        $stmt->execute([$nom_classe, $niveau]);
    
    }