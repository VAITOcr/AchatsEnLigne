<?php

session_start();

$tempsSession = 1800; // 30 minutes en secondes

// Vérification du temps de session
if (isset($_SESSION['derniere_activite'])) {
    if (time() - $_SESSION['derniere_activite'] > $tempsSession) {
        // Si l'utilisateur est inactif depuis plus de 30 minutes, détruire la session
        session_unset(); // Libérer toutes les variables de session
        session_destroy(); // Destruire la session
        // Si le temps de session est dépassé, rediriger vers la page de connexion
        header("Location: index.php?msg=Votre session a expiré. Veuillez vous reconnecter.");
        exit();
    }
}

// Vérification de la session
if (!isset($_SESSION['user_id'])) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: index.php?msg=Vous devez vous connecter pour accéder à cette page.");
    exit();
} elseif ($_SESSION['role'] !== 'admin') {
    // Rediriger vers la page d'accueil si l'utilisateur n'est pas un administrateur
    header("Location: index.php?msg=Vous n'avez pas accès à cette page.");
    exit();
}

if (isset($_SESSION['verif_agent'])) {
    if ($_SESSION['verif_agent'] !== $_SERVER['HTTP_USER_AGENT']) {
        // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
        session_unset(); // Libérer toutes les variables de session
        session_destroy(); // Détruire la session
        header("Location: index.php?msg=Vous devez vous connecter pour accéder à cette page.");
        exit();
    }
} else {
    $_SESSION['verif_agent'] = $_SERVER['HTTP_USER_AGENT'];
}
    

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>
<body>
    <h1>Admin</h1>
</body>
</html>