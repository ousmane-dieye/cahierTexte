<?php

    $host = "localhost";
    $dbname = "cahier_texte";
    $user = "root";
    $password = "";

    try {
        $pdo = new PDO(
            "mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass
        );
    }catch(PDOException $e){

    }