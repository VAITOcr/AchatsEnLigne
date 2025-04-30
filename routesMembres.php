<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);


require_once('serveur/src/modeles/membres/ControleurMembre.php');
header('Content-Type: application/json');

$instanceControleurMembres = ControleurMembre::getInstance();

//routes
$action= $_POST['action'] ?? $_GET['action'] ?? $_REQUEST['action'] ?? null;


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
                $nom = $_REQUEST['nom'] ?? null;
                $prenom = $_REQUEST['prenom'] ?? null;
                $sexe = $_REQUEST['sexe'] ?? null;
                $daten = $_REQUEST['daten'] ?? null;
                $photo = $_FILES['photo'] ?? null;
                $courriel = $_REQUEST['courriel'] ?? null;
                $pass = $_REQUEST['pass'] ?? null;
                $role = $_REQUEST['role'] ?? null;
                $statut = $_REQUEST['statut'] ?? null;

            if ( $nom && $prenom && $sexe && $daten && $courriel && $role && $statut) {
    $instanceControleurMembres->ajouterMembre( $nom, $prenom, $sexe, $daten, $photo, $courriel, $pass, $role, $statut);
} else {
    echo json_encode([
    "etat" => false,
    "message" => "Données manquantes pour l'ajout d’un membre.",
    "debug" => [
        "nom" => $nom,
        "prenom" => $prenom,
        "sexe" => $sexe,
        "daten" => $daten,
        "courriel" => $courriel,
        "role" => $role,
        "statut" => $statut
    ]
]);
}
            break;
        case 'updateMembre':
            $idm = $_REQUEST['idm'] ?? null;
    $nom = $_REQUEST['nom'] ?? null;
    $prenom = $_REQUEST['prenom'] ?? null;
    $sexe = $_REQUEST['sexe'] ?? null;
    $daten = $_REQUEST['daten'] ?? null;
    $courriel = $_REQUEST['courriel'] ?? null;
    $role = $_REQUEST['role'] ?? null;
    $statut = $_REQUEST['statut'] ?? null;
    $pass = $_REQUEST['pass'] ?? null;
    $photo = $_FILES['photo'] ?? null;

    if ($idm && $nom && $prenom && $sexe && $daten && $courriel && $role && $statut) {
        $instanceControleurMembres->modifierMembre($idm, $nom, $prenom, $sexe, $daten, $photo, $courriel, $pass, $role, $statut);
    } else {
        echo json_encode([
            "etat" => false,
            "message" => "Données manquantes pour modifier un membre.",
            "debug" => [
                "idm" => $idm,
                "nom" => $nom,
                "prenom" => $prenom,
                "sexe" => $sexe,
                "daten" => $daten,
                "courriel" => $courriel,
                "role" => $role,
                "statut" => $statut
            ]
        ]);
    }
    break;
        case 'deleteMembre':
            $idm = $_GET['idm'] ?? $_POST['idm'] ?? $_REQUEST['idm'] ?? null;
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