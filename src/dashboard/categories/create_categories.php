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
</body>

</html>