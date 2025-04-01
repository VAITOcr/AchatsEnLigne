<?php

require_once(__DIR__.'/../includes/bd/connexion.inc.php');

// Récupérer les données
$tabArticles = array();
try {

// Envoyer la requête au serveur MySQL
$requete = "SELECT * FROM articles";
$resultat = $connexion->query($requete);

while ($row = $resultat->fetch_assoc()) {
    $tabArticles[] = $row;
} 

echo json_encode($tabArticles);

} catch (Exception $e) {
    echo json_encode([]) ;
}



?>