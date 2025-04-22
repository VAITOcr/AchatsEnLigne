<?php
session_start();
session_unset(); // Libérer toutes les variables de session
session_destroy(); // Destruire la session
header("Location: ../../../index.html");
exit();
?>