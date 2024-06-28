<?php
// On demarre une session 
session_start();

$error = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (
        isset($_POST["type"]) && !empty($_POST["type"])
    ) {
        require_once("../../connect.php");
        $type = htmlspecialchars($_POST["type"]);

        $sql = "INSERT INTO categories (type) VALUES (:type)";

        $query = $db->prepare($sql);
        $query->bindValue(":type", $type);
        $query->execute();

        $_SESSION["message"] = "Catégorie ajoutée";
        header("Location: dashboard_categories.php");
        exit;
    } else {
        $error = "Veuillez remplir TOUS les formulaires !";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Formulaire_categories</title>
</head>

<body>
    <?php include '../../templates/navbar_dashboard.php'; ?>
    <br>
    <br>
    <div class="conteneur_login">
        <div class="conteneur_form_form">
            <h2>AJOUTER UNE CATEGORIE: </h2>
            <?php if ($error) : ?>
                <p style="color: red;"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>
            <form method="post">
                <label for="type">Catégorie du produit:</label>
                <input type="text" name="type" required>
                <br>
                <button class="login-btn">Ajouter</button>
            </form>
            <br>
            <button class="login-btn"><a href="./dashboard_categories.php">Retour</a></button>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>