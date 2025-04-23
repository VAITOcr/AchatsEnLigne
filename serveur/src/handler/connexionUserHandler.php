<?php

require_once(__DIR__.'/../connexion/controleurConnexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $courriel = $_POST['courrielco'] ?? '';
    $mdp = $_POST['mdpco'] ?? '';

    $controleur = new ControleurConnexion();
    $controleur->verifierConnexionEtSession($courriel, $mdp);
} else {
    header('Location: ../../../index.php?msg=' . urlencode("Méthode non autorisée"));
    exit();
}

?>