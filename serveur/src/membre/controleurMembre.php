<?php 
require_once(__DIR__.'/../connexion/connexion.php');
require_once(__DIR__.'/../includes/env/env_vars.inc.php');


    $nom = isset($_POST['nom']) ? $_POST['nom'] :'invalide';
    $prenom = isset($_POST['prenom']) ? $_POST['prenom'] :'invalide';
    $sexe = $_POST['sexe'];
    $daten= $_POST['daten'];
    $courriel = $_POST['courriel'];
    $pass =  $_POST['mdpc'];
    $role = 'M';
    $statut = 'A';
    $photo = NULL;
    $msg = '';


    try {
        $verifierUser = 'SELECT * FROM membres WHERE courriel = ?';
        $stmtVerifierUser = $connexion->prepare($verifierUser);
        $stmtVerifierUser->execute([$courriel]);

        if ($stmtVerifierUser->rowCount() > 0) {
            echo json_encode(array("success" => false, "message" => "L'utilisateur existe déjà."));
        }
        else {
             if (isset($_FILES['photo']) && $_FILES["photo"]["error"] == 0) {
            $dossier = __DIR__ . "/../../photos/membresPhotos/";
            $extension = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
            $nomFichier = $nom . "." . $extension;
            $dossierFichier = $dossier . $nomFichier;

            if (move_uploaded_file($_FILES['photo']['tmp_name'], $dossierFichier)) {
                $photo = $nomFichier;
            }
        }
        $requeteMembre = "INSERT INTO membres (nom, prenom, sexe, daten, photo) VALUES (?, ?, ?, ?, ?)";
        $stmtMembre = $connexion->prepare($requeteMembre);
        $stmtMembre->execute([$nom, $prenom, $sexe, $daten , $photo]);

        $idm = $connexion->lastInsertId(); // Récupérer l'ID du dernier membre inséré

        $motDePassePeppered = hash_hmac('sha256', $pass, PEPPER); // Ajouter le pepper au mot de passe
        $motDePasseHash = password_hash($motDePassePeppered, PASSWORD_BCRYPT); // Hachage du mot de passe

        $requeteConnexion = "INSERT INTO connexion (idm, courriel, pass, role, statut) VALUES (?, ?, ?, ?, ?)";
        $stmtConnexion = $connexion->prepare($requeteConnexion);
        $stmtConnexion->execute([$idm, $courriel, $motDePasseHash, $role, $statut]);

        $msg = "L'utilisateur a été enregistré avec succès.";
        
        }
    } catch (PDOException $e) {
        $msg = "Erreur lors de l'enregistrement: " . $e->getMessage();
    } 
    finally {
        $connexion = null; // Fermer la connexion à la base de données
        header('Location: ../../../index.html?msg=' . urlencode($msg));
        exit();
    }
?>