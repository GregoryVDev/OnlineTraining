<?php
session_start();
require_once("../../connect.php");

$error = null;

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
        exit;
    } else {
        $error = "Remplissez TOUS les formulaires SVP !";
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
        echo "Catégorie non trouvée.";
        exit;
    }
} else {
    header("Location: dashboard_categories.php");
    exit;
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

    <div class="conteneur_login">
        <div class="conteneur_form_form">
            <h1>Modifier <?= htmlspecialchars($user["type"]) ?>:</h1>
            <?php if ($error) : ?>
                <p style="color: red;"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>
            <form method="post">

                <label for="type">Catégorie du produit:</label>
                <input type="text" name="type" value="<?= htmlspecialchars($user["type"]) ?>" required>
                <br>
                <br>

                <input type="hidden" name="id" value="<?= htmlspecialchars($user["id"]) ?>" required>

                <button class="login-btn" type="submit" class="Btn_add">Modifier</button>
                <br>
                <br>

            </form>

            <a href="dashboard_categories.php"><button class="login-btn" class="Btn_add">Retour </button></a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>