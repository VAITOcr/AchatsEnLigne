<?php
define('SECURE_ACCESS', true); // Définit une constante pour vérifier l'accès sécurisé

// si l'utilisateur n'est pas connecté envoyer un msg d'erreur
if (!isset($_SESSION['user'])) {
    header("Location: ../../../index.php?msg=Vous devez être connecté pour vous déconnecter.");
    exit();
}
session_start();
session_unset(); // Libérer toutes les variables de session
session_destroy(); // Destruire la session
header("Location: ../../../index.php ?msg=Vous avez été déconnecté avec succès.");
exit();
?>