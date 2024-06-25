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
                <label for="text">Nom :</label>
                <input type="text" class="form-input" name="name" id="name" placeholder="Nom" required>
            </div>
            <div class="container-prenom">
                <label for="text">Prénom :</label>
                <input type="text" class="form-input" name="prenom" id="prenom" placeholder="Prénom" required>
            </div>
            <div class="container-email">
                <label for="email">Email :</label>
                <input type="email" class="form-input" name="email" id="email" placeholder="email@example.com
            " required>
            </div>
            <div class="container-password">
                <label for="password">Mot de passe :</label>
                <input type="password" class="form-input" name="pass" id="pass" placeholder="Mot de passe" required>
            </div>
            <div class="container-confirm">
                <label for="password">Confirmation :</label>
                <input type="password" class="form-input" name="pass" id="pass" placeholder="Mot de passe" required>
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