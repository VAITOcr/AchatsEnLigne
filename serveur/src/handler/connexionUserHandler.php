<?php
define('SECURE_ACCESS', true); // Définit une constante pour vérifier l'accès sécurisé

require_once(__DIR__.'/../connexion/controleurConnexion.php');
require_once(__DIR__.'/../config_paths.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $courriel = $_POST['courrielco'] ?? '';
    $mdp = $_POST['mdpco'] ?? '';

    $controleur = new ControleurConnexion( $serveurUrl);
    $controleur->verifierConnexionEtSession($courriel, $mdp);
} else {
    header('Location: ../../../index.php?msg=' . urlencode("Méthode non autorisée"));
    exit();
}

?>