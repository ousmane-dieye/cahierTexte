<?php
require_once "../db.php";

if (!isset($_GET['id'])) {
    header("Location: classes.php");
    exit;
}

$id = $_GET['id'];


$sql = "DELETE FROM etudiant WHERE classe_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);


$sql = "DELETE FROM classe WHERE id_classe = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

header("location: admin.php#classes");
exit;