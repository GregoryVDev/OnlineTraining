<?php
// On démarre une session 
session_start();

// Variable de contrôle pour vérifier si le formulaire a été soumis
$formSubmitted = false;

// Fonction pour générer une chaîne de caractères aléatoire PAR ROBERTO
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

// Vérification des champs du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formSubmitted = true;

    if (
        isset($_FILES["image_produit"]) && $_FILES["image_produit"]["error"] === 0
        && isset($_POST["alt"]) && !empty($_POST["alt"])
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
        require_once("../../connect.php");

        if ($db) {
            $alt = htmlspecialchars($_POST["alt"]);
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

            // Gestion du fichier uploadé
            $uploadDir = '../../img/produits/';
            $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');
            $imageFileType = strtolower(pathinfo($_FILES['image_produit']['name'], PATHINFO_EXTENSION));

            if (in_array($imageFileType, $allowedTypes)) {
                $newFileName = generateRandomString(20) . '.' . $imageFileType;
                $image_produit = 'img/produits/' . $newFileName;

                if (move_uploaded_file($_FILES['image_produit']['tmp_name'], $image_produit)) {
                    $sql = "INSERT INTO produits (image_produit, alt, nom_produit, genre, reference, marque, categorie_id, couleur, matiere, motif, description, taille, quantite, prix_ht)
                        VALUES (:image_produit, :alt, :nom_produit, :genre, :reference, :marque, :categorie_id, :couleur, :matiere, :motif, :description, :taille, :quantite, :prix_ht)";

                    $query = $db->prepare($sql);
                    $query->bindValue(":image_produit", $image_produit);
                    $query->bindValue(":alt", $alt);
                    $query->bindValue(":nom_produit", $nom_produit);
                    $query->bindValue(":genre", $genre);
                    $query->bindValue(":reference", $reference);
                    $query->bindValue(":marque", $marque);
                    $query->bindValue(":categorie_id", $categorie_id);
                    $query->bindValue(":couleur", $couleur);
                    $query->bindValue(":matiere", $matiere);
                    $query->bindValue(":motif", $motif);
                    $query->bindValue(":description", $description);
                    $query->bindValue(":taille", $taille);
                    $query->bindValue(":quantite", $quantite);
                    $query->bindValue(":prix_ht", $prix_ht);

                    $query->execute();

                    $_SESSION["message"] = "Article ajouté";
                    header("Location: dashboard_produits.php");
                    exit;
                } else {
                    echo "Erreur lors du téléchargement du fichier.";
                }
            } else {
                throw new Exception("Format de l'image non autorisé.");
            }
        } else {
            echo "Erreur de connexion à la base de données.";
        }
    } else {
        if ($formSubmitted) {
            echo "Veuillez remplir TOUS les formulaires !";
        }
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
    <title>Formulaire Produits</title>
</head>

<body>
    <?php
    include '../../templates/navbar_dashboard.php';
    ?>
    <div class="conteneur_login">
        <div class="conteneur_form_form">
            <h1>AJOUTER UN PRODUIT: </h1>
            <form method="post" enctype="multipart/form-data">

                <label for="image_produit">Image:</label>
                <input type="file" id="image_produit" name="image_produit" value="">
                <br>
                <label for="alt">Description de l'image:</label>
                <input type="text" id="alt" name="alt" required>
                <br>
                <label for="nom_produit">Nom:</label>
                <input type="text" id="nom_produit" name="nom_produit" required>
                <br>
                <label for="genre">Genre:</label>
                <select id="genre" name="genre" required>
                    <option value="">Sélectionnez un Genre</option>
                    <option value="Homme">Homme</option>
                    <option value="Femme">Femme</option>
                </select>
                <br>
                <label for="reference">Référence:</label>
                <input type="text" id="reference" name="reference" required>
                <br>
                <label for="marque">Marque:</label>
                <input type="text" id="marque" name="marque" required>
                <br>
                <label for="categorie_id">Catégorie:</label>
                <select id="categorie_id" name="categorie_id" required>
                    <option value="">Sélectionnez une catégorie</option>
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
                <br>
                <label for="couleur">Couleur:</label>
                <input type="text" id="couleur" name="couleur" required>
                <br>
                <label for="matiere">Matière:</label>
                <input type="text" id="matiere" name="matiere" required>
                <br>
                <label for="motif">Motif:</label>
                <input type="text" id="motif" name="motif" required>
                <br>
                <label for="description">Description:</label>
                <input type="text" id="description" name="description" required>
                <br>
                <label for="taille">Taille:</label>
                <input type="text" id="taille" name="taille" required>
                <br>
                <label for="quantite">Quantité:</label>
                <input type="number" id="quantite" name="quantite" required min="0">
                <br>
                <label for="prix_ht">Prix HT:</label>
                <input type="number" id="prix_ht" name="prix_ht" required min="0">
                <br>
                <br>
                <button type="submit" class="login-btn">Ajouter</button>
            </form>

            <br>
            <button class="login-btn"><a href="./dashboard_produits.php">Retour</a></button>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>