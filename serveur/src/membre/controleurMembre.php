<?php 
require_once(__DIR__.'/../includes/bd/connexion.inc.php');


    $nom = isset($_POST['nom']) ? $_POST['nom'] :'invalide';
    $prenom = isset($_POST['prenom']) ? $_POST['prenom'] :'invalide';
    $sexe = $_POST['sexe'];
    $daten= $_POST['daten'];
    $courriel = $_POST['courriel'];
    $pass =  $_POST['mdpc'];
    $role = 'M';
    $statut = 'A';
    $photo = NULL;

    if(isset($_FILES['photo']) && $_FILES["photo"]["error"] == 0){
        $dossier=__DIR__ ."/../../photos/";
        if (isset($nom)) {
        $extension = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION); // Récupère l'extension du fichier
        $nomFichier = $nom . "." . $extension; // Format : Nom_123.jpg
        $dossierFichier = $dossier . $nomFichier;

        if (move_uploaded_file($_FILES['photo']['tmp_name'], $dossierFichier)){
            $photo = $nomFichier;
            
        }
        }
    }

    try {
        $verifierUser='SELECT * FROM connexion WHERE courriel = ?';
        $stmtVerifier = $connexion->prepare($verifierUser);
        $stmtVerifier->bind_param('s', $courriel);
        $stmtVerifier->execute();
        $resultatVerification = $stmtVerifier->get_result();
        if($resultatVerification->num_rows > 0){
            $msg='Ce courriel existe deja';
        }else {
        $requeteMembre = "INSERT INTO membres(idm,nom,prenom,sexe,daten,photo) VALUES(0,?,?,?,?,?)";
        $stmt = $connexion->prepare($requeteMembre);
        $stmt->bind_param("sssss", $nom,$prenom,$sexe,$daten,$photo);
        if ($stmt->execute()){
            $idm = $stmt->insert_id;
            $requeteConnexion = "INSERT INTO connexion(idm,courriel,pass,role,statut) VALUES(?,?,?,?,?)";
            $stmt = $connexion->prepare($requeteConnexion);
            $stmt->bind_param("issss", $idm,$courriel,$pass,$role,$statut);
            if ($stmt->execute()) {
                $msg= "Membre bien enregistré";
                
            } else {
                $msg = "Connexion impossible";
            }
        }
        else {
            $msg = "Impossible d'inserer le membre!";
        }
    } 
    } catch (Exception $e) {
        $msg = "Erreur: " . $e->getMessage();
    } finally {
        $connexion->close();
        header('Location: ../../../index.html?msg='.urlencode($msg));
    } 
?>