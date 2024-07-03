<?php
session_start();

function escape($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

$panier = isset($_SESSION['panier']) ? $_SESSION['panier'] : [];
$total = 0;

foreach ($panier as $article) {
    $total += $article['prix'] * $article['quantite'];
}
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
            <?php foreach ($panier as $article): ?>
            <div class="recap_panier">
                <div>
                    <img src="<?= escape($article['image']) ?>" width="100px" alt="<?= escape($article['nom']) ?>">
                </div>
                <div class="recap_text">
                    <p><?= escape($article['nom']) ?></p>
                    <p><?= escape($article['prix']) ?>€</p>
                    <p><?= escape($article['couleur']) ?></p>
                    <p><?= escape($article['taille']) ?></p>
                    <p>Quantité : <?= escape($article['quantite']) ?></p>
                </div>
            </div>
            <?php endforeach; ?>
            <?php else: ?>
            <p>Votre panier est vide.</p>
            <?php endif; ?>

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
            // Exemples de produits suggérés, remplacez par une requête réelle si nécessaire
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