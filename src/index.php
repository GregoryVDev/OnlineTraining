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
$categories = ['Polo manches longues', 'Polo manches courtes', 'Short', 'Pantalon Chinot', 'Pantalon'];
$nomCategorie = [];


$sql = "SELECT p.*, c.type as categorie_type FROM produits p JOIN categories c ON p.categorie_id = c.id";
$query = $db->prepare($sql);
$query->execute();
$categories = $query->fetchAll(PDO::FETCH_ASSOC);

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

    .wrap {
        width: 400px;
        text-align: left;
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
            <div class="carousel-container">
                <div class="ligne">
                    <?php foreach($news as $new): ?>
                    <div class="carte">
                        <a href="produits.php?id=<?=$new["id"]?>">
                            <img src="<?=$new['image_produit']?>" height="500px" alt="<?=$new['nom_produit']?>">
                        </a>
                    </div>
                    <?php endforeach; ?>
                </div>
                <button class="arrow arrow-right">&#10095;</button>
            </div>
        </div>
    </section>
    <section>
        <div class="categories">
            <?php foreach($categories as $categorie): ?>

            <div class="pad_carte">
                <p><?= $categorie["nom_produit"] ?></p>
                <a href="categories.php?=<?=$categorie["nom_produit"]?>">
                    <img src="<?= $categorie['image_produit'] ?>" height="380px" alt="<?= $categorie['nom_produit'] ?>">
                </a>
                <p>Taille : <?= $categorie["taille"] ?></p>
                <p>Prix : <?= $categorie["prix_ht"] ?> €</p>
            </div>

            <?php endforeach; ?>
        </div>

        </div>
    </section>

    <?php include('./templates/footer.php');

    ?>
    <a href="./dashboard/produits/dashboard_produits.php">DASHBOARD</a>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const ligne = document.querySelector('.ligne');
        let cards = Array.from(document.querySelectorAll(
        '.carte')); // Convertir en tableau pour faciliter la manipulation
        const leftArrow = document.querySelector('.arrow-left');
        const rightArrow = document.querySelector('.arrow-right');
        let index = 1; // Commence à 1 pour que le premier affiché soit l'original
        const cardWidth = cards[0].clientWidth + 20; // 20 est la marge droite

        // Clone le premier et le dernier élément pour un effet de boucle infini
        const firstClone = cards[0].cloneNode(true);
        const lastClone = cards[cards.length - 1].cloneNode(true);

        ligne.appendChild(firstClone);
        ligne.insertBefore(lastClone, cards[0]);

        // Met à jour la liste des cartes après clonage
        cards = Array.from(document.querySelectorAll('.carte'));

        function showNextImage() {
            index++;
            updateCarousel();
        }

        function showPreviousImage() {
            index--;
            updateCarousel();
        }

        function updateCarousel() {
            ligne.style.transition = 'transform 0.5s ease-in-out';
            const translateX = -index * cardWidth;
            ligne.style.transform = `translateX(${translateX}px)`;

            // Gère le bouclage infini
            if (index === cards.length - 1) {
                setTimeout(() => {
                    ligne.style.transition = 'none';
                    index = 1; // Réinitialiser à l'élément original
                    ligne.style.transform = `translateX(${-index * cardWidth}px)`;
                }, 500);
            } else if (index === 0) {
                setTimeout(() => {
                    ligne.style.transition = 'none';
                    index = cards.length - 2; // Réinitialiser à l'avant-dernier élément
                    ligne.style.transform = `translateX(${-index * cardWidth}px)`;
                }, 500);
            }
        }

        leftArrow.addEventListener('click', showPreviousImage);
        rightArrow.addEventListener('click', showNextImage);

        setInterval(showNextImage, 5200);
    });
    </script>
</body>

</html>