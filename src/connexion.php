<?php
session_start();

function validateEmail($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

// On vérifie si le formulaire a été envoyé
if (!empty($_POST)) {
    // Le formulaire a été envoyé
    // On vérifie que TOUS les champs requis sont remplis

    if (isset($_POST["email"], $_POST_["pass"]) && !empty($_POST["email"]) && !empty($_POST["pass"])) {
        // On vérifie que l'email en est un
        if (!validateEmail($_POST["email"])) {
            die("L'adresse email est incorrecte");
        }

        // On se connecte à la bdd
        require_once("connect.php");

        // Assuming $db is the PDO instance from "connect.php"
        $sql = "SELECT * FROM users WHERE email = :email";

        $query = $db->prepare($sql);

        $query->bindValue(":email", $_POST["email"]);

        $query->execute();

        $user = $query->fetch();

        if (!$user) {
            die("The user and/or password is incorrect");
        }

        // On a un user existant, on peut vérifier son mdp

        if (!password_verify($_POST['pass'], $user["pass"])) {
            die("The user and/or password is incorrect");
        }

        // L'utilisateur et le mot de passe sont corrects
        // On va pouvoir "connecter" l'utilisateur


        // On stocke dans $_SESSION les informations de l'utilisateur
        $_SESSION['user'] = [
            "id" => $user['id'],
            "pseudo" => $user['username'],
            "email" => $user['email'],
            "roles" => $user['roles']
        ];

        // Rediriger vers la page index (exemple)
        header("Location: index.php");
    } else {
        // Formulaire incomplet
        die("The form is incomplete");
    }
}

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