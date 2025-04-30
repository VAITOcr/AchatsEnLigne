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

    public function ajouterMembre($idm, $nom, $prenom, $sexe, $daten, $photo, $courriel, $pass, $role, $statut) {
        $membreExist = $this->daoMembres->getMembreById($idm);
        if ($membreExist){
            echo json_encode(["etat" => false, "message" => "Le membre existe deja."]);
            return;
        }

        if (!isset($photo) || $photo['error'] !== UPLOAD_ERR_OK) {
            echo json_encode(["etat" => false, "message" => "Aucune image valide recue."]);
            return;
        }

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
            echo json_encode(["etat" => false, "message" => "Echec du telechargement de l'image."]);
            return;
        }

        if (!empty($pass)) {
            $pepperedPass = hash_hmac('sha256', $pass, $_ENV['PEPPER']);
            $pass = $pepperedPass;
        } else {
            $pass = null;
        }

        $result = $this->daoMembres->addMembre($idm, $nom, $prenom, $sexe, $daten, $nomFichierPhoto, $courriel, $pass, $role, $statut);
        if ($result) {
            echo json_encode(["etat" => true, "message" => "Le membre a ete ajoute avec succes !"]);
        } else {
            echo json_encode(["etat" => false, "message" => "Une erreur s'est produite lors de l'ajout du membre."]);
        }
    }

    public function modifierMembre($idm, $nom, $prenom, $sexe, $daten, $photo, $courriel, $pass, $role, $statut) {
        $membreExist = $this->daoMembres->getMembreById($idm);
        if (!$membreExist) {
            echo json_encode(["etat" => false, "message" => "Le membre n'existe pas."]);
            return;
        }

        if (!isset($photo) || $photo['error'] !== UPLOAD_ERR_OK) {
            echo json_encode(["etat" => false, "message" => "Aucune image valide recue."]);
            return;
        }

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
            echo json_encode(["etat" => false, "message" => "Echec du telechargement de l'image."]);
            return;
        }

        if (!empty($pass)) {
            $pepperedPass = hash_hmac('sha256', $pass, $_ENV['PEPPER']);
            $pass = $pepperedPass;
        } else {
            $pass = $membreExist->getConnexion()->getPass();
        }

        $result = $this->daoMembres->updateMembre($idm, $nom, $prenom, $sexe, $daten, $nomFichierPhoto, $courriel, $pass, $role, $statut);
        if ($result) {
            echo json_encode(["etat" => true, "message" => "Le membre a ete modifie avec succes !"]);
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