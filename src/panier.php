<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/navBar.css">
    <link rel="stylesheet" href="./css/footer.css">

    <title>Document</title>
    <style>
    body {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: sans-serif;
    }

    h2 {
        text-align: center;
        margin-top: 50px;
    }

    .text_rouge01 {
        color: #D31E44;
        background: white;
        padding: 10px 20px;
        position: absolute;
        top: 7vh;
        left: 35vw;
        margin-top: 50px;
    }

    .text_rouge {
        color: #D31E44;
    }

    .panier {
        display: flex;

        width: 700px;
        border-radius: 10px;
        margin: 0 auto;
        border: 2px solid #D31E44;
        border-radius: 15px;
        height: 200px;
        align-items: center;
        justify-content: space-around;
        margin-top: 50px;
    }


    div.details_panier {
        width: 40%;
    }

    .recap_panier {
        display: flex;
        gap: 10%;
        text-align: left;
    }

    .recap_text p {
        text-align: left;
    }

    p:first-child,
    p:last-child {
        margin-top: 0;
    }

    .price {
        color: #D31E44;
        font-weight: bold;
    }

    p:first-child {
        font-weight: bold;
    }

    .total_commande {
        display: flex;
        justify-content: space-between;
    }

    .details_panier {
        align-items: space-between;
    }

    .cde {
        background-color: #D31E44;
        border: none;
        border-radius: 5px;
        width: 100%;
        color: white;
        font-weight: bold;
        font-size: 1rem;
        margin-top: 30px;

    }

    .aussi {
        display: flex;
        flex-direction: column;
        margin: 5% auto;
        align-items: center;

    }

    .meme_categorie {
        display: flex;
        justify-content: center;
        margin-top: 1%;
        gap: 20px;
        flex-wrap: wrap;
    }
    </style>
</head>

<body>
    <?php
    include ('./templates/header.php');
?>

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
            <div class="total_commande">
                <p>TOTAL DE MA COMMANDE</p>
                <p class="price">prix</p>
            </div>
            <div class="commande">
                <input class="cde" type="submit" value="COMMANDER">
            </div>
        </div>
    </div>

    <div class="aussi">
        <h3 class="text_rouge">Vous aimerez aussi</h3>

        <div class="meme_categorie">
            <div><img src="./img/produits/eItuMBaBT5SMsSakOdzP.jpg" width="220px" alt=""></div>
            <div><img src="./img/produits/eItuMBaBT5SMsSakOdzP.jpg" width="220px" alt=""></div>
            <div><img src="./img/produits/eItuMBaBT5SMsSakOdzP.jpg" width="220px" alt=""></div>
            <div><img src="./img/produits/eItuMBaBT5SMsSakOdzP.jpg" width="220px" alt=""></div>
        </div>
    </div>
</body>

</html>

<?php
 include ('./templates/footer.php');
?>