<?php
declare(strict_types=1);
require_once(__DIR__.'/../connexion/connexion.php');

class DAO_Connexion {
    private $connexion;

    public function __construct() {
        $this->connexion = Connexion::getConnexion();
    }

    public function verifierUtilisateur(string $courriel, string $mdp): array {
        try {
            // Préparer la requête SQL pour vérifier l'utilisateur
            $requete = 
            "SELECT connexion.idm, connexion.courriel, connexion.pass, connexion.role, connexion.statut,membre.nom, membre.prenom 
            FROM connexion INNER JOIN membres ON connexion.idm = membres.idm
            WHERE connexion.courriel = ? AND connexion.pass = ? AND connexion.statut = 'A'"; 


            $stmt = $this->connexion->prepare($requete);
            $stmt->execute([$courriel, $mdp]);
            
            if ($stmt->rowCount() > 0) {
                return [
                    "success" => true,
                    "data" => $stmt->fetch(PDO::FETCH_ASSOC)
                ];
            }
            
            return [
                "success" => false,
                "message" => "Courriel ou mot de passe incorrect"
            ];
            
        } catch (PDOException $e) {
            return [
                "success" => false,
                "message" => "Erreur lors de la vérification: " . $e->getMessage()
            ];
        }
    }
}
?>