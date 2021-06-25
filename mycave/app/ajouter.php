<?php

if (isset($_POST['titre'])) {
    require_once '../config.php';

    $titre = $_POST['titre'];
    $millesime = (trim($_POST["millesime"]));
    $stock = intval(trim($_POST['stock']));
    $image_vin = (trim($_POST['image_vin']));

    //récupération du $_FILES
    $file = $_FILES['image_vin'];
    $tmpName = $file['tmp_name'];
    $name = $file['name'];
    $size = $file['size'];
    $error = $file['error'];
    $type = $file['type'];
    
    // découpage du fichier image afin de selectionner les fichiers selon l'extension
    $decoupageImage = explode('.', $name);
    $extensionImage = strtolower(end($decoupageImage));
    $extensionAutorisees = ['jpg', 'jpeg', 'gif', 'png'];
    $tailleMax = 500000;//limite à 0.5mo
    
    //verification des extensions, de la taille et s'il n'y a pas d'erreur puis transformation en fichier unique et enregistrement
    if(in_array($extensionImage, $extensionAutorisees) && $size <= $tailleMax && $error == 0){

        $imageUnique = uniqid('', true);
        $imageEnregistree = $imageUnique.'.'.$extensionImage;
        var_dump($imageEnregistree);
        move_uploaded_file($tmpName, '../assets/img/img-telecharge/'.$imageEnregistree);
    }else{
        header("Location: ../ajouter/formulaire-ajout.php?message=erreur");
    }



    if (empty($titre) && empty($millesime) && empty($stock) && empty($image_vin)){
        header("Location: ../ajouter/formulaire-ajout.php?message=erreur");
    } else {
        $stmt = $pdo->prepare("INSERT INTO mes_vins (titre, millesime, stock, image_vin ) VALUES (:titre, :millesime, :stock, :image_vin)");
        $stmt->bindValue(':titre', $titre, PDO::PARAM_STR);
        $stmt->bindValue(':millesime', $millesime, PDO::PARAM_INT);
        $stmt->bindValue(':stock', $stock, PDO::PARAM_INT);
        $stmt->bindValue(':image_vin', $image_vin, PDO::PARAM_STR);

        $res = $stmt->execute();


        $mes_vins = $pdo->query("SELECT * FROM mes_vins ORDER BY id");
        while ($mon_vin = $mes_vins->fetch(PDO::FETCH_ASSOC)) { 
           $id = $mon_vin['id'];
                if ($res) {
                
                    header("Location: ../afficher.php?id=$id&message=succes");
                } else {
                    header("Location: ../ajouter/formulaire-ajout.php?message=erreur");
                }
            }
        $pdo = null;
        exit();
    }
} else {

    header("Location: ../ajouter/formulaire-ajout.php?titre=$titre&message=erreur");
}
