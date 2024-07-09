<?php
// Démarrage de la session et connexion à la base de données
session_start();
require_once("connect.php");

// Initialisation de $categories_type à null
$categories_type = null;

// Vérification si le type de catégorie ou le genre est défini dans l'URL
if (isset($_GET['categories_type'])) {
    $categories_type = urldecode($_GET['categories_type']);

    // Requête SQL pour récupérer les produits par type de catégorie
    $sql = "SELECT p.*, c.type as categorie_type 
            FROM produits p 
            JOIN categories c ON p.categorie_id = c.id 
            WHERE c.type = :categories_type
            ORDER BY p.id DESC";
    
    // Préparation de la requête SQL
    $query = $db->prepare($sql);
    $query->bindValue(':categories_type', $categories_type, PDO::PARAM_STR);
    $query->execute();
    $produits = $query->fetchAll(PDO::FETCH_ASSOC);

    // Redirection si aucun produit trouvé
    if (empty($produits)) {
        $_SESSION["erreur"] = "Aucun produit trouvé pour cette catégorie!";
        header("Location: index.php");
        exit();
    }

} elseif (isset($_GET['genre'])) {
    $genre = $_GET['genre'];

    // Requête SQL pour récupérer les produits par genre
    $sql = "SELECT * 
            FROM produits 
            WHERE genre = :genre
            ORDER BY id DESC";
    
    // Préparation de la requête SQL
    $query = $db->prepare($sql);
    $query->bindValue(':genre', $genre, PDO::PARAM_STR);
    $query->execute();
    $produits = $query->fetchAll(PDO::FETCH_ASSOC);

    // Redirection si aucun produit trouvé
    if (empty($produits)) {
        $_SESSION["erreur"] = "Aucun produit trouvé pour ce genre!";
        header("Location: index.php");
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
        <h1 class="categories-titre">
            <a class="h1-categories-accueil" href="index.php">Accueil</a> /
            <?php
                if (isset($genre)) {
                    echo $genre;
                }
                if (isset($categories_type)) {
                    echo $categories_type;
                }
            ?>
        </h1>
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
                <p class="vetement-similaire-prix">Prix <?= ($produit["prix_ht"]) ?> €</p>
            </article>
            <?php endforeach; ?>

        </div>

    </main>
    <?php include_once("templates/footer.php"); ?>
    <script src="/js/script.js"></script>
</body>

</html>