<?php
session_start();

function validateEmail($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

// Inclure la connexion à la base de données
require_once("../../connect.php");

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
        $email = $_POST["email"];

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

        // Ajoutez cette ligne pour récupérer l'ID de l'utilisateur
        $id = $_GET["id"];

        $sql = "UPDATE users SET nom = :nom, prenom = :prenom, email = :email, pass = :pass WHERE id = :id";

        $query = $db->prepare($sql);

        $query->bindValue(":id", $id, PDO::PARAM_INT);
        $query->bindValue(":nom", $nom, PDO::PARAM_STR);
        $query->bindValue(":prenom", $prenom, PDO::PARAM_STR);
        $query->bindValue(":email", $email, PDO::PARAM_STR);
        $query->bindValue(":pass", $pass, PDO::PARAM_STR);

        $query->execute();

        header("Location: dashboard_users.php");
    } else {
        echo "Remplissez TOUS les formulaires SVP !";
    }
}

if (isset($_GET["id"]) && !empty($_GET["id"])) {
    $id = strip_tags($_GET["id"]);

    $sql = "SELECT * FROM users WHERE id = :id";

    $query = $db->prepare($sql);

    $query->bindValue(":id", $id, PDO::PARAM_INT);
    $query->execute();

    $user = $query->fetch();

    if (!$user) {
        header("Location: dashboard_users.php");
    }
} else {
    header("Location: dashboard_users.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/inscription/inscription.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Formulaire_users</title>
</head>

<body>
    <?php
    include '../../templates/navbar_dashboard.php';
    ?>
    <main>
        <form method="POST">
            <h1>Modifier <?= $user["prenom"] ?> <?= $user["nom"] ?> :</h1>
            <div class="container-nom">
                <label for="nom">Nom :</label>
                <input type="text" class="form-input" name="nom" id="nom" value="<?= $user["nom"] ?>" required>
            </div>
            <div class="container-prenom">
                <label for="prenom">Prénom :</label>
                <input type="text" class="form-input" name="prenom" id="prenom" value="<?= $user["prenom"] ?>" required>
            </div>
            <div class="container-email">
                <label for="email">Email :</label>
                <input type="email" class="form-input" name="email" id="email" value="<?= $user["email"] ?>" required>
            </div>
            <div class="container-password">
                <label for="pass">Mot de passe :</label>
                <input type="password" class="form-input" name="pass" id="pass" placeholder="Mot de passe" required>
            </div>
            <div class="container-confirm">
                <label for="pass2">Confirmation :</label>
                <input type="password" class="form-input" name="pass2" id="pass2" placeholder="Mot de passe" required>
            </div>
            <button type="submit" class="connexion-button">Ajouter</button>
        </form>
        <br>
        <a href="dashboard_users.php"><button class="login-btn" class="Btn_add">Retour </button></a>
    </main>
</body>

</html>