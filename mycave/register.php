<?php
// Include config php
require_once "config.php";

// Défini des variables et initialise avec des valeurs vides
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

// Traitement des données du formulaire lors de la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Valider l'identifiant
    if (empty(trim($_POST["username"]))) {
        $username_err = "Entrez un identifiant s'il vous plaît.";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))) {
        $username_err = "L'identifiant'ne peut contenir que des lettres, des chiffres et des traits de soulignement.";
    } else {
        // Déclaration SQL
        $sql = "SELECT id FROM users WHERE username = :username";

        if ($stmt = $pdo->prepare($sql)) {
            // Lie des variables à l'instruction préparée en tant que paramètres
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);

            // Défini les paramètres
            $param_username = trim($_POST["username"]);

            // Tente d'exécuter l'instruction préparée
            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    $username_err = "Cet identifiant existe déjà";
                } else {
                    $username = trim($_POST["username"]);
                }
            } else {
                echo "Quelque chose semble ne pas fonctionner veuillez réessayer";
            }

            // Ferme la déclaration
            unset($stmt);
        }
    }

    // Valide le mot de passe
    if (empty(trim($_POST["password"]))) {
        $password_err = "Entrez un mot de passe s'il vous plaît";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Votre mot de passe doit avoir au moins 6 caractères";
    } else {
        $password = trim($_POST["password"]);
    }

    // Valide la confirmation de mot de passe
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
        }
    }

    // Vérifier les erreurs de saisie avant l'insertion dans la base de données
    if (empty($username_err) && empty($password_err) && empty($confirm_password_err)) {

        // Prépare une instruction d'insertion
        $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";

        if ($stmt = $pdo->prepare($sql)) {
            // Lie des variables à l'instruction préparée en tant que paramètres
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);

            // Défini les paramètres
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Créé un  password hash

            //Tente d'exécuter l'instruction préparée
            if ($stmt->execute()) {
                // Redirige à la page login
                header("location: login.php");
            } else {
                echo "Quelque chose semble ne pas fonctionner veuillez réessayer";
            }

            // Ferme la déclaration
            unset($stmt);
        }
    }

    // Ferme la connection
    unset($pdo);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="./assets/css/style.css">

</head>

<body>
    <div class="connexion-inscription">
        <div class="logo">
            <img src="./assets/img/logo.jpg" alt="logo mycave">
        </div>
        
        <h2>Inscription</h2>
        <p>Veuillez remplir le formulaire d'inscription</p>

        <form class=formulaire-incription-connexion action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="inscription-connexion-item">
                <input type="text" name="username" placeholder="Identifiant" <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>
            <div class="inscription-connexion-item" >
                <input type="password" name="password" placeholder="Mot de passe" <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="inscription-connexion-item">
                <input type="password" name="confirm_password" placeholder="Confirmer votre mot de passe" <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>          
            <div class="inscription-connexion-btn" >
                <input type="submit"  value="Confirmer">
                <input type="reset" value="Réinitialiser">
            </div>
        </form>
        <p>Ou connectez-vous</p>
        <div class="ligne-blanche"></div>
        
        <h2><a href="login.php">Connexion</a></h2>
    </div>
</body>

</html>