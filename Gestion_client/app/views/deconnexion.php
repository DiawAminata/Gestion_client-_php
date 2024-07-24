<?php
session_start();
session_unset();
session_destroy();
header('Location: ../../index.php'); // Redirection vers la page de connexion
exit;
?>
