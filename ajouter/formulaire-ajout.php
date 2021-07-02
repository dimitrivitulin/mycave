<?php
// Include config php
require_once "../config.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Ajouter un Vin</title>

    <link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>
    

        <main class="box-vin">
            <div class="ligne-bordeaux"></div>
            <h1>Carte d'identité du vin</h1>
            <p>Entrez les caractéristiques de votre vin</p>
            <form action="../app/ajouter.php" method="POST" enctype="multipart/form-data" autocomplete="off" class="form-box-vin">

                <input type="text" name="titre" placeholder="Nom de château, domaine, vin..." class="input-titre">
                <input type="text" name="cepage" placeholder="Cépage(s)..." class="input-titre">
                <input type="text" name="pays" placeholder="Pays..." class="input-titre">
                <input type="text" name="region" placeholder="Région..." class="input-titre">
                <div class="form-millesime">
                    <label for="millesime">Millesime</label>    
                    <input type="text" name="millesime" id="millesime" placeholder="XXXX">
                </div>
                <div class="form-stock">
                    <label for="stock">Stock</label>
                    <input type="number" name="stock" id="stock" placeholder="0">
                </div>
                <div class="ajout-image center-self">
                    <p>Importer une image (facultatif)</p>
                    <label for="image_vin" name="image_vin" >Importer</label>
                    <input type="file" name="image_vin" class=" ajout-image-input" id="image_vin">
                </div>
                
                <div class="ligne-bordeaux center-self"></div>
                <h2>Caractéristiques</h2>
                <textarea name="description_vin" class="center-self form-description" placeholder="Description du vin..."></textarea>
                <div class="ligne-bordeaux center-self"></div>
                <input type="submit" value="Ajouter" class="center-self" > 
            </form>

                                
                        <?php
                        if (isset($_GET['message']) && $_GET['message'] == 'erreur') {
                            echo "<p style='color:red'>Il semble qu'il ait un problème réssayer</p>";
                        }elseif(isset($_GET['message']) && $_GET['message'] == 'succes'){
                            echo"<p style='color:green'>Bouteille bien ajoutée</p>";
                        }else{
                            echo "";
                            
                        }   
                        
                   ?>
                        <a href="../welcome.php" class="revenir-btn">Revenir aux bouteilles</a>
       

       
        </main>
        <footer>
            <a href="../welcome.php"><img src="../assets/img/logo.jpg" alt="logo mycave"></a>
        </footer>                
            
    <script src="./assets/js/script.js"></script>
</body>

</html>