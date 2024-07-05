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
    <link rel="stylesheet" href="../../css/dashboard/dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Formulaire_users</title>
</head>

<body>
    <?php
    include '../../templates/navbar_dashboard.php';
    ?>
    <br>
    <div class="form_produit">
        <div>
            <form class="formulaire_produit" method="POST">
                <h2>AJOUTER UN UTILISATEUR :</h2>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="nom" placeholder="NOM" name="nom" required>
                    <label for="floatingInput">NOM</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="prenom" placeholder="PRENOM" name="prenom" required>
                    <label for="floatingInput">PRENOM</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" placeholder="email@example.com" id="email" name="email" required>
                    <label for="floatingInput">EMAIL</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="pass" placeholder="NOM" name="pass" required>
                    <label for="floatingInput">MOT DE PASSE</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="pass2" placeholder="CONFIRMATION" name="pass2" required>
                    <label for="floatingInput">CONFIRMATION</label>
                </div>
                <div class="btn_produit"><button type="submit" class="btn btn-outline-secondary">AJOUTER</button></div>
            </form>
            <br>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>