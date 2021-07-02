<?php
// Include config php
require_once "config.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Modifier un Vin</title>
    <link rel="stylesheet" href="./assets/css/style.css">

</head>

<body>
    <main class="box-vin ">
    
                            <?php 
                            if (isset($_GET['id']) && !isset($_GET['message'])){
                                $id = $_GET['id'];
                                $mes_vins = $pdo->query("SELECT * FROM mes_vins where id=$id");
                               
                                
                             
                                while ($mon_vin = $mes_vins->fetch(PDO::FETCH_ASSOC)) { 
                                    
                                    $id = $mon_vin['id'];
                                    $imageVin = $mon_vin['image_vin'];
                                    if(isset($imageVin) && $imageVin == ""){
                                        $imageVin = "vin_defaut.png";
                                        
                                        
                                    }else{
                                        $imageVin = $mon_vin['image_vin'];
                                        
                                    }
                                    ?>
                                       
                                        <div class="ligne-bordeaux"></div>
                                        <h1>Carte d'identité du vin</h1>
                                        <p>Modifier votre vin</p>
                                        <form action="./app/mettre-a-jour.php?id=<?php echo $id;?>" method="POST" autocomplete="off" enctype="multipart/form-data" class="form-modif">
                                            <input type="hidden" name="<?php echo $id;?>">                            
                                            <input type="text" name="titre" value="<?php echo $mon_vin['titre'];?>" class="input-titre">
                                            <p>Cépage: </p><input type="text" name="cepage" value="<?php echo $mon_vin['cepage'];?>" class="input-titre">
                                            <p>Pays:</p><input type="text" name="pays" value=" <?php echo $mon_vin['pays'];?>" class="input-titre">
                                            <p>Région:</p><input type="text" name="region" value="  <?php echo $mon_vin['region'];?>" class="input-titre">
                                            <div class="form-millesime">
                                                <label for="millesime">Millesime</label>    
                                                <input type="text" name="millesime" value="<?php echo $mon_vin['millesime'];?>">
                                            </div>
                                            <div class="form-stock">
                                                <label for="stock">Stock</label>
                                                <input type="number" name="stock" value="<?php echo $mon_vin['stock'];?>">
                                            </div>
                                            <div class="modif-image-form">
                                                <div class="img-image-form">
                                                    <img src="assets/img/img-telecharge/<?php echo trim($imageVin)?>" width= "100%" height="300px"
                                                                                alt="">                
                                                </div>
                                                <div class="infos-modif-img">

                                                    <label for="image_vin" >Modifier image</label>
                                                    <input type="file" name="image_vin" class=" ajout-image-input" id="image_vin" class="modif-image-input">
                                                </div>
                                            </div>
                                            
                                            <div class="ligne-bordeaux center-self monte-stp"></div>
                                            <h2 class="center-self">Caractéristiques</h2>
                                            <textarea name="description_vin" class="center-self form-description" ><?php echo $mon_vin['description_vin'];?></textarea>
                                            <div class="ligne-bordeaux center-self"></div>
                                            <input type="submit" name="submit" value="Modifier" class="center-self">
                                        </form> 
                                                                    
                                       
                            <?php } ?>
                     

                   <?php  
                          }else{ 
                            if (isset($_GET['message']) && $_GET['message'] == 'erreur') {
                                echo "<p style='color:red'>Il semble qu'il ait un problème réssayer</p>";
                            }elseif(isset($_GET['message']) && $_GET['message'] == 'succes'){
                                echo"<p style='color:green'>Bouteille bien ajoutée</p>";
                                
                            }elseif(isset($_GET['id'])){
                                echo "<p style='color:orange'>Modifier votre bouteille</p>";
                                
                            }else{
                                echo "<p style='color:red'>Il semble qu'il ait un problème réssayer</p>";
                                
                            }   
                        }
                        ?>
                       
                                               
            <a href="welcome.php" class="revenir-btn">Revenir aux bouteilles</a>

  

    </main>
    <footer>
        <img src="./assets/img/logo.jpg" alt="logo mycave">
    </footer>
    <script src="./assets/js/script.js"></script>
</body>

</html>