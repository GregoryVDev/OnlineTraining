<?php
// On démarre une session 
session_start();
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
if (
    isset($_FILES["image_produit"]) && $_FILES["image_produit"]["error"] === 0
    && isset($_POST["alt"]) && !empty($_POST["alt"])
    && isset($_POST["genre"]) && !empty($_POST["genre"])
    && isset($_POST["reference"]) && !empty($_POST["reference"])
    && isset($_POST["marque"]) && !empty($_POST["marque"])
    && isset($_POST["categorie_id"]) && !empty($_POST["categorie_id"])
    && isset($_POST["couleur"]) && !empty($_POST["couleur"])
    && isset($_POST["matiere"]) && !empty($_POST["matiere"])
    && isset($_POST["motif"]) && !empty($_POST["motif"])
    && isset($_POST["description"]) && !empty($_POST["description"])
    && isset($_POST["quantite"]) && !empty($_POST["quantite"])
    && isset($_POST["prix_ht"]) && !empty($_POST["prix_ht"])


) {
    require_once("../../connect.php");

    if ($db) {

        $alt = htmlspecialchars($_POST["alt"]);
        $genre = htmlspecialchars($_POST["genre"]);
        $reference = htmlspecialchars($_POST["reference"]);
        $marque = htmlspecialchars($_POST["marque"]);
        $categorie_id = htmlspecialchars($_POST["categorie_id"]);
        $couleur = htmlspecialchars($_POST["couleur"]);
        $matiere = htmlspecialchars($_POST["matiere"]);
        $motif = htmlspecialchars($_POST["motif"]);
        $description = htmlspecialchars($_POST["description"]);
        $quantite = htmlspecialchars($_POST["quantite"]);
        $prix_ht = htmlspecialchars($_POST["prix_ht"]);


        // Gestion du fichier uploadé
        $uploadDir = '../../img/produits/';
        $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');
        $imageFileType = strtolower(pathinfo($_FILES['image_produit']['name'], PATHINFO_EXTENSION));

        if (in_array($imageFileType, $allowedTypes)) {
            $newFileName = generateRandomString(20) . '.' . $imageFileType;
            $image_produit = $uploadDir . $newFileName;

            if (move_uploaded_file($_FILES['image_produit']['tmp_name'], $image_produit)) {
                $sql = "INSERT INTO produits (image_produit, alt, genre, reference, marque, categorie_id, couleur, matiere, motif, description, quantite, prix_ht)
                    VALUES (:image_produit, :alt, :genre, :reference, :marque, :categorie_id, :couleur, :matiere, :motif, :description, :quantite, :prix_ht)";

                $query = $db->prepare($sql);
                $query->bindValue(":image_produit", $image_produit);
                $query->bindValue(":alt", $alt);
                $query->bindValue(":genre", $genre);
                $query->bindValue(":reference", $reference);
                $query->bindValue(":marque", $marque);
                $query->bindValue(":categorie_id", $categorie_id);
                $query->bindValue(":couleur", $couleur);
                $query->bindValue(":matiere", $matiere);
                $query->bindValue(":motif", $motif);
                $query->bindValue(":description", $description);
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
    echo "Veuillez remplir TOUS les formulaires !";
}
