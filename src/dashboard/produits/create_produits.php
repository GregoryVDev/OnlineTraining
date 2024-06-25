<?php
// On demarre une session 
session_start();
if (
    isset($_POST["reference"]) && !empty($_POST["reference"])
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
    require_once("../../connect.php");

    if ($db) {
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

        $sql = "INSERT INTO produits (reference, marque, categorie_id, couleur, matiere, motif, description, image_produit, alt, quantite, prix_ht)
            VALUES (:reference, :marque, :categorie_id, :couleur, :matiere, :motif, :description, :image_produit, :alt, :quantite, :prix_ht)";

        $query = $db->prepare($sql);
        $query->bindValue(":reference", $reference);
        $query->bindValue(":marque", $marque);
        $query->bindValue(":categorie_id", $categorie_id);
        $query->bindValue(":couleur", $couleur);
        $query->bindValue(":matiere", $matiere);
        $query->bindValue(":motif", $motif);
        $query->bindValue(":description", $description);
        $query->bindValue(":image_produit", $image_produit);
        $query->bindValue(":alt", $alt);
        $query->bindValue(":quantite", $quantite);
        $query->bindValue(":prix_ht", $prix_ht);

        $query->execute();

        $_SESSION["message"] = "Article ajouté";
        header("Location: ./dashboard_produits.php");
        exit;
    } else {
        echo "Erreur de connexion à la base de données.";
    }
} else {
    echo "Veuillez remplir TOUS les formulaires !";
}
