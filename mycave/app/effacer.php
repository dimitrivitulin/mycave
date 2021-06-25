<?php

if (isset($_GET['effacer'])) {
    require_once '../config.php';
    $id = $_GET['effacer'];
    $stmt = $pdo->prepare("DELETE FROM mes_vins WHERE id=$id");

    $stmt->bindValue(':id', $id, PDO::PARAM_INT);

    $res = $stmt->execute();

    if ($res) {
        header("Location: ../welcome.php?message=succes");
    } else {
        header("Location: ../welcome.php");
    }
    $pdo = null;
    exit();
} else {

    header("Location: ../welcome.php?message=erreur");
}
