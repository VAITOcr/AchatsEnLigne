<?php

require_once('DAO_membres.php');
require_once(__DIR__.'/../../includes/env/env_vars.inc.php');


class ControleurMembre {

    private $daoMembres;

    public function __construct() {
        $this->daoMembres = new DAO_Membres();
    }

    public static function getInstance() {
        static $instance = null;
        if ($instance === null) {
            $instance = new ControleurMembre();
        }
        return $instance;
    }

    public function afficherMembres() {
        $membres = $this->daoMembres->getAllMembres();
        header('Content-Type: application/json');
        echo json_encode($membres);
    }

    public function afficherMembre($idm) {
        $membre = $this->daoMembres->getMembreById($idm);
        header('Content-Type: application/json');
        echo json_encode($membre);
    }

    public function ajouterMembre( $nom, $prenom, $sexe, $daten, $photo, $courriel, $pass, $role, $statut) {
        $membreExist = $this->daoMembres->getMembreByCourriel($courriel);
        if ($membreExist){
            echo json_encode(["etat" => false, "message" => "Le membre existe deja."]);
            return;
        }

        if (isset($photo) && $photo['error'] === UPLOAD_ERR_OK) {
    $allowedTypes = ['image/jpeg', 'image/png'];
    $mimeType = mime_content_type($photo['tmp_name']);


        if (!in_array($mimeType, $allowedTypes)) {
            echo json_encode(["etat" => false, "message" => "Format d'image invalide. (JPG/PNG requis)"]);
            return;
        }

        $extension = $mimeType === 'image/png' ? 'png' : 'jpg';
        $nomFichierPhoto = preg_replace('/[^a-zA-Z0-9_-]/', '_', strtolower($nom)) . '.' . $extension;
        $destination = __DIR__ . '/../../../photos/membresPhotos/' . $nomFichierPhoto;

        if (!move_uploaded_file($photo['tmp_name'], $destination)) {
            echo json_encode(["etat" => false, "message" => "Echec du telechargement de l'image."]);
            return;
        }

        if (!empty($pass)) {
            $pepperedPass = hash_hmac('sha256', $pass, PEPPER);
            $finalPass = password_hash($pepperedPass, PASSWORD_DEFAULT);
        } else {
            $pepperedPass = null;
            $finalPass = null;
        }

        $result = $this->daoMembres->addMembre( $nom, $prenom, $sexe, $daten, $nomFichierPhoto, $courriel, $finalPass, $role, $statut);
        if ($result) {
                echo json_encode(["etat" => true, "message" => "Le membre a ete ajoute avec succes !"]);
            } else {
                echo json_encode(["etat" => false, "message" => "Une erreur s'est produite lors de l'ajout du membre."]);
            }
        }
    }

    public function modifierMembre($idm, $nom, $prenom, $sexe, $daten, $photo, $courriel, $pass, $role, $statut) {
    $membreExist = $this->daoMembres->getMembreById($idm);
    if (!$membreExist) {
        echo json_encode(["etat" => false, "message" => "Le membre n'existe pas."]);
        return;
    }

    $nomFichierPhoto = $membreExist->getPhoto(); // photo par défaut

    // Traitement de la photo si une nouvelle est soumise
    if (isset($photo) && $photo['error'] === UPLOAD_ERR_OK) {
        $allowedTypes = ['image/jpeg', 'image/png'];
        $mimeType = mime_content_type($photo['tmp_name']);

        if (!in_array($mimeType, $allowedTypes)) {
            echo json_encode(["etat" => false, "message" => "Format d'image invalide. (JPG/PNG requis)"]);
            return;
        }

        $extension = $mimeType === 'image/png' ? 'png' : 'jpg';
        $nomFichierPhoto = preg_replace('/[^a-zA-Z0-9_-]/', '_', strtolower($nom)) . '.' . $extension;
        $destination = __DIR__ . '/../../photos/membresPhotos/' . $nomFichierPhoto;

        if (!move_uploaded_file($photo['tmp_name'], $destination)) {
            echo json_encode(["etat" => false, "message" => "Échec du téléchargement de l'image."]);
            return;
        }
    }

    // Traitement du mot de passe
    if (!empty($pass)) {
        $pepperedPass = hash_hmac('sha256', $pass, $_ENV['PEPPER']);
        $finalPass = password_hash($pepperedPass, PASSWORD_DEFAULT);
    } else {
        $finalPass = $membreExist->getConnexion()->getPass(); 
    }

    // Mise à jour via DAO
    $result = $this->daoMembres->updateMembre($idm, $nom, $prenom, $sexe, $daten, $nomFichierPhoto, $courriel, $finalPass, $role, $statut);
    if ($result) {
        echo json_encode(["etat" => true, "message" => "Le membre a été modifié avec succès !"]);
    } else {
        echo json_encode(["etat" => false, "message" => "Une erreur s'est produite lors de la modification du membre."]);
    }
}


    public function supprimerMembre($idm) {
        $membreExist = $this->daoMembres->getMembreById($idm);
        if (!$membreExist) {
            echo json_encode(["etat" => false, "message" => "Le membre n'existe pas."]);
            return;
        }

        $result = $this->daoMembres->deleteMembre($idm);
        if ($result) {
            echo json_encode(["etat" => true, "message" => "Le membre a ete supprime avec succes !"]);
        } else {
            echo json_encode(["etat" => false, "message" => "Une erreur s'est produite lors de la suppression du membre."]);
        }
    }

}


?>