<?php

if (isset($_GET['id']) && isset($_FILES)){
    //connexion à la base de donnée
    require_once '../config.php';

    //récupération du $_GET et du $_POST
    $id = $_GET['id'];
    $titre = $_POST['titre'];
    $millesime = (trim($_POST["millesime"]));
    $stock = intval(trim($_POST['stock']));

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
        header("Location: ../formulaire-modif.php?message=erreur");
    }
    
    
    
  
     // Prépare une déclaration de mise à jour
     $sql = "UPDATE mes_vins SET titre = :titre, millesime = :millesime, stock = :stock, image_vin = :image_vin  WHERE id = $id";

     if ($stmt = $pdo->prepare($sql)) {
         // Lie des variables à l'instruction préparée en tant que paramètres
         $stmt->bindParam(":titre", $titre, PDO::PARAM_STR);
         $stmt->bindParam(":millesime", $millesime, PDO::PARAM_INT);
         $stmt->bindParam(":stock", $stock, PDO::PARAM_INT);
         $stmt->bindParam(":image_vin", $imageEnregistree, PDO::PARAM_STR);



         // Tente d'exécuter l'instruction préparée
         if ($stmt->execute()) {
             // Mot de passe mis à jour avec succès. Détruire la session et redirige vers la page de connexion

             header("Location: ../formulaire-modif.php?id=$id&message=succes");
             exit();
         } else {
             echo "Quelque chose semble ne pas fonctionner veuillez ressayer.";
         }

         // Ferme la déclaration
         unset($stmt);
     }


 // Ferme la connection
 unset($pdo);
}else{
    header("Location: ../formulaire-modif.php?message=erreur");
}