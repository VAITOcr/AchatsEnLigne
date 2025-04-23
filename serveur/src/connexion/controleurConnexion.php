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

    public function verifierConnexionEtSession(string $courriel, string $mdp): void {
        $resultat = $this->verifierConnexion($courriel, $mdp);
        
        if ($resultat['success']) {
            session_start();
            session_regenerate_id(true); // Renouvelle l'ID de session pour éviter le vol de session
            $_SESSION['agent'] = $_SERVER['HTTP_USER_AGENT'];
            $_SESSION['idm'] = $resultat['data']['idm'];
            $_SESSION['role'] = $resultat['data']['role'];
            $_SESSION['nom'] = $resultat['data']['nom'];
            $_SESSION['prenom'] = $resultat['data']['prenom'];
            
            if ($_SESSION['role'] == 'A') {
                header('Location: ../admin/admin.php');
            } else {
                header('Location: ../membre/membre.php');
            }
        } else {
            header('Location: ../../../index.html?msg=' . urlencode($resultat['message']));
        }
    }


}
?>
