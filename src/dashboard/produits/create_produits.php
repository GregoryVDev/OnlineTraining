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
                $image_produit = __DIR__ . '/../../img/produits/' . $newFileName;

                if (move_uploaded_file($_FILES['image_produit']['tmp_name'], $image_produit)) {
                    $sql = "INSERT INTO produits (image_produit, nom_produit, genre, reference, marque, categorie_id, couleur, matiere, motif, description, taille, quantite, prix_ht)
                        VALUES (:image_produit, :nom_produit, :genre, :reference, :marque, :categorie_id, :couleur, :matiere, :motif, :description, :taille, :quantite, :prix_ht)";

                    $query = $db->prepare($sql);
                    $query->bindValue(":image_produit", 'img/produits/' . $newFileName);
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
    <link rel="stylesheet" href="style.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Formulaire Produits</title>
</head>

<body>
    <?php
    include '../../templates/navbar_dashboard.php';
    ?>
    <br>
    <br>
    <div class="">
        <div class="">
            <h1>AJOUTER UN PRODUIT: </h1>
            <form method="post" enctype="multipart/form-data">
                <input class="form-control " type="file" id="image_produit" name="image_produit" value="image">
                <input class="form-control" type="text" placeholder="NOM" aria-label=".form-control-sm example" id="nom_produit" name="nom_produit" required>
                <select class="form-select" aria-label="Default select example" id="genre" name="genre" required>
                    <option selected>GENRE</option>
                    <option value="homme">homme</option>
                    <option value="Femme">Femme</option>
                </select>
                <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="REFERENCE" id="reference" name="reference" required>
                <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="MARQUE" id="marque" name="marque" required>
                <select class="form-select" aria-label="Default select example" id="categorie_id" name="categorie_id" required>
                    <option value="">CATEGORIE</option>
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
                <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="COULEUR" id="couleur" name="couleur" required>
                <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="MATIERE" id="matiere" name="matiere" required>
                <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="MOTIF" id="motif" name="motif" required>
                <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="DESCRIPTION" id="description" name="description" required>
                <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="TAILLE" id="taille" name="taille" required>
                <input type="number" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="QUANTITE" id="quantite" name="quantite" required min="0">
                <input type="number" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="PRIX HT" id="prix_ht" name="prix_ht" required min="0">

                <br>
                <button type="input" class="btn btn-outline-secondary">Ajouter</button>
            </form>

            <br>
            <a href="./dashboard_produits.php"><button type="button" class="btn btn-outline-secondary">Retour</button></a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>