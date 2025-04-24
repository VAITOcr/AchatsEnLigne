<?php
define('SECURE_ACCESS', true); 

session_start(); 

if (!isset($_SESSION['idm'])) {
    header("Location: ../../../index.php?msg=" . urlencode("Vous devez être connecté pour vous déconnecter."));
    exit();
}


$_SESSION = [];

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

session_destroy();


header("Location: ../../../index.php?msg=" . urlencode("Vous avez été déconnecté avec succès."));
exit();
?>