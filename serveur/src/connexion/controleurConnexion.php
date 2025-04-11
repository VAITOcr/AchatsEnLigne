<?php
declare(strict_types=1);
require_once(__DIR__.'/DAO-Connexion.php');

class ControleurConnexion {
    private $daoConnexion;

    public function __construct() {
        $this->daoConnexion = new DAO_Connexion();
    }

    public function verifierConnexion(string $courriel, string $mdp): array {
        return $this->daoConnexion->verifierUtilisateur($courriel, $mdp);
    }
}
?>
