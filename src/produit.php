<!DOCTYPE html>
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
                    <figcaption>Accueil / robe / nom de la robe (chemin)</figcaption>
                </figure>
                <div class="container-information-produit">
                    <h1 class="h1-produit-name">Nom du produit</h1>
                    <p class="prix">Prix xx€</p>
                    <p class="text">Lorem ipsum, dolor sit amet consectetur
                        adipisicing elit. Amet
                        ratione nesciunt suscipit
                        deserunt hic asperiores cum quos rem, maxime nisi odio obcaecati, natus animi ex dolore debitis
                        nulla soluta eaque</p>
                    <div class="taille">
                        <p>Taille</p>
                        <select name="taille" id="taille">
                            <option value="">Séléctionnez votre taille</option>
                            <option value="XS">XS</option>
                            <option value="S">S</option>
                            <option value="M">M</option>
                            <option value="L">L</option>
                            <option value="XL">XL</option>
                        </select>
                    </div>
                    <div class="couleur">
                        <p>Couleur</p>
                        <select name="taille" id="taille">
                            <option value="">Séléctionnez votre couleur</option>
                            <option value="bleu">bleu</option>
                            <option value="blanc">blanc</option>
                            <option value="rouge">rouge</option>
                        </select>
                    </div>
                    <button class="btn-produit" type="submit">Ajouter au panier</button>
                </div>
            </article>
        </main>
    </section>
    <section class="section2">
        <h2 class="h2-section2-titre">Vous pourriez aimer cela aussi</h2>
        <div class="container-produit-similaire">
            <?php 
                $count = 0;
                foreach ($result as $game):
                if ($count >= 12) break;
            ?>
            <article class="vetement-similaire">
                <figure class="vetement-similaire-figure">
                    <a href="#"><img src="img/exemple_produit.jpg" alt="exemple produit"></a>
                    <img class="panier" src="img/panier.png" alt="panier">
                    <figcaption class="vetement-similaire-titre"> nom du produit</figcaption>
                </figure>
                <p class="vetement-similaire-couleur">2 couleurs</p>
                <p class="vetement-similaire-prix">Prix xx€</p>
            </article>
            <?php 
                $count++;
                endforeach; 
            ?>
            <article class="vetement-similaire">
                <figure class="vetement-similaire-figure">
                    <a href="#"><img src="img/exemple_produit.jpg" alt="exemple produit"></a>
                    <img class="panier" src="img/panier.png" alt="panier">
                    <figcaption class="vetement-similaire-titre"> nom du produit</figcaption>
                </figure>
                <p class="vetement-similaire-couleur">2 couleurs</p>
                <p class="vetement-similaire-prix">Prix xx€</p>
            </article>
            <article class="vetement-similaire">
                <figure class="vetement-similaire-figure">
                    <a href="#"><img src="img/exemple_produit.jpg" alt="exemple produit"></a>
                    <img class="panier" src="img/panier.png" alt="panier">
                    <figcaption class="vetement-similaire-titre"> nom du produit</figcaption>
                </figure>
                <p class="vetement-similaire-couleur">2 couleurs</p>
                <p class="vetement-similaire-prix">Prix xx€</p>
            </article>
            <article class="vetement-similaire">
                <figure class="vetement-similaire-figure">
                    <a href="#"><img src="img/exemple_produit.jpg" alt="exemple produit"></a>
                    <img class="panier" src="img/panier.png" alt="panier">
                    <figcaption class="vetement-similaire-titre"> nom du produit</figcaption>
                </figure>
                <p class="vetement-similaire-couleur">2 couleurs</p>
                <p class="vetement-similaire-prix">Prix xx€</p>
            </article>
        </div>
    </section>
    <?php include_once("templates/footer.php") ?>

</body>

</html>