<?php
// Initialise la session
session_start();

// Vérifiez si l'utilisateur est connecté, sinon redirigez-vous vers la page login
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

// Include fichier php config
require_once "config.php";

// Défini les variables et initialise avec une valeur vide
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";

// Traitement des données du formulaire lors de la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Valider le nouveau mdp
    if (empty(trim($_POST["new_password"]))) {
        $new_password_err = "Entrez un nouveau mot de passe s'il vous plaît";
    } elseif (strlen(trim($_POST["new_password"])) < 6) {
        $new_password_err = "le mot de passe doit avoir au moins 6 caractères.";
    } else {
        $new_password = trim($_POST["new_password"]);
    }

    // Valide la confirmation du mdp
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Confirmez le mot de passe s'il vous plait.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($new_password_err) && ($new_password != $confirm_password)) {
            $confirm_password_err = "le mot de passe ne correspond pas.";
        }
    }

    // Vérifier les erreurs de saisie avant de mettre à jour la base de données
    if (empty($new_password_err) && empty($confirm_password_err)) {
        // Prépare une déclaration de mise à jour
        $sql = "UPDATE users SET password = :password WHERE id = :id";

        if ($stmt = $pdo->prepare($sql)) {
            // Lie des variables à l'instruction préparée en tant que paramètres
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
            $stmt->bindParam(":id", $param_id, PDO::PARAM_INT);

            // Défini les paramètres
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];

            // Tente d'exécuter l'instruction préparée
            if ($stmt->execute()) {
                // Mot de passe mis à jour avec succès. Détruire la session et redirige vers la page de connexion
                session_destroy();
                header("location: login.php");
                exit();
            } else {
                echo "Quelque chose semble ne pas fonctionner veuillez ressayer.";
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
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Réinitialiser le mot de passe</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <div class="mdp-box">
        <h2>Réinitialiser le mot de passe</h2>
        <p>Veuillez remplir ce formulaire pour réinitialiser votre mot de passe.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group-password">
                <label>Nouveau mot de passe</label>
                <input type="password" name="new_password" class="form-control <?php echo (!empty($new_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $new_password; ?>">
                <span class="invalid-feedback"><?php echo $new_password_err; ?></span>
            </div>
            <div class="form-group-password">
                <label>Confirmez votre mot de passe</label>
                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group-password">
                <input type="submit" class="btn btn-primary" value="Envoyer">
                <a  href="welcome.php">Annuler</a>
            </div>
        </form>
    </div>
</body>

</html>