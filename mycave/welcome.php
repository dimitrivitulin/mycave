<?php
// Initialise une session
session_start();
require_once "config.php";

// Vérifie si l'utilisateur est connecté, sinon redirige-le vers la page login
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Bienvenue</title>
    
    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>
    <main class= "accueil">

        <div class="reinitialisation">
            <p>
                <a href="reset-password.php" >Réinitialisez votre mot de passe</a>
                <a href="logout.php" ">Déconnectez-vous de votre compte</a>
            </p>
        </div>
        <div class="bienvenue">
            <h1>Bienvenue</h1>
            <h2> <?php echo htmlspecialchars($_SESSION["username"]); ?></h2>
            <p>My cave est une application dédiée aux passionnés de vin de répertorier les vins qu'ils ont en leur possesion dans leur cave personnelle. </p>
        </div>
        <div class="btn-ajouter">
            <a href="ajouter/formulaire-ajout.php">Ajouter un Vin</a>
        </div>
        <div class="ligne-bordeaux"></div>
        <div class="to-do-vin-section">
            
            <?php
            $mes_vins = $pdo->query("SELECT * FROM mes_vins ORDER BY id DESC");

            ?>
            <div class="les-vins">


                <?php while ($mon_vin = $mes_vins->fetch(PDO::FETCH_ASSOC)) { 
                    $imageVin = $mon_vin['image_vin'];
                    if(isset($imageVin) && $imageVin == ""){
                        $imageVin = "vin_defaut.jpg";
                        
                        
                    }else{
                        $imageVin = $mon_vin['image_vin'];
                        
                    }
                    
                    ?>
                    
                      <div class="le-vin">
                        <a href="afficher.php?id=<?php echo $mon_vin['id'];?>" class="lien-vin">
                            <div class="img-vin">
                                <div class="bulle-img">
                                    <img src="./assets/img/img-telecharge/<?php echo $imageVin?>" width="100%">
                                </div>    
                            </div>
                            <div class="description-vin">

                                <!-- <a href="app/effacer.php?effacer=<?php echo $mon_vin['id']; ?>" class="effacer-vin">x</a> -->

        
                                <h3><?php echo $mon_vin['titre']; ?></h3>

                                <h4>Millésime <?php echo $mon_vin['millesime']; ?></h4>

                                <p>Stock: <?php echo $mon_vin['stock']; ?></p>

                                <?php $date = $mon_vin['date']; ?>
                                <small>Ajouté le:<?php echo date('d/m/Y', strtotime($date)); ?> </small>

                            </div>
                        </a> 
                      </div>
                   
                    
                <?php } ?>
                
        </div>
        
       
        
            
                    
       
    </main>
    <script src="./assets/js/script.js"></script>
</body>

</html>