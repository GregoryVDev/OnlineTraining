<?php


function validateEmail($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

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

        if (!validateEmail($_POST["email"])) {
            die("L'adresse email est incorrecte");
        }

        // Confirmation des mdp
        if (isset($_POST["pass"]) && isset($_POST["pass2"])) {
            $pass = $_POST["pass"];
            $pass2 = $_POST["pass2"];
        }


        if ($pass === $pass2) {
            // On hash le mdp
            $pass = password_hash($_POST["pass"], PASSWORD_ARGON2ID);
        } else {
            die("les mots de passe ne correspondent pas");
        }

        // On enregistre en bdd
        require_once("../../connect.php");

        $sql = "INSERT INTO users (nom, prenom, email, pass, roles ) VALUES (:nom, :prenom, :email, '$pass', '[\"ROLE_USER\"]')";

        $query = $db->prepare($sql);

        $query->bindValue(":nom", $nom);
        $query->bindValue(":prenom", $prenom);
        $query->bindValue(":email", $_POST["email"]);

        $query->execute();
        header("Location: dashboard_users.php");
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Formulaire_users</title>
</head>

<body>
    <?php
    include '../../templates/navbar_dashboard.php';
    ?>
    <main>
        <form method="POST">
            <h1>Ajouter un utilisateur :</h1>
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
            <button type="button" class="btn btn-outline-secondary">Ajouter</button>
        </form>
        <br>
        <a href="dashboard_users.php"><button type="button" class="btn btn-outline-secondary">Retour </button></a>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>