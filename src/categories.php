<?php
session_start();
require_once("connect.php");

$produits = [];
$categories_type = "";

if (isset($_GET['categories_type'])) {
    $categories_type = urldecode($_GET['categories_type']);

    $sql = "SELECT p.*, c.type as categorie_type 
            FROM produits p 
            JOIN categories c ON p.categorie_id = c.id 
            WHERE c.type = :categories_type";

    $query = $db->prepare($sql);
    $query->bindValue(':categories_type', $categories_type, PDO::PARAM_STR);
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
        <div class="liste-categories">
            <?php foreach ($produits as $vetement): ?>
            <a class="categories-liste-p" href="">test</a>
            <?php endforeach; ?>
        </div>
        <h1 class="categories-titre"><?= ($categories_type) ?></h1>
        <!-- Structure de la page pour afficher les produits -->
        <div class="container-categories-vetement">
            <!-- Debut du foreach pour afficher les produits -->
            <?php foreach ($produits as $vetement): ?>
            <article class="categories-vetement">
                <figure class="vetement-similaire-figure">
                    <a href="produit.php?id=<?= $vetement["id"] ?>"><img src="<?= ($vetement["image_produit"]) ?>"
                            alt="<?= $vetement["nom_produit"]?>"></a>
                    <figcaption><?= ($vetement["categorie_type"]) ?></figcaption>
                </figure>
                <p class="vetement-similaire-couleur"><?= ($vetement["couleur"]) ?></p>
                <p class="vetement-similaire-prix">Prix <?= ($vetement["prix_ht"]) ?>€</p>
            </article>
            <?php endforeach; ?>
        </div>
    </main>
    <?php include_once("templates/footer.php"); ?>
    <script src="script.js"></script>
</body>

</html>