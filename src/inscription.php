<?php
// On vérifie si le formulaire a été envoyé
if (!empty($_POST)) {
    // Le formulaire a été envoyé
    // On vérifie que TOUS les champs requis sont remplis
    if (
        isset($_POST["nom"], $_POST["prenom"], $_POST["email"], $_POST["pass"], $_POST["pass2"])
        && !empty($_POST["nom"]) && !empty($_POST["prenom"]) && !empty($_POST["email"]) && !empty($_POST["pass"]) && !empty($_POST["pass2"])
    ) {
        // Le formulaire est complet
        // On récupère les données en les protégeants
        $nom = strip_tags($_POST["nom"]);
        $prenom = strip_tags($_POST["prenom"]);
        $email = strip_tags($_POST["email"]);
    } else {
        die("Le formulaire est incomplet");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/inscription/inscription.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Inscription</title>
</head>

<body>
    <main>
        <div class="container-img">
            <img src="./img/connexion/logo_connexion.png" alt="Logo Onlineformapro training">
        </div>
        <form method="POST">
            <h1>Inscription</h1>
            <div class="container-nom">
                <label for="nom">Nom :</label>
                <input type="text" class="form-input" name="nom" id="nom" placeholder="Nom" required>
            </div>
            <div class="container-prenom">
                <label for="prenom">Prénom :</label>
                <input type="text" class="form-input" name="prenom" id="prenom" placeholder="Prénom" required>
            </div>
            <div class="container-email">
                <label for="email">Email :</label>
                <input type="email" class="form-input" name="email" id="email" placeholder="email@example.com
            " required>
            </div>
            <div class="container-password">
                <label for="pass">Mot de passe :</label>
                <input type="password" class="form-input" name="pass" id="pass" placeholder="Mot de passe" required>
            </div>
            <div class="container-confirm">
                <label for="pass2">Confirmation :</label>
                <input type="password" class="form-input" name="pass2" id="pass2" placeholder="Mot de passe" required>
            </div>
            <button type="submit" class="connexion-button">S'inscrire</button>
            <p>Vous avez déjà un compte ? <a href="connexion.php">Connectez-vous</a></p>
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