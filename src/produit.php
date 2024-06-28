<?php
//lancement de la session
session_start();
?>
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
                    <figcaption>
                        <!-- Accueil /-->
                        <!-- $produit[""] -->
                        <!-- $produit[""] -->
                    </figcaption>
                </figure>
                <div class="container-information-produit">
                    <h1 class="h1-produit-name">Nom du produit</h1>
                    <p class="prix">Prix xx€</p>
                    <p class="text"> Lorem, ipsum dolor sit amet consectetur adipisicing elit. Alias eius laboriosam
                        odit ipsa nihil reiciendis itaque tempora earum explicabo expedita nobis provident, ex
                        consequuntur magni blanditiis exercitationem, similique soluta natus!
                        <!--$produit["description"]-->
                    </p>
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

            <!-- affichage des produit simimlaire avec un foreach (qui se break après 4 produit afficher) -->

            <?php 
                // $count = 0;
                // foreach ($result as $???):
                // if ($count >= 4) break;
            ?>

            <article class="vetement-similaire">
                <figure class="vetement-similaire-figure">
                    <a href="#"><img src="img/exemple_produit.jpg" alt="exemple produit"></a>
                    <figcaption class="vetement-similaire-titre"> nom du produit</figcaption>
                </figure>
                <p class="vetement-similaire-couleur">2 couleurs</p>
                <p class="vetement-similaire-prix">Prix xx€</p>
            </article>

            <?php 
                // $count++;
                // endforeach; 
            ?>

            <!----- A supprimer plus tard, cela sert juste d'exemple ----->
            <article class="vetement-similaire">
                <figure class="vetement-similaire-figure">
                    <a href="#"><img src="img/exemple_produit.jpg" alt="exemple produit"></a>
                    <figcaption class="vetement-similaire-titre"> nom du produit</figcaption>
                </figure>
                <p class="vetement-similaire-couleur">2 couleurs</p>
                <p class="vetement-similaire-prix">Prix xx€</p>
            </article>
            <article class="vetement-similaire">
                <figure class="vetement-similaire-figure">
                    <a href="#"><img src="img/exemple_produit.jpg" alt="exemple produit"></a>
                    <figcaption class="vetement-similaire-titre"> nom du produit</figcaption>
                </figure>
                <p class="vetement-similaire-couleur">2 couleurs</p>
                <p class="vetement-similaire-prix">Prix xx€</p>
            </article>
            <article class="vetement-similaire">
                <figure class="vetement-similaire-figure">
                    <a href="#"><img src="img/exemple_produit.jpg" alt="exemple produit"></a>
                    <figcaption class="vetement-similaire-titre"> nom du produit</figcaption>
                </figure>
                <p class="vetement-similaire-couleur">2 couleurs</p>
                <p class="vetement-similaire-prix">Prix xx€</p>
            </article>
            <!----- A supprimer plus tard, cela sert juste d'exemple ----->

        </div>
    </section>
    <?php include_once("templates/footer.php") ?>

</body>

</html>