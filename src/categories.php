<?php
// Démarrage de la session et connexion à la base de données
session_start();
require_once("connect.php");

// Initialisation des variables
$produits = [];
$categories_type = "";

// Vérification si le type de catégorie est défini dans l'URL
if (isset($_GET['categories_type'])) {
    $categories_type = urldecode($_GET['categories_type']);

    // Préparation de la requête SQL pour récupérer les produits par type de catégorie
    $sql = "SELECT p.*, c.type as categorie_type 
            FROM produits p 
            JOIN categories c ON p.categorie_id = c.id 
            WHERE c.type = :categories_type
            ORDER BY p.id DESC";

    $query = $db->prepare($sql);
    $query->bindValue(':categories_type', $categories_type, PDO::PARAM_STR);
    $query->execute();
    $produits = $query->fetchAll(PDO::FETCH_ASSOC);

// Redirection si aucun produit trouvé
if (!$produits) {
    $_SESSION["erreur"] = "Vous êtes allés trop loin, aucun produit ne correspond!";
    header("Location: index.php");
    exit();
}

} else {
    header("Location: index.php");
    exit();
}

// Requête pour récupérer toutes les catégories pour la barre de navigation
$sql_categories = "SELECT * FROM categories";
$query_categories = $db->prepare($sql_categories);
$query_categories->execute();
$catalogue_type = $query_categories->fetchAll(PDO::FETCH_ASSOC);

?>

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
    <?php include_once("templates/header.php"); ?>
    <main>
        <div class="background-titre-categories">
            <h1 class="categories-titre">
                <a class="h1-categories-accueil" href="index.php">Accueil</a> / <?= ($categories_type) ?>
            </h1>
        </div>
        <div class="container-categories-vetement">

            <!-- Boucle pour afficher les produits -->
            <?php foreach ($produits as $produit): ?>
            <article class="categories-vetement">
                <figure class="vetement-similaire-figure">
                    <a href="produit.php?id=<?= $produit["id"] ?>">
                        <img class="img-produit" src="<?= ($produit["image_produit"]) ?>"
                            alt="<?= ($produit["nom_produit"]) ?>">
                    </a>
                </figure>
                <p class="vetement-similaire-titre"><?= ($produit["nom_produit"]) ?></p>
                <p class="vetement-similaire-prix">Prix <?= ($produit["prix_ht"]) ?>€</p>
            </article>
            <?php endforeach; ?>

        </div>

    </main>
    <?php include_once("templates/footer.php"); ?>
    <script src="/js/script.js"></script>
</body>

</html>