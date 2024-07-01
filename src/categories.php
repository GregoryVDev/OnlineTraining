<?php
session_start();
require_once("connect.php");

$nom_produit = "";

if (isset($_GET['nom_produit'])) {
    $nom_produit = urldecode($_GET['nom_produit']);

    $sql = "SELECT p.*, c.type as categorie_type 
            FROM produits p 
            JOIN categories c ON p.categorie_id = c.id 
            WHERE p.nom_produit = :nom_produit";

    $query = $db->prepare($sql);
    $query->bindValue(':nom_produit', $nom_produit, PDO::PARAM_STR);
    $query->execute();
    $produits = $query->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
    <link rel="stylesheet" href="css/categories/responsive-categories.css">
    <link rel="stylesheet" href="css/categories/categories.css">
    <link rel="stylesheet" href="css/navBar.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/fonts/fonts.css">
</head>

<body>
    <?php include_once("templates/header.php"); ?>
    <main>
        <h1 class="categories-titre"><?= ($nom_produit) ?></h1>
        <p class="chemin">Accueil / robe / (chemin)</p>
        <div class="categories-liste">
            <p class="categories-liste-p">Polo manches longues</p>
            <p class="categories-liste-p">Polo manches courtes</p>
            <p class="categories-liste-p">Short</p>
            <p class="categories-liste-p">Pantalon Chino</p>
            <p class="categories-liste-p">Pantalon</p>
        </div>
        <div class="container-categories-vetement">
            <?php foreach ($produits as $vetement): ?>
            <article class="categories-vetement">
                <figure class="vetement-similaire-figure">
                    <a href="produit.php?id=<?= $vetement["id"] ?>"><img src="<?= ($vetement["image_produit"]) ?>"
                            alt="exemple produit"></a>
                    <figcaption><?= ($vetement["nom_produit"]) ?></figcaption>
                </figure>
                <p class="vetement-similaire-couleur"><?= ($vetement["couleur"]) ?></p>
                <p class="vetement-similaire-prix">Prix <?= ($vetement["prix_ht"]) ?>€</p>
            </article>
            <?php endforeach; ?>
        </div>
    </main>
    <?php include_once("templates/footer.php"); ?>
</body>

</html>