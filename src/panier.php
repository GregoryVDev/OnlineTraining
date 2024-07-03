<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/navBar.css">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="stylesheet" href="./css/panier/panier.css">

    <title>Document</title>

</head>

<body>
    <?php
    include ('./templates/header01.php');
?>

    <div class="cadre">
        <div class="panier">
            <h2 class="text_rouge01">Mon panier</h2>
            <div class="recap_panier">
                <div>
                    <img src="./img/produits/eItuMBaBT5SMsSakOdzP.jpg" width="100px" alt="">
                </div>
                <div class="recap_text">
                    <p>PANTALON</p>
                    <p>prix</p>
                    <p>matière</p>
                    <p>taille</p>
                </div>
            </div>

            <div class="details_panier">
                <div class="total_cde">
                    <p>TOTAL DE MA COMMANDE</p>
                    <p class="price">prix</p>
                </div>
                <div class="commande">
                    <input class="cde" type="submit" value="COMMANDER"></input>
                </div>
            </div>
        </div>
    </div>

    <div class="aussi">
        <h3 class="text_rouge">Vous aimerez aussi</h3>

        <div class="meme_categorie">
            <div><img src="./img/produits/eItuMBaBT5SMsSakOdzP.jpg" width="220px" alt="">
                <p>Nom</p>
            </div>
            <div><img src="./img/produits/eItuMBaBT5SMsSakOdzP.jpg" width="220px" alt="">
                <p>Nom</p>
            </div>
            <div><img src="./img/produits/eItuMBaBT5SMsSakOdzP.jpg" width="220px" alt="">
                <p>Nom</p>
            </div>
            <div><img src="./img/produits/eItuMBaBT5SMsSakOdzP.jpg" width="220px" alt="">
                <p>Nom</p>
            </div>
        </div>
    </div>

</body>

</html>

<?php
 include ('./templates/footer.php');
?>