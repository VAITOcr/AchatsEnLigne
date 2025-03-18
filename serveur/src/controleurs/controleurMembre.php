<?php 
require_once(__DIR__.'/../includes/bd/connexion.inc.php');


    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $sexe = $_POST['sexe'];
    $daten= $_POST['daten'];
    $courriel = $_POST['courriel'];
    $pass =  $_POST['mdpc'];
    $role = 'M';
    $statu = 'A';
    $photo = NULL;

    if(isset($_FILES['photo']) && $_FILES["photo"]["error"] == 0){
        $dossier=__DIR__ ."/../photos/";
        $nomFichier =uniqid() . "-" . basename($_FILES['photo']['name']);
        $dossierFichier = $dossier.$nomFichier;
        if(move_uploaded_file($_FILES['photo']['tmp_name'], $dossierFichier)){
            $photo = $nomFichier;
        }
        }

        $verifierUser='SELECT * FROM membres WHERE courriel = ?';
        $stmtVerifier = $connexion->prepare($verifierUser);
        $stmtVerifier->bind_param('s', $courriel);
        $stmtVerifier->execute();
        $resultatVerification = $stmtVerifier->get_result();
        if($resultatVerification->num_rows > 0){
            $msg = "Ce courriel existe deja";
            exit();
        }

        $requeteMembre = "INSERT INTO membres(nom,prenom,sexe,daten,photo) VALUES(?,?,?,?,?)";
        $stmt = $connexion->prepare($requeteMembre);
        $stmt->bind_param("sssss", $nom,$prenom,$sexe,$daten,$photo);
        if ($stmt->execute()){
            $idm = $stmt->insert_id;
            $requeteConnexion = "INSERT INTO connexion(idm,courriel,pass,role,statut) VALUES(?,?,?,?,?)";
            $stmt = $connexion->prepare($requeteConnexion);
            $stmt->bind_param("issss", $idm,$courriel,$pass,$role,$statu);
            if ($stmt->execute()) {
                header('Location: ../membre/membre.html');
                exit();
            } else {
                $msg = "Connexion impossible";
            }
        }
        else {
            $msg = "Membre impossible";
        }

?>