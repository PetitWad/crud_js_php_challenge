<?php 
// Début de la session
session_start();

// Détruire la session et supprimer les données associées
session_destroy();

// Rediriger l'utilisateur vers la page de connexion ou une autre page appropriée
header('Location: index.php');
exit();

?>