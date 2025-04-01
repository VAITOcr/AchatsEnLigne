<?php
    require_once(__DIR__.'/connexion.php');

    // Récupérer les données
    $courriel = $_POST['courrielco'];
    $pass = $_POST['mdpco'];
    $connexion = Connexion::getConnexion();

    // Envoyer la requête au serveur MySQL
    $requete = "SELECT * FROM connexion WHERE courriel = ? AND pass = ?";
    $stmt = $connexion->prepare($requete);
    $stmt->execute([$courriel, $pass]);

    // Récupérer le resultat retourné par MySQL. Il se trouve dans $reponse
    $reponse = $stmt->get_result();

    if($reponse->num_rows == 0){
        $msg = "Vérifiez vos paramétres de connexion";
    }else {
        $infosConnexion = $reponse->fetch_object();
        if($infosConnexion->statut == 'A') { // A-Admin. Est-ce que le statut du membre membre est A-Actif
            // Le reste : vérifier su role est A ou M
            if($infosConnexion->role == 'A') { // Est-ce un Admin ?
                header('Location: ../admin/admin.html');
                exit();
            } else if($infosConnexion->role == 'M') { // Est-ce un Membre ?                   
                        header('Location: ../membre/membre.html');
                        exit();
                    } else {
                        // Éventuellement pour d'autres catégories
                    } 

        } else { // Le statut est I-Inactif
            $msg = "Vous devez contacter l'administrateur du site.";
        }
    }
    // urlencode() garantit que $msg est transmis sans erreur, 
    // surtout s’il contient des caractères spéciaux ou des espaces.
    header('Location:  ../../../index.html?msg='.urlencode($msg));
    exit();
?>