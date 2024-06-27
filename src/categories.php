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
    <link rel="stylesheet" href="css/fonts/fonts.css">
</head>

<body>
    <?php include_once("templates/header.php") ?>
    <main>
        <h1 class="categories-titre">nom de la categories</h1>
        <p class="chemin">Accueil / robe / (chemin)</p>
        <div class="categories-liste">
            <p class="categories-liste-p">Polo manches longues</p>
            <p class="categories-liste-p">Polo manches courtes</p>
            <p class="categories-liste-p">Short</p>
            <p class="categories-liste-p">Pantalon Chino</p>
            <p class="categories-liste-p">Pantalon</p>
        </div>
        <div class="container-categories-vetement">

            <!-- affichage des produit simimlaire avec un foreach -->
            <?php 
                // foreach ($result as $???):
            ?>

            <article class="categories-vetement">
                <figure class="vetement-similaire-figure">
                    <a href="#"><img src="img/exemple_produit.jpg" alt="exemple produit"></a>
                    <figcaption>nom du produit</figcaption>
                </figure>
                <p class="vetement-similaire-couleur">2 couleurs</p>
                <p class="vetement-similaire-prix">Prix xx€</p>
            </article>

            <?php 
                // endforeach; 
            ?>



            <!----- A supprimer plus tard, cela sert juste d'exemple ----->
            <article class="categories-vetement">
                <figure class="vetement-similaire-figure">
                    <a href="#"><img src="img/exemple_produit.jpg" alt="exemple produit"></a>
                    <figcaption>nom du produit</figcaption>
                </figure>
                <p class="vetement-similaire-couleur">2 couleurs</p>
                <p class="vetement-similaire-prix">Prix xx€</p>
            </article>
            <article class="categories-vetement">
                <figure class="vetement-similaire-figure">
                    <a href="#"><img src="img/exemple_produit.jpg" alt="exemple produit"></a>
                    <figcaption>nom du produit</figcaption>
                </figure>
                <p class="vetement-similaire-couleur">2 couleurs</p>
                <p class="vetement-similaire-prix">Prix xx€</p>
            </article>
            <article class="categories-vetement">
                <figure class="vetement-similaire-figure">
                    <a href="#"><img src="img/exemple_produit.jpg" alt="exemple produit"></a>
                    <figcaption>nom du produit</figcaption>
                </figure>
                <p class="vetement-similaire-couleur">2 couleurs</p>
                <p class="vetement-similaire-prix">Prix xx€</p>
            </article>
            <article class="categories-vetement">
                <figure class="vetement-similaire-figure">
                    <a href="#"><img src="img/exemple_produit.jpg" alt="exemple produit"></a>
                    <figcaption>nom du produit</figcaption>
                </figure>
                <p class="vetement-similaire-couleur">2 couleurs</p>
                <p class="vetement-similaire-prix">Prix xx€</p>
            </article>
            <article class="categories-vetement">
                <figure class="vetement-similaire-figure">
                    <a href="#"><img src="img/exemple_produit.jpg" alt="exemple produit"></a>
                    <figcaption>nom du produit</figcaption>
                </figure>
                <p class="vetement-similaire-couleur">2 couleurs</p>
                <p class="vetement-similaire-prix">Prix xx€</p>
            </article>
            <article class="categories-vetement">
                <figure class="vetement-similaire-figure">
                    <a href="#"><img src="img/exemple_produit.jpg" alt="exemple produit"></a>
                    <figcaption>nom du produit</figcaption>
                </figure>
                <p class="vetement-similaire-couleur">2 couleurs</p>
                <p class="vetement-similaire-prix">Prix xx€</p>
            </article>
            <article class="categories-vetement">
                <figure class="vetement-similaire-figure">
                    <a href="#"><img src="img/exemple_produit.jpg" alt="exemple produit"></a>
                    <figcaption>nom du produit</figcaption>
                </figure>
                <p class="vetement-similaire-couleur">2 couleurs</p>
                <p class="vetement-similaire-prix">Prix xx€</p>
            </article>
            <!----- A supprimer plus tard, cela sert juste d'exemple ----->



        </div>
    </main>
    <?php include_once("templates/footer.php") ?>
</body>

</html>