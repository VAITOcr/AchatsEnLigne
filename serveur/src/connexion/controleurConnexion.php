<?php
declare(strict_types=1);
define('SECURE_ACCESS', true); // Définit une constante pour vérifier l'accès sécurisé
require_once(__DIR__.'/DAO-Connexion.php');
require_once(__DIR__ . '/../config_paths.php');




class ControleurConnexion {
    private $daoConnexion;
    private $serveurUrl;

    public function __construct( string $serveurUrl) {
        $this->daoConnexion = new DAO_Connexion();
        $this->serveurUrl = $serveurUrl;
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
                header('Location:' . $this->serveurUrl . 'src/admin/admin.php');
            } else {
                header('Location:' . $this->serveurUrl . 'src/membre/membre.php');
            }
        } else {
            header('Location: ../../../index.php?msg=' . urlencode($resultat['message']));
        }
    }


}
?>
