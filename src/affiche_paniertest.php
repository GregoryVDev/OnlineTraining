<?php
session_start();

require_once('connect.php');

// Récupération des produits dans le panier
$produitsPanier = [];
if (isset($_SESSION['panier']) && !empty($_SESSION['panier'])) {
    $placeholders = implode(',', array_fill(0, count($_SESSION['panier']), '?'));
    $sql = "SELECT * FROM produits WHERE id IN ($placeholders)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($_SESSION['panier']);
    $produitsPanier = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Panier</title>
    <style>
    .card {
        border: 1px solid #ccc;
        padding: 16px;
        margin: 16px;
        display: inline-block;
        text-align: center;
    }
    </style>
</head>

<body>
    <h1>Votre Panier</h1>
    <?php if (empty($produitsPanier)): ?>
    <p>Votre panier est vide.</p>
    <?php else: ?>
    <?php foreach ($produitsPanier as $produit): ?>
    <div class="card">
        <h2><?php echo htmlspecialchars($produit['nom']); ?></h2>
        <p><?php echo htmlspecialchars($produit['description']); ?></p>
    </div>
    <?php endforeach; ?>
    <?php endif; ?>
    <br>
    <a href="produit.php">Retour à la liste des produits</a>
</body>

</html>