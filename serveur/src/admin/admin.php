<?php

define('SECURE_ACCESS', true); // Définir une constante pour safegarder l'accès
require_once(__DIR__ . '/../config_paths.php');

session_start();

$tempsSession = 1800; // 30 minutes en secondes

// Vérification du temps de session
if (isset($_SESSION['derniere_activite'])) {
    if (time() - $_SESSION['derniere_activite'] > $tempsSession) {
        // Si l'utilisateur est inactif depuis plus de 30 minutes, détruire la session
        session_unset(); // Libérer toutes les variables de session
        session_destroy(); // Destruire la session
        // Si le temps de session est dépassé, rediriger vers la page de connexion
        header("Location: ../../../index.php?msg=Votre session a expiré. Veuillez vous reconnecter.");
        exit();
    }
}

$_SESSION['derniere_activite'] = time(); // Mettre à jour le temps de la dernière activité

// Vérification de la session
if (!isset($_SESSION['idm'])) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header('Location: ../../../index.php?msg=' . urlencode(" Accès refusé."));
    exit();
}

// Vérification du rôle de l'utilisateur
if ($_SESSION['role'] !== 'A') {
    // Rediriger vers la page d'accueil si l'utilisateur n'est pas un administrateur
    header('Location: ../../../index.php?msg=' . urlencode(" Accès refusé."));
    exit();
}

// Vérification de l'agent utilisateur
if (!isset($_SESSION['agent']) || $_SESSION['agent'] !== $_SERVER['HTTP_USER_AGENT']) {
    session_unset();
    session_destroy();
    header('Location: ../../../index.php?msg=' . urlencode(" Votre session a expiré. Veuillez vous reconnecter."));
    exit();
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <script>
  window.serveurUrl = "<?= $serveurUrl ?>";
   window.clientUrl = "<?= $clientUrl ?>";
</script>
  <meta charset="UTF-8">
  <title>Tableau de bord Admin</title>
  <link rel="stylesheet" href="<?= $clientUrl ?>utilitaires/css/bootstrap.min.css" />
  <link rel="stylesheet" href="<?= $clientUrl ?>utilitaires/css/font-awesome.min.css" />
  <link rel="stylesheet" href="<?= $clientUrl ?>css/admin.css" />
  

  <script src="<?= $clientUrl ?>utilitaires/jquery-3.7.1.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<header id="admin-header">
  <img src="<?= $clientUrl ?>images/logoNew.png" alt="logo" id="logo-admin" />
  <h1>Admin Dashboard</h1>
</header>
<body>

  <!-- Sidebar -->
<div id="sidebar-admin">
  <a href="#" class="active" id="btn-articles"><i class="fa fa-cubes"></i> Articles</a>
  <a href="#" id="btn-users"><i class="fa fa-users"></i> Utilisateurs</a>
  <a href="<?= $serveurUrl ?>src/connexion/deconnecter.php" class="btn-sortir">
  <i class="fa fa-sign-out"></i> Sortir
</a>
</div>

<!-- Contenu dynamique -->
<div id="contenu-admin">
  <h2>Gestion des données</h2>
  <div id="contenu-dynamique">
    <!-- Le contenu changera ici -->
  </div>
</div>

<div id="admin-toast" class="toast-message"></div>

<?php include($serveurPath . "src/admin/components/modalesAdmin.php"); ?>
<script type="module" src="<?= $clientUrl ?>js/admin/adminDashboard.js"></script>

</body>
</html>