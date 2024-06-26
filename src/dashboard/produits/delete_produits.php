<?php
// On verifie qu' il ya bien un id dans l'url et que l'utilisateur correspondant existe
// On vérifie qu'il y a bien un id dans l'url et que l'utilisateur correspondant existe
if (isset($_GET["id"]) && !empty($_GET["id"])) {
    require_once("../../connect.php");
    $id = strip_tags($_GET["id"]);

    $sql = "SELECT * FROM produits WHERE id = :id";
    $query = $db->prepare($sql);
    $query->bindValue(":id", $id, PDO::PARAM_INT);
    $query->execute();
    $produits = $query->fetch();

    // Récupération des chemins des images à supprimer
    $image_produit = $produits['image_produit'];

    // Suppression des images si elles existent
    if (!empty($image_produit) && file_exists($image_produit)) {
        if (unlink($image_produit));
    }

    if ($produits) {
        $sql = "DELETE FROM produits WHERE id = :id";
        $query = $db->prepare($sql);
        $query->bindValue(":id", $id, PDO::PARAM_INT);
        $query->execute();
    }

    header("Location: dashboard_produits.php");
} else {
    header("Location: index.php");
}
