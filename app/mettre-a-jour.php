<?php

if (isset($_GET['id'])){
    //connexion à la base de donnée
    require_once dirname(__DIR__). '/config.php';

    //récupération du $_GET et du $_POST
    $id = htmlspecialchars(trim($_GET['id']));
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
            $resultat = TRUE;

    }
    else {
        $resultat = FALSE;
    }

    
    $sql_image = $resultat ? ', image_vin = :image_vin' : '';
    
  
     // Prépare une déclaration de mise à jour

     $stmt = $pdo->prepare("UPDATE mes_vins SET titre = :titre, cepage = :cepage, pays = :pays, region = :region, millesime = :millesime, stock = :stock, description_vin = :description_vin$sql_image  WHERE id = $id");

         // Lie des variables à l'instruction préparée en tant que paramètres
         $stmt->bindValue(":titre", $titre, PDO::PARAM_STR);
         $stmt->bindValue(":cepage", $cepage, PDO::PARAM_STR);
         $stmt->bindValue(":pays", $pays, PDO::PARAM_STR);
         $stmt->bindValue(":region", $region, PDO::PARAM_STR);
         $stmt->bindValue(":millesime", $millesime, PDO::PARAM_INT);
         $stmt->bindValue(":stock", $stock, PDO::PARAM_INT);
         $stmt->bindValue(":description_vin", $description_vin, PDO::PARAM_STR);
         if(!empty($sql_image)) {
            $stmt->bindValue(":image_vin", $imageUnique, PDO::PARAM_STR);
        }

         $res = $stmt->execute();

         // Tente d'exécuter l'instruction préparée
         if ($res) {
             header("Location: ../formulaire-modif.php?id=$id&message=succes");
         } else {
             echo "Location: ../formulaire-modif.php?id=$id&message=erreur";
         }


 $pdo = null;
 exit();
 
}else{
    header("Location: ../formulaire-modif.php?message=erreur");
}