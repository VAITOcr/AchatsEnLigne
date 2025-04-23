
<?php
require_once(__DIR__ . '/../connexion/connexion.php');
require_once(__DIR__ . '/../includes/env/env_vars.inc.php');

class ControleurMembre {
    private $connexion;

    public function __construct() {
        $this->connexion = Connexion::getConnexion();
    }

    public function enregistrerMembre(array $data, array $fichier): string {
        $nom = $data['nom'] ?? 'invalide';
        $prenom = $data['prenom'] ?? 'invalide';
        $sexe = $data['sexe'] ?? '';
        $daten = $data['daten'] ?? '';
        $courriel = $data['courriel'] ?? '';
        $pass = $data['mdpc'] ?? '';
        $role = 'M';
        $statut = 'A';
        $photo = NULL;
        $msg = '';

        try {
            // Vérification de l'existence de l'utilisateur
            $verifierUser = 'SELECT * FROM connexion WHERE courriel = ?';
            $stmtVerifierUser = $this->connexion->prepare($verifierUser);
            $stmtVerifierUser->execute([$courriel]);

            if ($stmtVerifierUser->rowCount() > 0) {
                $msg = "Un utilisateur avec ce courriel existe déja.";
                return $msg;
            }

            // Upload de la photo si fournie
            if (isset($fichier['photo']) && $fichier['photo']['error'] == 0) {
                $dossier = __DIR__ . "/../../photos/membresPhotos/";
                $extension = pathinfo($fichier['photo']['name'], PATHINFO_EXTENSION);
                $nomFichier = $nom . "." . $extension;
                $dossierFichier = $dossier . $nomFichier;

                if (move_uploaded_file($fichier['photo']['tmp_name'], $dossierFichier)) {
                    $photo = $nomFichier;
                }
            }

            // Insertion dans la table membres
            $requeteMembre = "INSERT INTO membres (nom, prenom, sexe, daten, photo) VALUES (?, ?, ?, ?, ?)";
            $stmtMembre = $this->connexion->prepare($requeteMembre);
            $stmtMembre->execute([$nom, $prenom, $sexe, $daten, $photo]);

            $idm = $this->connexion->lastInsertId();

            // Hachage du mot de passe
            $motDePassePeppered = hash_hmac('sha256', $pass, PEPPER);
            $motDePasseHash = password_hash($motDePassePeppered, PASSWORD_BCRYPT);

            // Insertion dans la table connexion
            $requeteConnexion = "INSERT INTO connexion (idm, courriel, pass, role, statut) VALUES (?, ?, ?, ?, ?)";
            $stmtConnexion = $this->connexion->prepare($requeteConnexion);
            $stmtConnexion->execute([$idm, $courriel, $motDePasseHash, $role, $statut]);

            $msg = "Membre enregistré avec succès !";

            return $msg;

        } catch (PDOException $e) {
            $msg = "Erreur lors de l'enregistrement: " . $e->getMessage();
            return $msg;
        }
    }
}