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
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Bienvenue</title>
    
    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>
    <main class= "accueil">

        <div class="reinitialisation">
            <p>Compte Utilisateur</p>
            <a href="reset-password.php"class="rmdp" >Réinitialisation mdp</a>
            <a href="logout.php" class="rlogout">Déconnexion</a>
       
        </div>
        <div class="bienvenue">
            <h1>Bienvenue</h1>
            <h2> <?php echo htmlspecialchars($_SESSION["username"]); ?></h2>
            <p>My cave est une application dédiée aux passionnés de vin  afin de répertorier les vins qu'ils ont en leur possesion dans leur cave personnelle. </p>
        </div>
        <div class="btn-ajouter">
            <a href="ajouter/formulaire-ajout.php">Ajouter un Vin</a>
        </div>
        <div class="ligne-bordeaux"></div>
        <div class="to-do-vin-section">
            
            <?php
            $mes_vins = $pdo->query("SELECT * FROM mes_vins ORDER BY id DESC");
            if (isset($_GET['message']) && $_GET['message'] == 'erreur') {
                echo "<p style='color:red'>Il semble qu'il ait un problème réssayer</p>";
            }
            ?>
            <div class="les-vins">
            <h1>MA CAVE</h1>
                
                <?php while ($mon_vin = $mes_vins->fetch(PDO::FETCH_ASSOC)) { 
                    $imageVin = $mon_vin['image_vin'];
                    if(isset($imageVin) && $imageVin == ""){
                        $imageVin = "vin_defaut.png";    
                    }else{
                        $imageVin = $mon_vin['image_vin'];   
                    } 
                    ?>
                      <div class="le-vin">
                          
                          <div class="popup" id="popup">
                              <div class="fenetre-popup">
                                  <a href="#" class="cross">&times;</a>
                                  <p>Êtes-vous sûre de vouloir effacer cette bouteille?</p>
                                  <a href="app/effacer.php?effacer=<?php echo $mon_vin['id']; ?>" class="effacer">Effacer</a>
                              </div>
                          </div>
                          <a  href="#popup" class="effacer-vin">&times;</a>
                            <div class="img-vin">
                                <div class="bulle-img">
                                    <img src="./assets/img/img-telecharge/<?php echo $imageVin?>" width="100%">
                                </div>    
                            </div>
                            <div class="description-vin">
                                <h3><?php echo $mon_vin['titre']; ?></h3>

                                <h4>Millésime <?php echo $mon_vin['millesime']; ?></h4>

                                <p>Stock: <?php echo $mon_vin['stock']; ?></p>
                                <a href="afficher.php?id=<?php echo $mon_vin['id'];?>" class="lien-vin">Afficher plus</a>

                                <?php $date = $mon_vin['date']; ?>
                                <small>Ajouté le:<?php echo date('d/m/Y', strtotime($date)); ?> </small>

                            </div>
                      </div>
                   
                    
                <?php } ?>
                
        </div>
        
       
        
            
                    
       
    </main>
    <script src="./assets/js/script.js"></script>
</body>

</html>