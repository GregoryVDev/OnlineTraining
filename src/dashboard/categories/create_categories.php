<?php
// On demarre une session 
session_start();
if (
    isset($_POST["type"]) && !empty($_POST["type"])

) {
    require_once("../../connect.php");
    $type = $_POST["type"];



    $sql = "INSERT INTO categories (type) VALUES (:type)";

    $query = $db->prepare($sql);

    $query->bindValue(":type", $type);


    $query->execute();

    $_SESSION["message"] = "Article ajouté";
    header("Location: dashboard_categories.php");
} else {
    echo "Veulliez remplir TOUS les formulaires !";
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
    <?php
    include '../../templates/navbar_dashboard.php';
    ?>
    <br>
    <br>
    <div class="conteneur_login">
        <div class="conteneur_form_form">
            <h2>AJOUTER UNE CATEGORIE: </h2>
            <form method="post">

                <label for="type">categorie du produit:</label>
                <input type="text" name="type" required>
                <br>
                <button class="login-btn">Ajouter</button>
            </form>

            <br>
            <button class="login-btn"><a href="./dashboard_categories.php">Retour</a></button>
            <?php
            // print_r($_POST);
            ?>
        </div>
    </div>
</body>

</html>