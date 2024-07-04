<?php
// Lancement de la session
session_start();

require_once('connect.php');

// Récupérer les nouveautés
$sql = "SELECT * FROM `produits` WHERE `id` > '0'";
$query = $db->prepare($sql);
$query->execute();
$news = $query->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les catégories et un produit par catégorie
$sql = "SELECT p.*, c.type as categorie_type
        FROM produits p
        JOIN categories c ON p.categorie_id = c.id
        WHERE p.id IN (
            SELECT MIN(p2.id)
            FROM produits p2
            GROUP BY p2.categorie_id
        )";
$query = $db->prepare($sql);
$query->execute();
$categories = $query->fetchAll(PDO::FETCH_ASSOC);

include('./templates/requete_navbar_menu_catalogue.php');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="./css/navBar.css">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="stylesheet" href="./css/fonts/fonts.css">
    <link rel="stylesheet" href="./css/index/index.css">
</head>

<body>
    <?php include('./templates/header.php'); ?>

    <section class="interligne">
        <div class="nouveautes">
            <h2 class="news">NOUVEAUTES</h2>
            <button class="arrow arrow-left">&#10094;</button>
            <div class="carousel-container">
                <div class="ligne">
                    <?php foreach ($news as $new) : ?>
                    <div class="carte">
                        <a href="produit.php?id=<?= ($new['id']) ?>">
                            <img src="<?= ($new['image_produit']) ?>" alt="<?= ($new['nom_produit']) ?>">
                        </a>
                        <p>Prix : <?= ($new['prix_ht']) ?> €</p>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <button class="arrow arrow-right">&#10095;</button>
        </div>
    </section>
    <section class="interligne">
        <h2 class="news">NOTRE CATALOGUE</h2>
        <div class="categories">
            <?php foreach($categories as $categorie): ?>
            <div class="pad_carte">
                <p><?= ($categorie["categorie_type"]) ?></p>
                <a href="categories.php?categories_type=<?= urlencode($categorie["categorie_type"]) ?>">
                    <img src="<?= ($categorie['image_produit']) ?>" height="380px"
                        alt="<?= ($categorie['nom_produit']) ?>">
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

    <?php include('./templates/footer.php'); ?>

    <script src="./js/script.js"></script>
</body>

</html>