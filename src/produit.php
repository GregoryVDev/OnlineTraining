<?php 
session_start();

require_once("connect.php");

if (isset($_GET["id"])) {
    $id_produit = $_GET["id"];

    $sql = "SELECT * FROM produits WHERE id = :id";
    $query = $db->prepare($sql);
    $query->bindValue(':id', $id_produit, PDO::PARAM_INT);
    $query->execute();
    $produit = $query->fetch(PDO::FETCH_ASSOC);

    if (!$produit) {
        $_SESSION["erreur"] = "Vous êtes allé trop loin, aucun produit ne correspond!";
        header("Location: index.php");
        exit();
    }
} else {
    $_SESSION["erreur"] = "La page demandée n'existe pas, veuillez réessayer plus tard";
    header("Location: index.php");
    exit();
}
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
                    <img class="picture-produit" src="<?= $produit["image_produit"] ?>"
                        alt="<?= $produit["nom_produit"] ?>">
                    <figcaption>Accueil / robe / nom de la robe (chemin)</figcaption>
                </figure>
                <div class="container-information-produit">
                    <h1 class="h1-produit-name"><?= $produit["nom_produit"] ?></h1>
                    <p class="prix"><?= $produit["prix_ht"]?></p>
                    <p class="text"><?= $produit["description"]?>
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
                        <p><?= $produit["couleur"]?></p>
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
    <script src="script.js"></script>

</body>

</html>