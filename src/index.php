<?php
//lancement de la session
session_start();

require_once('connect.php');

// Récupérer les nouveautés
$sql = "SELECT * FROM `produits` WHERE `id` > '0'";
$query = $db->prepare($sql);
$query->execute();
$news = $query->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les noms de table categories
//$categories = ['Polo manches longues', 'Polo manches courtes', 'Short', 'Pantalon Chinot', 'Pantalon'];



$sql = "SELECT * FROM `produits`";
$query = $db->prepare($sql);
$query->execute();
$categories = $query->fetch(PDO::FETCH_ASSOC);

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
    <style>
    html {
        overflow: -moz-scrollbars-none;
        /* Firefox */
    }

    html::-webkit-scrollbar {
        display: none;
        /* Safari and Chrome */
    }

    .wrap h2:first-of-type {
        margin: 5% 0%;
    }

    .nouveautes {
        position: relative;
        width: 100%;
        overflow: hidden;
        margin-bottom: 1%;
    }

    .ligne {
        display: flex;
        transition: transform 0.5s ease-in-out;
    }

    .carte {
        flex: 0 0 auto;
        margin: 0 5px;
    }

    .arrow {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background-color: rgba(255, 255, 255, 0.5);
        border: none;
        padding: 10px;
        cursor: pointer;
        z-index: 2;
    }

    .arrow-left {
        left: 10px;
    }

    .arrow-right {
        right: 10px;
    }

    .categories {
        display: flex;
        justify-content: center;
        gap: 1%;
        margin: 0 auto;
        flex-wrap: wrap;
    }
    </style>
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
                        <img src="<?=$new['image_produit']?>" width="300px" alt="<?=$new['alt']?>">
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
                <h2 class="news"><?= $categorie["nom_produit"] ?></h2>
                <?php if (isset($categorie)): ?>
                <div class="pad_carte">
                    <a href="categories.php?=<?=$categorie["nom_produit"]?>">
                        <img src="<?= $categorie['image_produit'] ?>" alt="<?= $categorie['alt'] ?>">
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

    <script>
    const ligne = document.querySelector('.ligne');
    const cards = document.querySelectorAll('.carte');
    const leftArrow = document.querySelector('.arrow-left');
    const rightArrow = document.querySelector('.arrow-right');
    let index = 0;

    function showNextImage() {
        index++;
        updateCarousel();
    }

    function showPreviousImage() {
        index--;
        updateCarousel();
    }

    function updateCarousel() {
        const translateX = -index * (cards[0].clientWidth + 20);
        ligne.style.transition = 'transform 0.5s ease-in-out';
        ligne.style.transform = `translateX(${translateX}px)`;

        // Looping logic
        if (index >= cards.length / 2) {
            setTimeout(() => {
                ligne.style.transition = 'none';
                index = 0;
                const resetTranslateX = -index * (cards[0].clientWidth + 20);
                ligne.style.transform = `translateX(${resetTranslateX}px)`;
            }, 500);
        } else if (index < 0) {
            setTimeout(() => {
                ligne.style.transition = 'none';
                index = cards.length / 2 - 1;
                const resetTranslateX = -index * (cards[0].clientWidth + 20);
                ligne.style.transform = `translateX(${resetTranslateX}px)`;
            }, 500);
        }
    }

    leftArrow.addEventListener('click', showPreviousImage);
    rightArrow.addEventListener('click', showNextImage);

    setInterval(showNextImage, 5200);
    </script>
</body>

</html>