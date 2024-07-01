<?php
// Lancement de la session
session_start();

require_once('connect.php');

// Récupérer les nouveautés
$sql = "SELECT * FROM `produits` WHERE `id` > '0'";
$query = $db->prepare($sql);
$query->execute();
$news = $query->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les noms de table categories
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
    }

    html::-webkit-scrollbar {
        display: none;
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
        align-items: center;
        justify-content: center;
        transition: transform 0.5s ease-in-out;
    }

    .carte {
        margin: 0 10px;
    }

    .carte img {
        display: block;
        width: 400px;
        height: 550px;
        margin: auto;
        object-fit: cover;
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
    <?php include('./templates/header.php'); ?>

    <section>
        <div class="nouveautes">
            <h2 class="news">NOUVEAUTES</h2>
            <button class="arrow arrow-left">&#10094;</button>
            <div class="carousel-container">
                <div class="ligne">
                    <?php foreach ($news as $new) : ?>
                    <div class="carte">
                        <a href="produit.php?id=<?= $new['id'] ?>">
                            <img src="<?= $new['image_produit'] ?>" alt="<?= $new['nom_produit'] ?>">
                        </a>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <button class="arrow arrow-right">&#10095;</button>
        </div>
    </section>
    <section>
        <h2 class="news">NOTRE CATALOGUE</h2>
        <div class="categories">
            <?php foreach($categories as $categorie): ?>
            <div class="pad_carte">
                <p><?= $categorie["categorie_type"] ?></p>
                <a href="categories.php?categories_type=<?= urlencode($categorie["categorie_type"]) ?>">
                    <img src="<?= $categorie['image_produit'] ?>" height="380px" alt="<?= $categorie['nom_produit'] ?>">
                </a>
                <p>Taille : <?= $categorie["taille"] ?></p>
                <p>Prix : <?= $categorie["prix_ht"] ?> €</p>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

    <?php include('./templates/footer.php'); ?>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const ligne = document.querySelector('.ligne');
        const cards = Array.from(document.querySelectorAll('.carte'));
        const leftArrow = document.querySelector('.arrow-left');
        const rightArrow = document.querySelector('.arrow-right');
        const cardWidth = cards[0].clientWidth + 20; // 20 est la marge droite
        let index = cards.length; // Commence à la fin pour afficher la première série après les clones

        // Clone toutes les cartes et les ajoute à la fin
        cards.forEach(card => {
            const clone = card.cloneNode(true);
            ligne.appendChild(clone);
        });

        // Clone toutes les cartes et les ajoute au début
        [...cards].reverse().forEach(card => {
            const clone = card.cloneNode(true);
            ligne.insertBefore(clone, cards[0]);
        });

        // Ajuster la largeur de la ligne
        ligne.style.width = `${(cards.length * 3) * cardWidth}px`;
        ligne.style.transform = `translateX(${-index * cardWidth}px)`;

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

            ligne.addEventListener('transitionend', handleTransitionEnd);
        }

        function handleTransitionEnd() {
            if (index >= cards.length * 2) { // Quand on atteint les clones à la fin
                ligne.style.transition = 'none';
                index = cards.length; // Réinitialiser à la première série de cartes
                ligne.style.transform = `translateX(${-index * cardWidth}px)`;
            } else if (index < cards.length) { // Quand on atteint les clones au début
                ligne.style.transition = 'none';
                index = cards.length * 2 - 1; // Réinitialiser à la dernière série de cartes
                ligne.style.transform = `translateX(${-index * cardWidth}px)`;
            }
            ligne.removeEventListener('transitionend', handleTransitionEnd);
        }

        leftArrow.addEventListener('click', showPreviousImage);
        rightArrow.addEventListener('click', showNextImage);

        setInterval(showNextImage, 4000); // Un intervalle de 4 secondes pour une meilleure visibilité
    });
    </script>
</body>

</html>