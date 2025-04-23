<?php
declare(strict_types=1);
require_once(__DIR__.'/../connexion/connexion.php');
require_once(__DIR__.'/../includes/env/env_vars.inc.php');

class DAO_Connexion {
    private $connexion;

    public function __construct() {
        $this->connexion = Connexion::getConnexion();
    }

    public function verifierUtilisateur(string $courriel, string $mdp): array {
        try {
            // Préparer la requête SQL pour vérifier l'utilisateur
            $requete = 
            "SELECT connexion.idm, connexion.courriel, connexion.pass, connexion.role, connexion.statut,membres.nom, membres.prenom 
            FROM connexion INNER JOIN membres ON connexion.idm = membres.idm
            WHERE connexion.courriel = ?  AND connexion.statut = 'A'"; 


            $stmt = $this->connexion->prepare($requete);
            $stmt->execute([$courriel]);
            $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);
            $motDePassePeppered= hash_hmac('sha256', $mdp, PEPPER); // Ajouter le pepper au mot de passe
            
            if ($utilisateur && password_verify($motDePassePeppered, $utilisateur['pass'])) {
            return [
                "success" => true,
                "data" => $utilisateur
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