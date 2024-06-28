<?php
session_start();

require_once('connect.php');

// Requête pour récupérer les produits
$sql = 'SELECT * FROM produits';
$query = $pdo->query($sql);
$query->execute();
$produits = $query->fetch(PDO::FETCH_ASSOC);
?>

<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produit</title>
    <link rel="stylesheet" href="css/produits/responsive-produits.css">
    <link rel="stylesheet" href="css/produits/produits.css">
    <link rel="stylesheet" href="css/navBar.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/fonts/fonts.css">
</head>

<body>
    <?php include_once("templates/header.php") ?>
    <section>
        <main>
            <article class="container-produit">
                <figure class="order">
                    <img class="picture-produit" src="img/exemple_produit.jpg" alt="exemple produit">
                    <figcaption>Accueil / <?= htmlspecialchars($produit['nom_produit']); ?> / nom de la robe (chemin)
                    </figcaption>
                    <figcaption>
                        <!-- Accueil /-->
                        <!-- $produit[""] -->
                        <!-- $produit[""] -->
                    </figcaption>
                </figure>

                <?php for ($produits as $produit): ?>
                <div class="card">
                    <h2><?= htmlspecialchars($produit['nom_produit']); ?></h2>
                    <p><?= htmlspecialchars($produit['description']); ?></p>
                    <p><?= htmlspecialchars($produit['taille']); ?></p>
                    <p><?= htmlspecialchars($produit['prix_ht']); ?></p>
                    <form method="post" action="panier.php">
                        <input type="hidden" name="produit_id" value="<?php echo $produit['id']; ?>">
                        <button type="submit">Ajouter au panier</button>
                    </form>
                </div>
                <?php endfor; ?>
</body>

</html>