<?php
/* Identifiants base de données */
define('DB_SERVER', '185.98.131.128');
define('DB_USERNAME', 'astim1437256_12fmkz');
define('DB_PASSWORD', 'lu9ph6tox9');
define('DB_NAME', 'astim1437256_12fmkz');

/* Connexion mysql sinon erreur */
try {
    $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
    // defini le mode d'erreur PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("problème de connexion. " . $e->getMessage());

}
