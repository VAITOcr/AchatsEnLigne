<?php

declare(strict_types=1); // Enforce strict types

require_once(__DIR__.'/../includes/env/env_vars.inc.php');

class Connexion {
    private static $connexion = null;

    private function __construct() {}

    static function getConnexion(): PDO {
        if (self::$connexion == null) {
            self::connecter();
        }
        return self::$connexion;
    }

    // Créer la connexion
    private static function connecter(): void {
        try {
            $dns = "mysql:host=" . SERVEUR . ";dbname=" . BD;
            $options = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            );
            self::$connexion = new PDO($dns, USAGER, PASS, $options);
        } catch (Exception $e) {
            echo $e->getMessage();
            echo "ERREUR : Connexion au serveur de BD impossible";
            exit();
        }
    }
}
?>
