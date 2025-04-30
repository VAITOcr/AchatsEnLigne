<?php

class Membres{
    public $idm;
    public $nom;
    public $prenom;
    public $sexe;
    public $daten;
    public $photo;
    public $connexion;

    public function __construct($idm, $nom, $prenom, $sexe, $daten, $photo, $connexion) {
        $this->idm = $idm;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->sexe = $sexe;
        $this->daten = $daten;
        $this->photo = $photo;
        $this->connexion = $connexion;
    }

    public function getIdm() {
        return $this->idm;
    }

    public function setIdm($idm) {
        $this->idm = $idm;
    }

    public function getNom() {
        return $this->nom;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    public function getSexe() {
        return $this->sexe;
    }

    public function setSexe($sexe) {
        $this->sexe = $sexe;
    }

    public function getDaten() {
        return $this->daten;
    }

    public function setDaten($daten) {
        $this->daten = $daten;
    }

    public function getPhoto() {
        return $this->photo;
    }

    public function setPhoto($photo) {
        $this->photo = $photo;
    }

    public function getConnexion() {
        return $this->connexion;
    }

    public function setConnexion(ConnexionMembre $connexion) {
        $this->connexion = $connexion;
    }
}








?>