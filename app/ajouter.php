<?php

if (isset($_POST['titre'])) {
    require_once '../config.php';

    $titre = htmlspecialchars(trim($_POST['titre']));
    $cepage = htmlspecialchars(trim($_POST['cepage']));
    $pays = htmlspecialchars(trim($_POST['pays']));
    $region = htmlspecialchars(trim($_POST['region']));
    $millesime = htmlspecialchars(trim($_POST["millesime"]));
    $stock = htmlspecialchars(intval(trim($_POST['stock'])));
    $description_vin = htmlspecialchars(trim($_POST['description_vin']));


    //récupération du $_FILES
    $file = $_FILES['image_vin'];
    $tmpName = $file['tmp_name'];
    $name = $file['name'];
    $size = $file['size'];
    $error = $file['error'];
    $type = $file['type'];
    
    // découpage du fichier image afin de selectionner les fichiers selon l'extension
    $extensionImage = strtolower(pathinfo($name, PATHINFO_EXTENSION));              
    $extensionAutorisees = ['jpg', 'jpeg', 'gif', 'png'];
    $tailleMax = 500000;//limite à 0.5mo

    //verification des extensions, de la taille et s'il n'y a pas d'erreur puis transformation en fichier unique et enregistrement
    

    if($error == 0){
            $imageUnique = uniqid() . $name;
            if(in_array($extensionImage, $extensionAutorisees) && $size <= $tailleMax && $error == 0){
                move_uploaded_file($tmpName, '../assets/img/img-telecharge/'.$imageUnique);
            }
            $resultat1 = TRUE;
            $resultat2 = TRUE;

    }
    else {
        $resultat1 = FALSE;
        $resultat2 = FALSE;
    }

    $sql_image1 = $resultat1 ? ', image_vin' : '';
    $sql_image2 = $resultat2 ? ', :image_vin' : '';

    if (empty($titre) && empty($millesime) && empty($stock) && empty($description_vin)){
        header("Location: ../ajouter/formulaire-ajout.php?message=erreur");
    } else {
        $stmt = $pdo->prepare("INSERT INTO mes_vins (titre, cepage, pays, region, millesime, stock, description_vin$sql_image1 ) VALUES (:titre, :cepage, :pays, :region, :millesime, :stock, :description_vin$sql_image2)");
        $stmt->bindValue(':titre', $titre, PDO::PARAM_STR);
        $stmt->bindValue(':cepage', $cepage, PDO::PARAM_STR);
        $stmt->bindValue(':pays', $pays, PDO::PARAM_STR);
        $stmt->bindValue(':region', $region, PDO::PARAM_STR);
        $stmt->bindValue(':millesime', $millesime, PDO::PARAM_INT);
        $stmt->bindValue(':stock', $stock, PDO::PARAM_INT);
        $stmt->bindValue(':description_vin', $description_vin, PDO::PARAM_STR);

         if(!empty($sql_image1) && !empty($sql_image2)) {
            $stmt->bindValue(":image_vin", $imageUnique, PDO::PARAM_STR);
        }

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
