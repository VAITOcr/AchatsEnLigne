<?php
    require_once(__DIR__.'/../env/env_vars.inc.php');
    // Établir la connexion au serveur de base de données MySQL en utilisant mysqli
    $connexion = new mysqli(SERVEUR, USAGER, PASS, BD);
    if($connexion->connect_errno){
        echo "ERREUR : Connexion au serveur de BD impossible";
        exit();
    }
    $connexion->set_charset("utf8");
?>
