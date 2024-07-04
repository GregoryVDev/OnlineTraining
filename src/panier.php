<?php
session_start();

require('connect.php');

function escape($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

// Vérifier si le panier est dans la session
if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}

$panier = $_SESSION['panier'];
$total = 0;

// Calculer le total du panier
foreach ($panier as $produit) {
    $total += $produit['prix_ht'] * $produit['quantite'];
}

include('./templates/requete_navbar_menu_catalogue.php');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/navBar.css">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="stylesheet" href="./css/panier/panier.css">
    <title>Mon panier</title>
</head>

<body>
    <?php include('./templates/header.php'); ?>

    <div class="cadre">
        <div class="panier">
            <h2 class="text_rouge01">Mon panier</h2>

            <?php if (count($panier) > 0): ?>
            <?php foreach ($panier as $produit): ?>
            <div class="recap_panier">
                <div class="produit_colonne">
                    <div>
                        <img src="<?= escape($produit['image_produit']) ?>" width="100px"
                            alt="<?= escape($produit['nom_produit']) ?>">
                    </div>
                    <div class="recap_text">
                        <p><?= escape($produit['nom_produit']) ?></p>
                        <p><?= escape($produit['prix_ht']) ?> €</p>
                        <p><?= escape($produit['couleur']) ?></p>
                        <p><?= escape($produit['taille']) ?></p>
                        <p>Quantité : <?= escape($produit['quantite']) ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            <?php else: ?>
            <p>Votre panier est vide.</p>
            <?php endif; ?>
        </div>
        <div class="details_panier">
            <div class="total_cde">
                <p>TOTAL DE MA COMMANDE</p>
                <p class="price"><?= escape($total) ?>€</p>
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
            <?php
            $produits_suggeres = [
                ['image' => './img/produits/eItuMBaBT5SMsSakOdzP.jpg', 'nom' => 'Produit 1'],
                ['image' => './img/produits/eItuMBaBT5SMsSakOdzP.jpg', 'nom' => 'Produit 2'],
                ['image' => './img/produits/eItuMBaBT5SMsSakOdzP.jpg', 'nom' => 'Produit 3'],
                ['image' => './img/produits/eItuMBaBT5SMsSakOdzP.jpg', 'nom' => 'Produit 4'],
            ];

            foreach ($produits_suggeres as $produit): ?>
            <div>
                <img src="<?= escape($produit['image']) ?>" width="220px" alt="<?= escape($produit['nom']) ?>">
                <p><?= escape($produit['nom']) ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <?php include('./templates/footer.php'); ?>
</body>

</html>