<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produit</title>
    <link rel="stylesheet" href="css/produits/responsive-produits.css">
    <link rel="stylesheet" href="css/produits/produits.css">
    <!-- <link rel="stylesheet" href="css/navBar.css"> -->
</head>

<body>
    <?php include_once("templates/header.php") ?>
    <section>
        <main>
            <article class="container-produit">
                <figure>
                    <img class="picture-produit" src="img/exemple_produit.jpg" alt="exemple produit">
                </figure>
                <div class="container-information-produit">
                    <p class="chemin">Accueil / robe / nom de la robe (chemin)</p>
                    <h1>Nom du produit</h1>
                    <p class="center">Prix xx€</p>
                    <p class="description-produit center margin-left">Lorem ipsum, dolor sit amet consectetur
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
        <h2>Vous pourriez aimer cela aussi</h2>
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
    <!-- include_once("template/footer.php") -->
</body>

</html>