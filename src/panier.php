<?php
session_start();

require('connect.php');

// On utilise la fonction "espace" en mettant "htmlspecialchars pour empêcher les injections XSS en échappant les caractrères spéciaux
function escape($string)
{
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

// Vérifier si le panier est dans la session
if (!isset($_SESSION['panier'])) {
    // Si il n'existe pas, on le créé
    $_SESSION['panier'] = [];
}
// $panier contient les produits actuels du panier
$panier = $_SESSION['panier'];
// $total est initialisé à 0 vu qu'il n'y a pas de produit au début et pour après calculer le total du panier
$total = 0;

// Calculer le total du panier
foreach ($panier as $produit) {
    // Pour chaque produit dans le panier, le prix est multiplié par la quantité et ajouté au total
    $total += $produit['prix_ht'] * $produit['quantite'];

    $cartCount = 0;
    foreach ($panier as $item) {
    $cartCount += $item['quantite'];
}

// Stocker le nombre d'articles dans la session
$_SESSION['cartCount'] = $cartCount;

}

// Gestion de l'ajout d'une quantité spécifique
// On vérifie si le formulaire pour augmenter la quantité a été envoyé
if (isset($_POST['augmenter_id'])) {
    // Récupère l'ID du produit à augmenter depuis les données POST
    $augmenter_id = $_POST['augmenter_id'];

    foreach ($panier as &$produit) {
        // On vérifie si l'ID du produit actuel correspond à l'ID du produit à augmenter
        if ($produit['id'] == $augmenter_id) {
            // Augmente la quantité du produit de 1
            $produit['quantite'] += 1;
            // Met à jour le panier dans la session
            $_SESSION['panier'] = $panier;
            break;
        }
    }

    header("Location: panier.php");
    exit();
}

// Gestion de la diminution d'une quantité spécifique
// On vérifie si le formulaire pour diminuer la quantité a été envoyé
if (isset($_POST['diminuer_id'])) {
    // On récupère l'ID du produit à diminuer depuis les données POST
    $diminuer_id = $_POST['diminuer_id'];

    foreach ($panier as &$produit) {
        // On vérifie si l'ID du produit actuel correspond à l'ID du produit à diminuer
        if ($produit['id'] == $diminuer_id) {
            // On vérifie si la quantité est supérieur à 1
            if ($produit['quantite'] > 1) {
                // Si il est supérieur à 1, on peut diminuer la quantité du produit de 1
                $produit['quantite'] -= 1;
            } else {
                // Si la quantité devient 0, le produit est retiré du panier
                unset($panier[$diminuer_id]);
            }
            // Met à jour la session avec le panier modifié
            $_SESSION['panier'] = array_values($panier);
            break;
        }
    }

    header("Location: panier.php");
    exit();
}

// Gestion de la suppression d'une quantité spécifique
// On vérifie si remove_id et remove_quantite existe 
if (isset($_POST['remove_id']) && isset($_POST['remove_quantite'])) {
    // On récupère l'ID du produit à retirer et on le stocke dans $remove_id
    $remove_id = $_POST['remove_id'];
    // On récupère la quantité de produit à retirer et à convertir en nombre entier
    $remove_quantite = (int)$_POST['remove_quantite'];

    // On parcourt tous les produits dans le panier. Le symbole "&" avant "$produit" permet de modifier directement les éléments du tableau $panier 
    foreach ($panier as $key => &$produit) {
        // On vérifie si l'ID du produit actuel dans la boucle est égale à l'ID du produit retiré
        if ($produit['id'] == $remove_id) {
            // Si la quantité actuelle du produit est inférieur ou égale à la quantité à retirer, le produit est supprimé du panier
            if ($produit['quantite'] <= $remove_quantite) {

                unset($panier[$key]); // $remove_id
            } else {
                // Réduire la quantité
                $produit['quantite'] -= $remove_quantite;
            }
            // Mise à jour de la session avec le panier modifié
            $_SESSION['panier'] = array_values($panier);
            break;
        }
    }

    header("Location: panier.php");
    exit();
}

// Gestion de la suppression d'un produit
if (isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];

    foreach ($panier as $key => $produit) {
        if ($produit['id'] == $delete_id) {
            unset($panier[$key]);
            $_SESSION['panier'] = array_values($panier);
            break;
        }
    }

    header("Location: panier.php");
    exit();
}


include('./templates/requete_navbar_menu_catalogue.php');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/navBar.css">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="stylesheet" href="./css/panier/panier.css">
    <link rel="stylesheet" href="css/fonts/fonts.css">
    <title>Mon panier</title>
</head>

<body>
    <?php include('./templates/header.php'); ?>

    <div class="cadre">
        <div class="panier">
            <h2 class="text_mon_panier">Mon panier</h2>

            <?php if (count($panier) > 0) : ?>
            <?php foreach ($panier as $produit) : ?>
            <div class="recap_panier">
                <div>
                    <img src="<?= escape($produit['image_produit']) ?>" width="100px"
                        alt="<?= escape($produit['nom_produit']) ?>">
                </div>
                <div class="recap_text">
                    <div>
                        <p><?= escape($produit['nom_produit']) ?></p>
                        <p><?= escape($produit['prix_ht']) ?> €</p>
                        <p><?= escape($produit['couleur']) ?></p>
                        <p><?= escape($produit['taille']) ?></p>
                    </div>

                    <div class="quantite">
                        <!-- Formulaire pour diminuer la quantité -->
                        <div class="gestion_produit">
                            <div class="gestion_quantité">
                                <div>
                                    <form class="diminuer_produit" method="post" action="panier.php"
                                        style="display:inline;">
                                        <input type="hidden" name="diminuer_id" value="<?= escape($produit['id']) ?>">
                                        <button type="submit" class="diminuer-quantity-btn">-</button>
                                    </form>
                                </div>

                                <div class="align_quantite">
                                    <p>Quantité : <?= escape($produit['quantite']) ?></p>
                                </div>

                                <!-- Formulaire pour augmenter la quantité -->
                                <div>
                                    <form class="augmenter_produit" method="post" action="panier.php"
                                        style="display:inline;">
                                        <input type="hidden" name="augmenter_id" value="<?= escape($produit['id']) ?>">
                                        <button type="submit" class="augmenter-quantity-btn">+</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div>
                            <!-- Formulaire pour supprimer un produit entier -->
                            <form class="supprimer_produit" method="post" action="panier.php" style="display:inline;">
                                <input type="hidden" name="delete_id" value="<?= escape($produit['id']) ?>">
                                <button type="submit" class="delete-btn">SUPPRIMER LE PRODUIT</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            <?php else : ?>
            <p>Votre panier est vide.</p>
            <?php endif; ?>
        </div>
        <div class="commander">
            <div class="total_cde">
                <p>TOTAL DE MA COMMANDE</p>
                <p class="price"><?= escape($total) ?> €</p>
            </div>
            <div class="commande">
                <form method="post" action="commande.php">
                    <button type="submit" class="cde">COMMANDER</button>
                </form>
            </div>
        </div>
    </div>

    <!-- <div class="aussi">
        <h2 class="aimerez_aussi">Vous aimerez aussi</h2>

        <div class="meme_categorie">

            <?php foreach ($produit as $produit): ?>
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
    </div> -->

    <?php include('./templates/footer.php'); ?>

    <script src="./js/script.js"></script>
</body>

</html>