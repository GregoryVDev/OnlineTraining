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
        && isset($_POST["nom_produit"]) && !empty($_POST["nom_produit"])
        && isset($_POST["genre"]) && !empty($_POST["genre"])
        && isset($_POST["reference"]) && !empty($_POST["reference"])
        && isset($_POST["marque"]) && !empty($_POST["marque"])
        && isset($_POST["categorie_id"]) && !empty($_POST["categorie_id"])
        && isset($_POST["couleur"]) && !empty($_POST["couleur"])
        && isset($_POST["matiere"]) && !empty($_POST["matiere"])
        && isset($_POST["motif"]) && !empty($_POST["motif"])
        && isset($_POST["description"]) && !empty($_POST["description"])
        && isset($_POST["taille"]) && !empty($_POST["taille"])
        && isset($_POST["quantite"]) && !empty($_POST["quantite"])
        && isset($_POST["prix_ht"]) && !empty($_POST["prix_ht"])
    ) {
        $id = htmlspecialchars($_POST["id"]);
        $nom_produit = htmlspecialchars($_POST["nom_produit"]);
        $genre = htmlspecialchars($_POST["genre"]);
        $reference = htmlspecialchars($_POST["reference"]);
        $marque = htmlspecialchars($_POST["marque"]);
        $categorie_id = htmlspecialchars($_POST["categorie_id"]);
        $couleur = htmlspecialchars($_POST["couleur"]);
        $matiere = htmlspecialchars($_POST["matiere"]);
        $motif = htmlspecialchars($_POST["motif"]);
        $description = htmlspecialchars($_POST["description"]);
        $taille = htmlspecialchars($_POST["taille"]);
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
                if (!empty($image_produit) && file_exists(__DIR__ . '/../../' . $image_produit)) {
                    unlink(__DIR__ . '/../../' . $image_produit);
                }

                if (move_uploaded_file($_FILES['image_produit']['tmp_name'], $newFilePath)) {
                    $image_produit = $newFileName;
                } else {
                    echo "Erreur lors du téléchargement du fichier.";
                    exit;
                }
            } else {
                echo "Format de l'image non autorisé.";
                exit;
            }
        }

        $sql = "UPDATE produits SET image_produit = :image_produit, nom_produit = :nom_produit, genre = :genre, reference = :reference, marque = :marque, categorie_id = :categorie_id, couleur = :couleur,
                matiere = :matiere, motif = :motif, description = :description, taille = :taille, quantite = :quantite,
                prix_ht = :prix_ht WHERE id = :id";

        $query = $db->prepare($sql);

        $query->bindValue(":id", $id, PDO::PARAM_INT);
        $query->bindValue(":image_produit", 'img/produits/' . $newFileName, PDO::PARAM_STR);
        $query->bindValue(":nom_produit", $nom_produit, PDO::PARAM_STR);
        $query->bindValue(":genre", $genre, PDO::PARAM_STR);
        $query->bindValue(":reference", $reference, PDO::PARAM_STR);
        $query->bindValue(":marque", $marque, PDO::PARAM_STR);
        $query->bindValue(":categorie_id", $categorie_id, PDO::PARAM_INT);
        $query->bindValue(":couleur", $couleur, PDO::PARAM_STR);
        $query->bindValue(":matiere", $matiere, PDO::PARAM_STR);
        $query->bindValue(":motif", $motif, PDO::PARAM_STR);
        $query->bindValue(":description", $description, PDO::PARAM_STR);
        $query->bindValue(":taille", $taille, PDO::PARAM_STR);
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

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Formulaire_produits</title>
</head>

<body>
    <?php
    include '../../templates/navbar_dashboard.php';
    ?>
    <div class="conteneur_login">
        <div class="conteneur_form_form">
            <h1>Modifier <?= htmlspecialchars($user["reference"]) ?>:</h1>
            <form method="post" enctype="multipart/form-data">
                <label for="image_produit">Image:</label>
                <input type="file" id="image_produit" name="image_produit">
                <input type="hidden" name="image_produit_current" value="<?= htmlspecialchars($user["image_produit"]) ?>">
                <br>
                <label for="nom_produit">Nom:</label>
                <input type="text" id="nom_produit" name="nom_produit" value="<?= htmlspecialchars($user["nom_produit"]) ?>" required>
                <br>
                <label for="genre">Genre:</label>
                <select id="genre" name="genre" required>
                    <option value="<?= htmlspecialchars($user["genre"]) ?>"><?= htmlspecialchars($user["genre"]) ?></option>
                    <option value="Homme">Homme</option>
                    <option value="Femme">Femme</option>
                </select>
                <br>
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
                <label for="taille">Taille:</label>
                <input type="text" id="taille" name="taille" value="<?= htmlspecialchars($user["taille"]) ?>" required>
                <br>
                <label for="quantite">Quantité:</label>
                <input type="number" id="quantite" name="quantite" value="<?= htmlspecialchars($user["quantite"]) ?>" required min="0">
                <br>
                <label for="prix_ht">Prix HT:</label>
                <input type="number" id="prix_ht" name="prix_ht" value="<?= htmlspecialchars($user["prix_ht"]) ?>" required min="0">
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>