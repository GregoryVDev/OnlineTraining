<?php
require_once('connect.php');

// Récupérer les nouveautés
$sql = "SELECT * FROM `produits` WHERE `id` > '0'";
$query = $db->prepare($sql);
$query->execute();
$news = $query->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les noms de table categories
$categories = ['Robe/Combinaison', 'Top/Tee-Shirt', 'Chemisier/Blouse', 'Jupe/Short', 'Pull/Gilet', 'Pantalon/Legging'];
$noms_categories = [];

foreach ($categories as $categorie) {
    $sql = "SELECT * FROM `produits` WHERE `image_produit` LIKE ? ORDER BY `categories_id` DESC";
    $query = $db->prepare($sql);
    $query->execute([$categorie]);
    $noms_categories[$categorie] = $query->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="./css/navBar.css">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="stylesheet" href="./css/fonts/fonts.css">
    <link rel="stylesheet" href="./css/index/index.css">
</head>

<body>
    <?php

    include('./templates/header.php'); ?>

    <section>
        <div class="nouveautes">
            <h2 class="news">NOUVEAUTES</h2>
            <button class="arrow arrow-left">&#10094;</button>
            <div class="ligne">
                <?php foreach($news as $new): ?>
                <div class="carte">
                    <a href="produits.php?id=<?=$new["id"]?>">
                        <img src="<?=$new['image_produit']?>" alt="<?=$new['alt']?>">
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
            <button class="arrow arrow-right">&#10095;</button>
        </div>
    </section>

    <section>
        <div class="categories">
            <?php foreach($categories as $categorie): ?>
            <div class="wrap">
                <h2 class="news"><?= $categorie ?></h2>
                <?php if (isset($noms_categories[$categorie])): ?>
                <div class="pad_carte">
                    <a href="<?= $categorie ?>.php?id=<?=$noms_categories[$categorie]["id"]?>">
                        <img src="<?=$noms_categories[$categorie]['image_produit'] ?>"
                            alt="<?= $noms_categories[$categorie]['alt'] ?>">
                    </a>
                </div>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

    <?php include('./templates/footer.php');

    ?>
    <a href="./dashboard/produits/dashboard_produits.php">DASHBOARD</a>
</body>

</html>