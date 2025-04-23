<?php
session_start();
require_once(__DIR__ . '/../membre/ControleurMembre.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controleur = new ControleurMembre();
    $message = $controleur->enregistrerMembre($_POST, $_FILES);

    header('Location: ../../../index.php?msg=' . urlencode($message));
    exit();
} else {
    header('Location: ../../../index.php?msg=' . urlencode("Méthode non autorisée."));
    exit();
}
?>