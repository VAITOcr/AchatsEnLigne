<?php

require_once(__DIR__.'/../../connexion/connexion.php');
require_once('Membres.php');
require_once('ConnexionMembre.php');

class DAO_Membres{
    private static $objReponse = ["etat" => true, "message" => "", "donnees" => []];

    public function getAllMembres(): array {
        try {
            $connexion = Connexion::getConnexion();
            $stmt = $connexion->prepare("SELECT m.idm, m.nom, m.prenom, m.sexe, m.daten, m.photo, c.courriel, c.pass, c.role, c.statut FROM membres m INNER JOIN connexion c ON m.idm = c.idm");
            $stmt->execute();
            self::$objReponse["donnees"] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            self::$objReponse["etat"] = false;
            self::$objReponse["message"] = "Erreur lors de la récupération des membres: " . $e->getMessage();
        }
        return self::$objReponse;
    }

    public function getMembreById($idm): ?Membres {
        try {
            $connexion = Connexion::getConnexion();
            $stmt = $connexion->prepare("SELECT m.idm, m.nom, m.prenom, m.sexe, m.daten, m.photo, c.courriel, c.pass, c.role, c.statut FROM membres m INNER JOIN connexion c ON m.idm = c.idm WHERE m.idm = :idm");
            $stmt->execute(['idm' => $idm]);
            $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($resultat) {
                $objConnexion = new ConnexionMembre($resultat["idm"], $resultat["courriel"], $resultat["pass"], $resultat["role"], $resultat["statut"]);
                return new Membres($resultat["idm"], $resultat["nom"], $resultat["prenom"], $resultat["sexe"], $resultat["daten"], $resultat["photo"], $objConnexion);
            }
            return null;
        } catch (PDOException $e) {
            return null;
        }
    }

    public function getMembreByCourriel($courriel): ?Membres {
        try {
            $connexion = Connexion::getConnexion();
            $stmt = $connexion->prepare("SELECT m.idm, m.nom, m.prenom, m.sexe, m.daten, m.photo, c.courriel, c.pass, c.role, c.statut FROM membres m INNER JOIN connexion c ON m.idm = c.idm WHERE c.courriel = :courriel");
            $stmt->execute(['courriel' => $courriel]);
            $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($resultat) {
                $objConnexion = new ConnexionMembre($resultat["idm"], $resultat["courriel"], $resultat["pass"], $resultat["role"], $resultat["statut"]);
                return new Membres($resultat["idm"], $resultat["nom"], $resultat["prenom"], $resultat["sexe"], $resultat["daten"], $resultat["photo"], $objConnexion);
            }
            return null;
        } catch (PDOException $e) {
            return null;
        }
    }

    public function addMembre( $nom, $prenom, $sexe, $daten, $photo, $courriel, $pass, $role, $statut) {
        try {
            $connexion = Connexion::getConnexion();
            $stmt = $connexion->prepare("INSERT INTO membres ( nom, prenom, sexe, daten, photo) VALUES ( :nom, :prenom, :sexe, :daten, :photo)");
            $stmt->execute([ 'nom' => $nom, 'prenom' => $prenom, 'sexe' => $sexe, 'daten' => $daten, 'photo' => $photo]);
            $idm = $connexion->lastInsertId();
            $stmt = $connexion->prepare("INSERT INTO connexion (idm, courriel, pass, role, statut) VALUES ( :idm, :courriel, :pass, :role, :statut)");
            $stmt->execute([ 'idm' => $idm, 'courriel' => $courriel, 'pass' => $pass, 'role' => $role, 'statut' => $statut]);
        } catch (PDOException $e) {
             error_log("Erreur addMembre: " . $e->getMessage(), 3, __DIR__ . "/mon_fichier_log.log");
            return false;
        }
        return true;
    }

    public function updateMembre($idm, $nom, $prenom, $sexe, $daten, $photo, $courriel, $pass, $role, $statut) {
        try {
            $connexion = Connexion::getConnexion();
            $stmt = $connexion->prepare("UPDATE membres SET nom = :nom, prenom = :prenom, sexe = :sexe, daten = :daten, photo = :photo WHERE idm = :idm");
            $stmt->execute(['idm' => $idm, 'nom' => $nom, 'prenom' => $prenom, 'sexe' => $sexe, 'daten' => $daten, 'photo' => $photo]);
            $stmt = $connexion->prepare("UPDATE connexion SET courriel = :courriel, pass = :pass, role = :role, statut = :statut WHERE idm = :idm");
            $stmt->execute(['idm' => $idm, 'courriel' => $courriel, 'pass' => $pass, 'role' => $role, 'statut' => $statut]);
        } catch (PDOException $e) {
            error_log("Mensaje de prueba", 3, __DIR__ . "/mon_fichier_log.log");
            return false;
        }
        return true;
    }

    public function deleteMembre($idm) {
        try {
            $connexion = Connexion::getConnexion();
            $stmt = $connexion->prepare("DELETE FROM connexion WHERE idm = :idm");
            $stmt->execute(['idm' => $idm]);
            $stmt = $connexion->prepare("DELETE FROM membres WHERE idm = :idm");
            $stmt->execute(['idm' => $idm]);
            
        } catch (PDOException $e) {
            return false;
        }
        return true;
    }

}

?>