<?php
session_start();
require_once("../../connect.php");

function generateRandomString($length = 20)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

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
        $alt = htmlspecialchars($_POST["alt"]);
        $quantite = htmlspecialchars($_POST["quantite"]);
        $prix_ht = htmlspecialchars($_POST["prix_ht"]);

        // Vérification et gestion de l'upload de l'image
        $uploadDir = '../../img/produits/';
        $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');
        $image_produit = htmlspecialchars($_POST["image_produit_current"]); // Fichier actuel si pas de nouvel upload

        if (isset($_FILES["image_produit"]) && $_FILES["image_produit"]["error"] === 0) {
            $imageFileType = strtolower(pathinfo($_FILES['image_produit']['name'], PATHINFO_EXTENSION));
            if (in_array($imageFileType, $allowedTypes)) {
                $newFileName = generateRandomString(20) . '.' . $imageFileType;
                $newFilePath = $uploadDir . $newFileName;

                // Supprimer l'ancienne image
                if (file_exists($image_produit)) {
                    unlink($image_produit);
                }

                if (move_uploaded_file($_FILES['image_produit']['tmp_name'], $newFilePath)) {
                    $image_produit = $newFilePath;
                } else {
                    echo "Erreur lors du téléchargement du fichier.";
                    exit;
                }
            } else {
                echo "Format de l'image non autorisé.";
                exit;
            }
        }

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

        header("Location: dashboard_produits.php");
    } else {
        echo "Remplissez TOUS les formulaires SVP !";
    }
}

if (isset($_GET["id"]) && !empty($_GET["id"])) {
    $id = strip_tags($_GET["id"]);

    $sql = "SELECT * FROM produits WHERE id = :id";

    $query = $db->prepare($sql);
    $query->bindValue(":id", $id, PDO::PARAM_INT);
    $query->execute();

    $user = $query->fetch();

    if (!$user) {
        header("Location: dashboard_produits.php");
    }
} else {
    header("Location: dashboard_produits.php");
}
?>
```

### HTML (formulaire_modification.php)

```html
<!DOCTYPE html>
<html lang="fr">

<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire_produits</title>
</head>

<body>
    <div class="conteneur_login">
        <div class="conteneur_form_form">
            <h1>Modifier <?= htmlspecialchars($user["reference"]) ?>:</h1>
            <form method="post" enctype="multipart/form-data">
                <label for="reference">Référence:</label>
                <input type="text" id="reference" name="reference" value="<?= htmlspecialchars($user["reference"]) ?>" required>
                <br>
                <label for="marque">Marque:</label>
                <input type="text" id="marque" name="marque" value="<?= htmlspecialchars($user["marque"]) ?>" required>
                <br>
                <label for="categorie_id">Catégorie:</label>
                <select id="categorie_id" name="categorie_id" required>
                    <option value=""><?= htmlspecialchars($user["categorie_id"]) ?></option>
                    <?php
                    require_once("../../connect.php");
                    $sql = "SELECT id, type FROM categories";
                    $query = $db->query($sql);
                    while ($categories = $query->fetch(PDO::FETCH_ASSOC)) {
                        $selected = $categories['id'] == $user["categorie_id"] ? "selected" : "";
                        echo "<option value=\"{$categories['id']}\" $selected>{$categories['type']}</option>";
                    }
                    ?>
                </select>
                <br>
                <label for="couleur">Couleur:</label>
                <input type="text" id="couleur" name="couleur" value="<?= htmlspecialchars($user["couleur"]) ?>" required>
                <br>
                <label for="matiere">Matière:</label>
                <input type="text" id="matiere" name="matiere" value="<?= htmlspecialchars($user["matiere"]) ?>" required>
                <br>
                <label for="motif">Motif:</label>
                <input type="text" id="motif" name="motif" value="<?= htmlspecialchars($user["motif"]) ?>" required>
                <br>
                <label for="description">Description:</label>
                <input type="text" id="description" name="description" value="<?= htmlspecialchars($user["description"]) ?>" required>
                <br>
                <label for="image_produit">Image:</label>
                <input type="file" id="image_produit" name="image_produit">
                <input type="hidden" name="image_produit_current" value="<?= htmlspecialchars($user["image_produit"]) ?>">
                <br>
                <label for="alt">Description de l'image:</label>
                <input type="text" id="alt" name="alt" value="<?= htmlspecialchars($user["alt"]) ?>" required>
                <br>
                <label for="quantite">Quantité:</label>
                <input type="text" id="quantite" name="quantite" value="<?= htmlspecialchars($user["quantite"]) ?>" required>
                <br>
                <label for="prix_ht">Prix HT:</label>
                <input type="text" id="prix_ht" name="prix_ht" value="<?= htmlspecialchars($user["prix_ht"]) ?>" required>
                <br>
                <br>
                <input type="hidden" name="id" value="<?= htmlspecialchars($user["id"]) ?>" required>
                <button class="login-btn" type="submit" class="Btn_add">Modifier</button>
                <br>
                <br>
            </form>
            <a href="dashboard_produits.php"><button class="login-btn" class="Btn_add">Retour </button></a>
        </div>
    </div>
</body>

</html>