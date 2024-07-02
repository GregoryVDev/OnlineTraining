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
        border-radius: 10px;
    }

    .description_panier,
    div.details_panier,
    .commande {
        padding: 20px;
    }

    .description_panier {
        display: flex;
        width: 90%;
        margin: 0 auto;
        gap: 10%;
    }

    p:first-child,
    p:last-child {
        margin-top: 0;
    }

    p:first-child {
        font-weight: bold;
    }

    div.details_panier {
        border-top: 2px solid red;
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

    .cde {
        background-color: #D31E44;
        border: none;
        border-radius: 5px;
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
            <div>
                <img src="./img/produits/eItuMBaBT5SMsSakOdzP.jpg" width="100px" alt="">
            </div>
            <div>
                <p>PANTALON</p>
                <p class="price">prix</p>
                <p>matière</p>
                <p>taille</p>
            </div>
        </div>
        <div class="details_panier">
            <div>
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
            <p>Voir les détails du panier</p>
        </div>
    </div>


</body>

</html>