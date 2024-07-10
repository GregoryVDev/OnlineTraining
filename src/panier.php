<?php
session_start(); // Démarre la session

require('connect.php'); // Inclut le fichier de connexion à la base de données

// Fonction pour échapper les chaînes de caractères pour éviter les attaques XSS
function escape($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

// Initialise le panier s'il n'existe pas encore
if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}

$panier = $_SESSION['panier']; // Récupère le panier de la session
$total = 0; // Initialise le total à 0
$cartCount = 0; // Initialise le compteur d'articles à 0

// Calcule le total et le nombre d'articles dans le panier
foreach ($panier as $produit) {
    $total += $produit['prix_ht'] * $produit['quantite'];
    $cartCount += $produit['quantite'];
}

$_SESSION['cartCount'] = $cartCount; // Met à jour le compteur d'articles dans la session

// Augmente la quantité d'un produit dans le panier
if (isset($_POST['augmenter_id'])) {
    $augmenter_id = $_POST['augmenter_id'];
    foreach ($panier as &$produit) {
        if ($produit['id'] == $augmenter_id) {
            $produit['quantite'] += 1;
            $_SESSION['panier'] = $panier; // Met à jour le panier dans la session
            break;
        }
    }
    header("Location: panier.php"); // Redirige vers la page du panier
    exit();
}

// Diminue la quantité d'un produit dans le panier
if (isset($_POST['diminuer_id'])) {
    $diminuer_id = $_POST['diminuer_id'];
    foreach ($panier as &$produit) {
        if ($produit['id'] == $diminuer_id) {
            if ($produit['quantite'] > 1) {
                $produit['quantite'] -= 1;
            } else {
                unset($panier[array_search($produit, $panier)]); // Supprime le produit si la quantité est 1
            }
            $_SESSION['panier'] = array_values($panier); // Réindexe le tableau du panier
            break;
        }
    }
    header("Location: panier.php"); // Redirige vers la page du panier
    exit();
}

// Supprime une quantité spécifique d'un produit dans le panier
if (isset($_POST['remove_id']) && isset($_POST['remove_quantite'])) {
    $remove_id = $_POST['remove_id'];
    $remove_quantite = (int)$_POST['remove_quantite'];
    foreach ($panier as $key => &$produit) {
        if ($produit['id'] == $remove_id) {
            if ($produit['quantite'] <= $remove_quantite) {
                unset($panier[$key]); // Supprime le produit si la quantité à retirer est supérieure ou égale à la quantité actuelle
            } else {
                $produit['quantite'] -= $remove_quantite;
            }
            $_SESSION['panier'] = array_values($panier); // Réindexe le tableau du panier
            break;
        }
    }
    header("Location: panier.php"); // Redirige vers la page du panier
    exit();
}

// Supprime complètement un produit du panier
if (isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];
    foreach ($panier as $key => $produit) {
        if ($produit['id'] == $delete_id) {
            unset($panier[$key]); // Supprime le produit
            $_SESSION['panier'] = array_values($panier); // Réindexe le tableau du panier
            break;
        }
    }
    header("Location: panier.php"); // Redirige vers la page du panier
    exit();
}

include('./templates/requete_navbar_menu_catalogue.php'); // Inclut le fichier des requêtes pour le menu catalogue
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

    <?php include('./templates/footer.php'); ?>
</body>

</html>