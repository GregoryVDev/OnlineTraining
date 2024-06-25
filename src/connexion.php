<?php
session_start();

require_once('../src/connexion.php');

$errors = [];
$message = [];

// Formulaire si il a bien été rempli
if (isset($_POST['login']))

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/connect/connect.css">
    <title>Connexion</title>
</head>

<body>
    <main>
        <div class="container-img">
            <img src="./img/connexion/logo_connexion.png" alt="Logo Onlineformapro training">
        </div>
        <form method="POST">
            <h1>Connexion</h1>
            <div class="container-email">
                <label for="email">Email :</label>
                <input type="email" class="form-input" name="email" id="email" placeholder="email@example.com
            " required>
            </div>
            <div class="container-password">
                <label for="password">Mot de passe :</label>
                <input type="password" class="form-input" name="pass" id="pass" placeholder="Mot de passe" required>
            </div>
            <button type="submit" class="connexion-button">Se connecter</button>
            <p>Vous n'avez pas de compte ? <a href="inscription.php">Inscrivez-vous</a></p>
            <span class="follow">Suivez-nous</span>
            <div class="container-logos">
                <a href="#"><img src="./img/connexion/facebook.svg" alt="Logo facebook"></a>
                <a href="#"><img src="./img/connexion/instagram.svg" alt="Logo instagram"></a>
                <a href="#"><img src="./img/connexion/twitter-x.svg" alt="Logo twitter"></a>
            </div>
        </form>

    </main>
</body>

</html>