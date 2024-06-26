<?php
session_start();
require_once("../../connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (
        isset($_POST["id"]) && !empty($_POST["id"])
        && isset($_POST["type"]) && !empty($_POST["type"])

    ) {
        $id = htmlspecialchars($_POST["id"]);
        $type = htmlspecialchars($_POST["type"]);


        $sql = "UPDATE categories SET type = :type WHERE id = :id";

        $query = $db->prepare($sql);

        $query->bindValue(":id", $id, PDO::PARAM_INT);
        $query->bindValue(":type", $type, PDO::PARAM_STR);


        $query->execute();

        header("Location: dashboard_categories.php");
    } else {
        echo "Remplissez TOUS les formulaires SVP !";
    }
}

if (isset($_GET["id"]) && !empty($_GET["id"])) {
    $id = strip_tags($_GET["id"]);

    $sql = "SELECT * FROM categories WHERE id = :id";

    $query = $db->prepare($sql);
    $query->bindValue(":id", $id, PDO::PARAM_INT);
    $query->execute();

    $user = $query->fetch();

    if (!$user) {
        header("Location: dashboard_categories.php");
    }
} else {
    header("Location: dashboard_categories.php");
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

    <div class="conteneur_login">
        <div class="conteneur_form_form">
            <h1>Modifier <?= $user["type"] ?>:</h1>
            <form method="post">

                <label for="type">categorie du produit:</label>
                <input type="text" name="type" value="<?= $user["type"] ?>" required>
                <br>
                <br>

                <input type="hidden" name="id" value="<?= $user["id"] ?>" required>


                <button class="login-btn" type="submit" class="Btn_add">Modifier</button>
                <br>
                <br>

            </form>

            <a href="dashboard_categories.php"><button class="login-btn" class="Btn_add">Retour </button></a>
        </div>
    </div>
</body>

</html>