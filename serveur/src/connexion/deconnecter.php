<?php
session_start();
session_unset(); // Libérer toutes les variables de session
session_destroy(); // Destruire la session
header("Location: ../../../index.php ?msg=Vous avez été déconnecté avec succès.");
exit();
?>