<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);


require_once('serveur/src/modeles/membres/ControleurMembre.php');
header('Content-Type: application/json');

$instanceControleurMembres = ControleurMembre::getInstance();

//routes
$action= $_POST['action'] ?? $_GET['action'] ?? null;

if ($action) {
    switch ($action) {
        case 'getAllMembres':
            $instanceControleurMembres->afficherMembres();
            break;
        case 'getMembreById':
            $idm = $_POST['idm'] ?? $_GET['idm'] ?? null;
            if ($idm) {
                $instanceControleurMembres->afficherMembre($idm);
            } else {
                echo json_encode(["error" => "ID manquant."]);
            }
            break;
        case 'addMembre':
            $idm = $_POST['idm'] ?? null;
            $nom = $_POST['nom'] ?? null;
            $prenom = $_POST['prenom'] ?? null;
            $sexe = $_POST['sexe'] ?? null;
            $daten = $_POST['daten'] ?? null;
            $photo = $_FILES['photo'] ?? null;
            $courriel = $_POST['courriel'] ?? null;
            $pass = $_POST['pass'] ?? null;
            $role = $_POST['role'] ?? null;
            $statut = $_POST['statut'] ?? null;

            if ($idm && $nom && $prenom && $sexe && $daten && $photo && $courriel && $pass && $role && $statut) {
                $instanceControleurMembres->ajouterMembre($idm, $nom, $prenom, $sexe, $daten, $photo, $courriel, $pass, $role, $statut);
            } else {
                echo json_encode(["error" => "Données manquantes pour ajouter un membre."]);
            }
            break;
        case 'updateMembre':
            $idm = $_POST['idm'] ?? null;
            $nom = $_POST['nom'] ?? null;
            $prenom = $_POST['prenom'] ?? null;
            $sexe = $_POST['sexe'] ?? null;
            $daten = $_POST['daten'] ?? null;
            $photo = $_FILES['photo'] ?? null;
            $courriel = $_POST['courriel'] ?? null;
            $pass = $_POST['pass'] ?? null;
            $role = $_POST['role'] ?? null;
            $statut = $_POST['statut'] ?? null;

            if ($idm && $nom && $prenom && $sexe && $daten && $photo && $courriel && $pass && $role && $statut) {
                $instanceControleurMembres->modifierMembre($idm, $nom, $prenom, $sexe, $daten, $photo, $courriel, $pass, $role, $statut);
            } else {
                echo json_encode(["error" => "Données manquantes pour modifier un membre."]);
            }
            break;
        case 'deleteMembre':
            $idm = $_POST['idm'] ?? null;
            if ($idm) {
                $instanceControleurMembres->supprimerMembre($idm);
            } else {
                echo json_encode(["error" => "ID manquant."]);
            }
            break;
    }
} else {
    echo json_encode(["error" => "Action manquante."]);
}




?>