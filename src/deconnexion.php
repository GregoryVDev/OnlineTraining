<?php

// Lancement de la session
session_start();

// Vérification si l'utilisateur est déjà connecté ou pas
if (!isset($_SESSION["user"])) {
    header("Location: connexion.php");
    exit();
}

// Détruire la session
unset($_SESSION['user']);

// Redirection vers la page d'accueil ou de connexion
header("Location: index.php");

// Assurez-vous qu'aucun autre code ne soit exécuté après la redirection
exit();
