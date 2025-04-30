<?php

class ConnexionMembre{
    public $idm;
    public $courriel;
    public $pass;
    public $role;
    public $statut;

    public function __construct($idm, $courriel, $pass, $role, $statut) {
        $this->idm = $idm;
        $this->courriel = $courriel;
        $this->pass = $pass;
        $this->role = $role;
        $this->statut = $statut;
    }

    public function getIdm() {
        return $this->idm;
    }

    public function setIdm($idm) {
        $this->idm = $idm;
    }

    public function getCourriel() {
        return $this->courriel;
    }

    public function setCourriel($courriel) {
        $this->courriel = $courriel;
    }

    public function getPass() {
        return $this->pass;
    }

    public function setPass($pass) {
        $this->pass = $pass;
    }

    public function getRole() {
        return $this->role;
    }

    public function setRole($role) {
        $this->role = $role;
    }

    public function getStatut() {
        return $this->statut;
    }

    public function setStatut($statut) {
        $this->statut = $statut;
    }

    
}




?>