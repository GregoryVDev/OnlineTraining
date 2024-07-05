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
                    $image_produit = 'img/produits/' . $newFileName;
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
        $query->bindValue(":image_produit", $image_produit, PDO::PARAM_STR);
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
        exit; // Assurez-vous de quitter le script après une redirection
    }
} else {
    header("Location: dashboard_produits.php");
    exit; // Assurez-vous de quitter le script après une redirection
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/dashboard/dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Formulaire_produits</title>
</head>

<body>
    <?php
    include '../../templates/navbar_dashboard.php';
    ?>
    <div class="form_produit">
        <div class="">
            <h2>MODIFIER <?= htmlspecialchars($user["nom_produit"]) ?>:</h2>

            <form class="formulaire_produit" method="post" enctype="multipart/form-data">
                <div class="input-group mb-3">
                    <label class="input-group-text" for="inputGroupFile01">IMAGE</label>
                    <input class="form-control " type="file" id="image_produit" name="image_produit" value="image">
                    <input type="hidden" name="image_produit_current" value="<?= htmlspecialchars($user["image_produit"]) ?>">
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="nom_produit" placeholder="NOM" name="nom_produit" value="<?= htmlspecialchars($user["nom_produit"]) ?>" required>
                    <label for="floatingInput">NOM</label>
                </div>
                <div class="form-floating">
                    <select class="form-select" aria-label="Floating label select example" id="genre" name="genre" required>
                        <option value="<?= htmlspecialchars($user["genre"]) ?>" selected><?= htmlspecialchars($user["genre"]) ?></option>
                        <option value="HOMME">HOMME</option>
                        <option value="FEMME">FEMME</option>
                    </select>
                    <br>
                    <label for="floatingSelect">GENRE</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="reference" placeholder="REFERENCE" name="reference" value="<?= htmlspecialchars($user["reference"]) ?>" required>
                    <label for="floatingInput">REFERENCE</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="marque" placeholder="MARQUE" name="marque" value="<?= htmlspecialchars($user["marque"]) ?>" required>
                    <label for="floatingInput">MARQUE</label>
                </div>
                <div class="form-floating">
                    <select class="form-select" aria-label="Floating label select example" id="categorie_id" name="categorie_id" required>
                        <option value="<?= htmlspecialchars($user["categorie_id"]) ?>" selected><?= htmlspecialchars($user["categorie_id"]) ?></option>
                        <?php
                        require_once("../../connect.php");
                        // Assumez que la connexion à la base de données est déjà établie
                        $sql = "SELECT id, type FROM categories";
                        $query = $db->query($sql);
                        while ($categories = $query->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value=\"{$categories['id']}\">{$categories['type']}</option>";
                        }
                        ?>
                    </select>
                    <label for="floatingSelect">CATEGORIE</label>
                </div>
                <br>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="couleur" placeholder="COULEUR" name="couleur" value="<?= htmlspecialchars($user["couleur"]) ?>" required>
                    <label for="floatingInput">COULEUR</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="matiere" placeholder="MATIERE" name="matiere" value="<?= htmlspecialchars($user["matiere"]) ?>" required>
                    <label for="floatingInput">MATIERE</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="motif" placeholder="MOTIF" name="motif" value="<?= htmlspecialchars($user["motif"]) ?>" required>
                    <label for="floatingInput">MOTIF</label>
                </div>
                <div class="form-floating mb-3">
                    <textarea type="" class="form-control" id="description" placeholder="DESCRIPTION" name="description" required><?= htmlspecialchars($user["description"]) ?></textarea>
                    <label for="floatingInput">DESCRIPTION</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="taille" placeholder="TAILLE" name="taille" value="<?= htmlspecialchars($user["taille"]) ?>" required>
                    <label for="floatingInput">TAILLE</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" placeholder="QUANTITE" id="quantite" name="quantite" value="<?= htmlspecialchars($user["quantite"]) ?>" required min="0">
                    <label for="floatingInput">QUANTITE</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" placeholder="PRIX HT" id="prix_ht" name="prix_ht" value="<?= htmlspecialchars($user["prix_ht"]) ?>" required min="0">
                    <label for="floatingInput">PRIX HT</label>
                </div>
                <input type="hidden" name="id" value="<?= htmlspecialchars($user["id"]) ?>" required>
                <div class="btn_produit"><button type="input" class="btn btn-outline-secondary">MODIFIER</button></div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>