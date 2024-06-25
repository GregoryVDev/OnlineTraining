<?php
session_start();
require_once("../../connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (
        isset($_POST["id"]) && !empty($_POST["id"])
        && isset($_POST["reference"]) && !empty($_POST["reference"])
        && isset($_POST["marque"]) && !empty($_POST["marque"])
        && isset($_POST["categorie_id"]) && !empty($_POST["categorie_id"])
        && isset($_POST["couleur"]) && !empty($_POST["couleur"])
        && isset($_POST["matiere"]) && !empty($_POST["matiere"])
        && isset($_POST["motif"]) && !empty($_POST["motif"])
        && isset($_POST["description"]) && !empty($_POST["description"])
        && isset($_POST["image_produit"]) && !empty($_POST["image_produit"])
        && isset($_POST["alt"]) && !empty($_POST["alt"])
        && isset($_POST["quantite"]) && !empty($_POST["quantite"])
        && isset($_POST["prix_ht"]) && !empty($_POST["prix_ht"])
    ) {
        $id = htmlspecialchars($_POST["id"]);
        $reference = htmlspecialchars($_POST["reference"]);
        $marque = htmlspecialchars($_POST["marque"]);
        $categorie_id = htmlspecialchars($_POST["categorie_id"]);
        $couleur = htmlspecialchars($_POST["couleur"]);
        $matiere = htmlspecialchars($_POST["matiere"]);
        $motif = htmlspecialchars($_POST["motif"]);
        $description = htmlspecialchars($_POST["description"]);
        $image_produit = htmlspecialchars($_POST["image_produit"]);
        $alt = htmlspecialchars($_POST["alt"]);
        $quantite = htmlspecialchars($_POST["quantite"]);
        $prix_ht = htmlspecialchars($_POST["prix_ht"]);

        $sql = "UPDATE produits SET reference = :reference, marque = :marque, categorie_id = :categorie_id, couleur = :couleur,
         matiere = :matiere, motif = :motif, description = :description, image_produit = :image_produit, alt = :alt, quantite = :quantite,
         prix_ht = :prix_ht WHERE id = :id";

        $query = $db->prepare($sql);

        $query->bindValue(":id", $id, PDO::PARAM_INT);
        $query->bindValue(":reference", $reference, PDO::PARAM_STR);
        $query->bindValue(":marque", $marque, PDO::PARAM_STR);
        $query->bindValue(":categorie_id", $categorie_id, PDO::PARAM_INT);
        $query->bindValue(":couleur", $couleur, PDO::PARAM_STR);
        $query->bindValue(":matiere", $matiere, PDO::PARAM_STR);
        $query->bindValue(":motif", $motif, PDO::PARAM_STR);
        $query->bindValue(":description", $description, PDO::PARAM_STR);
        $query->bindValue(":image_produit", $image_produit, PDO::PARAM_STR);
        $query->bindValue(":alt", $alt, PDO::PARAM_STR);
        $query->bindValue(":quantite", $quantite, PDO::PARAM_INT);
        $query->bindValue(":prix_ht", $prix_ht, PDO::PARAM_STR);

        $query->execute();

        header("Location: admin_dashboard.php");
    } else {
        echo "Remplissez TOUS les formulaires SVP !";
    }
}

if (isset($_GET["id"]) && !empty($_GET["id"])) {
    $id = strip_tags($_GET["id"]);

    $sql = "SELECT * FROM product WHERE id = :id";

    $query = $db->prepare($sql);
    $query->bindValue(":id", $id, PDO::PARAM_INT);
    $query->execute();

    $user = $query->fetch();

    if (!$user) {
        header("Location: admin_dashboard.php");
    }
} else {
    header("Location: admin_dashboard.php");
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire</title>
</head>

<body>
    <?php
    include './element/navbar.php';
    ?>
    <div class="conteneur_login">
        <div class="conteneur_form_form">
            <h1>Modifier <?= $user["product_name"] ?>:</h1>
            <form method="post">
                <select name="type" id="type">
                    <option value="<?= $user["type"] ?>" required>Sélectionnez un type de produit</option>
                    <option>robe</option>
                    <option>pantalon</option>
                    <option>top</option>
                </select>
                <label for="id_tendance">Tendance:</label>
                <select name="id_tendance" required>
                    <option value="">Sélectionnez une tendance</option>
                    <?php
                    $sql = "SELECT id, tendance_name FROM tendance";
                    $query = $db->query($sql);
                    $currentTendanceId = isset($user["id_tendance"]) ? $user["id_tendance"] : 0; // Mettez à 0 ou quelque chose de similaire si id_tendance n'est pas défini
                    while ($tendance = $query->fetch(PDO::FETCH_ASSOC)) {
                        $selected = ($tendance['id'] == $currentTendanceId) ? 'selected' : '';
                        echo "<option value=\"{$tendance['id']}\" $selected>{$tendance['tendance_name']}</option>";
                    }
                    ?>
                </select>

                <label for="product_name">Nom du produit:</label>
                <input type="text" name="product_name" value="<?= $user["product_name"] ?>" required>
                <label for="product_description">description du produit:</label>
                <input type="text" name="product_description" value="<?= $user["product_description"] ?>" required>
                <label for="product_price">Prix:</label>
                <input type="text" name="product_price" value="<?= $user["product_price"] ?>" required>
                <label for="product_pic_1">photo:</label>
                <input type="text" name="product_pic_1" value="<?= $user["product_pic_1"] ?>" required>
                <label for="product_pic_2">photo:</label>
                <input type="text" name="product_pic_2" value="<?= $user["product_pic_2"] ?>" required>





                <input type="hidden" name="id" value="<?= $user["id"] ?>" required>


            </form>
            <button class="login-btn" type="submit" class="Btn_add">Modifier</button>
            <br>
            <a href="admin_dashboard.php"><button class="login-btn" type="submit" class="Btn_add">Retour </button></a>
        </div>
    </div>
</body>

</html>