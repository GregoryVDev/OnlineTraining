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
        <h1>Connexion</h1>
        <form method="POST">
            <div class="container-email">
                <label for="email">Email :</label>
                <input type="email" class="form-input" name="email" id="email" placeholder="email@example.com
            " required>
            </div>
            <div class="container-password">
                <label for="password">Mot de passe :</label>
                <input type="password" class="form-input" name="pass" id="pass" placeholder="Mot de passe" required>
            </div>
        </form>
        <div class="container-image">
            <img src="./img/inscription.jpg" alt="Image Connexion">
        </div>
    </main>
</body>

</html>