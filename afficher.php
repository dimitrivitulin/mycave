<head>
    <meta charset="UTF-8">
    <title>Afficher votre vin</title>
    <link rel="stylesheet" href="./assets/css/style.css">

</head>

<body>
    <main class="box-vin">

                            <?php 
                            
                            if (isset($_GET['id'])){
                                require_once "config.php";
                                $id = $_GET['id'];
                                $mes_vins = $pdo->query("SELECT * FROM mes_vins where id=$id");
                                
                                
                                    while ($mon_vin = $mes_vins->fetch(PDO::FETCH_ASSOC)) { 

                                        $id = $mon_vin['id'];
                                        $imageVin = $mon_vin['image_vin'];
                                        if($imageVin == NULL){
    
                                                $imageVin = "vin_defaut.png";
                                            
                                            
                                        }else{
                                            $imageVin = $mon_vin['image_vin'];
                                        }
                                        ?>
                                        <div class="afficher-vin">
                                            <div class="afficher1">
                                                <div class="afficher-img">
                                                    <img src="assets/img/img-telecharge/<?php echo trim($imageVin)?>" width= "100%" height="300px"
                                                alt="">
                                                </div>
                                                <div class="afficher-titres">
                                                    <h1><?php echo $mon_vin['titre'];?></h1>
                                                    <p><span>Millesime</span> <?php echo $mon_vin['millesime'];?></p>
                                                    <p><span>Cépage:</span> <?php echo $mon_vin['cepage'];?></p>
                                                    <p><span>Pays:</span> <?php echo $mon_vin['pays'];?></p>
                                                    <p><span>Région:</span>  <?php echo $mon_vin['region'];?></p>
                                                    <div class="afficher-stock">
                                                        <p><?php echo $mon_vin['stock'];?></p>
                                                    </div>
                                                   
                                                </div>
                                            </div>
                                            <div class="afficher2">
                                                <div class="afficher-description">
                                                <p><?php echo $mon_vin['description_vin'];?></</p>
                                                </div>
                                                <div class="afficher-btn">
                                                    <a href="./formulaire-modif.php?id=<?php echo $id;?>">Modifier</a>
                                                </div>

                                                <?php if(isset($_GET['message'])&& ($_GET['message'] == "succes")){
                                                echo "<p style= 'color:red;'>Bouteille bien ajoutée</p>";
                                            } ?>

                                            </div>

                                            <?php }
                                            
                                      
                                        }else{
                                            echo "<p>Il semble qu'il y ait une erreur de chargement recommencer</p>";
                                            
                                        } ?>
                           
                                    <a href="welcome.php"  class="revenir-btn">Revenir aux bouteilles</a>
                                        </div>



  

    </main>
    <footer>
        <a href="./welcome.php"><img src="./assets/img/logo.jpg" alt="logo mycave"></a>
    </footer>
    <script src="./assets/js/script.js"></script>
</body>

</html>