<?php
// Démarrage de la session et connexion à la base de données
session_start();
require_once("connect.php");

// Vérification si le type de catégorie est défini dans l'URL pour récupérer les informations du produit
if (isset($_GET["id"])) {
    $id_produit = $_GET["id"];
    try {
        $sql = "SELECT p.*, c.type AS categorie_type 
                FROM produits p
                JOIN categories c ON p.categorie_id = c.id
                WHERE p.id = :id";
                
        $query = $db->prepare($sql);
        $query->bindValue(':id', $id_produit, PDO::PARAM_INT);
        $query->execute();
        $produit = $query->fetch(PDO::FETCH_ASSOC);

        //message d'erreur et de redirection si l'id est incorecct ou pas trouver
        if (!$produit) {
            $_SESSION["erreur"] = "Vous êtes allés trop loin, aucun produit ne correspond!";
            header("Location: index.php");
            exit();
        }

        
        //Requette pour afficher les produit similaire (maximum 4)
        $sql_similar = "SELECT * FROM produits WHERE categorie_id = :categorie_id AND id != :id ORDER BY id DESC LIMIT 4";
        $query_similar = $db->prepare($sql_similar);
        $query_similar->bindValue(':categorie_id', $produit['categorie_id'], PDO::PARAM_INT);
        $query_similar->bindValue(':id', $id_produit, PDO::PARAM_INT);
        $query_similar->execute();
        $produits_similaires = $query_similar->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}

include('./templates/requete_navbar_menu_catalogue.php');

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
            <p class="chemin-produit"> <a class="chemin-produit chemin-produit-hover" href="index.php">Accueil</a> / <a
                    class="chemin-produit chemin-produit-hover"
                    href="categories.php?categories_type=<?= urlencode($produit["categorie_type"]) ?>"><?= $produit["categorie_type"] ?>
                </a>/
                <span class="color-red-name-produit"><?= ($produit["nom_produit"]) ?></span>
            </p>
            <article class="container-produit">
                <figure class="order">
                    <img class="picture-produit" src="<?= ($produit["image_produit"]) ?>"
                        alt="<?= ($produit["nom_produit"]) ?>">
                </figure>
                <div class="container-information-produit">
                    <h1 class="h1-produit-name"><?= ($produit["nom_produit"]) ?></h1>
                    <p class="prix"><?= ($produit["prix_ht"])?>€</p>
                    <p class="text"><?= (($produit["description"])) ?></p>
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
                        <p><?= ($produit["couleur"]) ?></p>
                        <select name="couleur" id="couleur">
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

            <?php foreach ($produits_similaires as $produit_similaire): ?>
            <article class="vetement-similaire">
                <figure class="vetement-similaire-figure">
                    <a href="produit.php?id=<?= ($produit_similaire["id"]) ?>"><img class="picture-similaire-size"
                            src="<?= ($produit_similaire["image_produit"]) ?>"
                            alt="<?= ($produit_similaire["nom_produit"]) ?>"></a>
                    <figcaption class="vetement-similaire-titre">
                        <?= ($produit_similaire["nom_produit"]) ?></figcaption>
                </figure>
                <p class="vetement-similaire-couleur"><?= ($produit_similaire["couleur"]) ?></p>
                <p class="vetement-similaire-prix"><?= ($produit_similaire["prix_ht"]) ?>€</p>
            </article>
            <?php endforeach; ?>

        </div>
    </section>
    <?php include_once("templates/footer.php") ?>
    <script src="/js/script.js"></script>
</body>

</html>