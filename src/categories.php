<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
    <link rel="stylesheet" href="css/categories/responsive-categories.css">
    <link rel="stylesheet" href="css/categories/categories.css">
    <link rel="stylesheet" href="css/navBar.css">
    <link rel="stylesheet" href="css/footer.css">
</head>

<body>
    <?php include_once("templates/header.php") ?>
    <section class="section2">
        <h2 class="h2-section2-titre">Vous pourriez aimer cela aussi</h2>
        <div class="container-produit-similaire">
            <article class="vetement-similaire">
                <figure>
                    <a href="#"><img src="img/exemple_produit.jpg" alt="exemple produit"></a>
                </figure>
                <p>Nom du produit</p>
                <p>Prix xx€</p>
            </article>
            <article class="vetement-similaire">
                <figure>
                    <a href="#"><img src="img/exemple_produit.jpg" alt="exemple produit"></a>
                </figure>
                <p>Nom du produit</p>
                <p>Prix xx€</p>
            </article>
            <article class="vetement-similaire">
                <figure>
                    <a href="#"><img src="img/exemple_produit.jpg" alt="exemple produit"></a>
                </figure>
                <p>Nom du produit</p>
                <p>Prix xx€</p>
            </article>
            <article class="vetement-similaire">
                <figure>
                    <a href="#"><img src="img/exemple_produit.jpg" alt="exemple produit"></a>
                </figure>
                <p>Nom du produit</p>
                <p>Prix xx€</p>
            </article>
        </div>
    </section>
    <?php include_once("templates/footer.php") ?>
</body>

</html>