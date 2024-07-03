<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    body {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: sans-serif;
        font-size: 0.8rem;
    }

    .menu_panier {
        width: 300px;
        height: 350px;
        border-top: 4px solid #D31E44;
    }

    .description_panier {
        display: flex;
        width: 90%;
        margin: 20px auto;
        gap: 10%;
    }

    div.image_panier img {
        width: 80px;
    }

    div.text_description p {
        text-align: left;
        margin: 0;
    }

    div.details_panier_rouge {
        border-top: 4px solid #D31E44;
        margin-top: 10px;
    }

    .cde_details p,
    .total_commande p {
        margin: 10px 15px;
    }

    .valeur_commande,
    .total_commande {
        display: flex;
        justify-content: space-between;
    }

    .commande p {
        text-align: center;
        cursor: pointer;
        text-decoration: underline;
    }

    .price {
        color: #D31E44;
    }

    .commande input.cde {
        background-color: #D31E44;
        border: none;
        width: 100%;
        padding: 15px;
        color: white;
        font-weight: bold;
        font-size: 1rem;
        margin-bottom: 4%;
    }
    </style>
</head>

<body>
    <div class="menu_panier">
        <div class="description_panier">
            <div class="image_panier">
                <img src="./img/produits/eItuMBaBT5SMsSakOdzP.jpg" alt="">
            </div>
            <div class="text_description">
                <p>PANTALON</p>
                <p class="price">prix</p>
                <p>matière</p>
                <p>taille</p>
            </div>
        </div>
        <div class="details_panier_rouge">
            <div class="cde_details">
                <p>MA COMMANDE EN DETAILS</p>
                <div class="valeur_commande">
                    <p>Valeur de ma commande</p>
                    <p class="price">prix</p>
                </div>
            </div>
            <div class="total_commande">
                <p>TOTAL DE MA COMMANDE</p>
                <p class="price">prix</p>
            </div>
        </div>
        <div class="commande">
            <input class="cde" type="submit" value="COMMANDER">
            <p><a href="panier.php">Voir les détails du panier</a></p>
        </div>
    </div>


</body>

</html>