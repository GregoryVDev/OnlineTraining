<?php
session_start();


// Vérifiez si l'ID du produit a été posté
if (isset($_POST['produit_id'])) {
    $produitId = $_POST['produit_id'];

    // Vérifiez si le panier existe dans la session
    if (!isset($_SESSION['panier'])) {
        $_SESSION['panier'] = [];
    }

    // Ajoutez l'ID du produit au panier
    $_SESSION['panier'][] = $produitId;

    // Redirigez vers une page de confirmation ou affichez un message
    echo "Produit ID " . htmlspecialchars($produitId) . " ajouté au panier.";
    echo "<br><a href='produit.php'>Retour à la liste des produits</a>";
    echo "<br><a href='afficher_panier.php'>Voir le panier</a>";
} else {
    echo "Aucun ID de produit reçu.";
}
?>