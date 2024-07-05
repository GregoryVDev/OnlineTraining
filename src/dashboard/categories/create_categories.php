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
    <link rel="stylesheet" href="../../css/dashboard/dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Formulaire_categories</title>
</head>

<body>
    <?php include '../../templates/navbar_dashboard.php'; ?>
    <br>
    <br>
    <div class="form_produit">
        <div class="">
            <h2>AJOUTER UNE CATEGORIE: </h2>
            <?php if ($error) : ?>
                <p style="color: red;"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>
            <form class="formulaire_produit" method="post">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="type" placeholder="CATEGORIE" name="type" required>
                    <label for="floatingInput">CATEGORIE</label>
                </div>
                <br>
                <div class="btn_produit"><button type="submit" class="btn btn-outline-secondary">AJOUTER</button></div>
            </form>
            <br>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>