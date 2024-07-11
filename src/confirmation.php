<?php
session_start();
require('connect.php');

if (!isset($_GET['id'])) {
    echo "Identifiant de commande non fourni.";
    exit();
}

$commande_id = intval($_GET['id']);

// Récupérer les détails de la commande
$stmt = $db->prepare("SELECT * FROM commandes WHERE id = ?");
if (!$stmt) {
    die('Prepare failed: (' . $db->errorInfo()[2] . ')');
}
if (!$stmt->execute([$commande_id])) {
    die('Execute failed: (' . $stmt->errorInfo()[2] . ')');
}
$commande = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$commande) {
    echo "Commande introuvable.";
    exit();
}

// Récupérer les produits de la commande
$stmt = $db->prepare("SELECT cd.*, p.nom_produit as produit_nom FROM commande_details cd JOIN produits p ON cd.produit_id = p.id WHERE cd.commande_id = ?");
if (!$stmt) {
    die('Prepare failed: (' . $db->errorInfo()[2] . ')');
}
if (!$stmt->execute([$commande_id])) {
    die('Execute failed: (' . $stmt->errorInfo()[2] . ')');
}
$produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/navBar.css">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="stylesheet" href="./css/confirmation.css">
    <link rel="stylesheet" href="css/fonts/fonts.css">
    <title>Confirmation de commande</title>
</head>

<body>
    <?php include('./templates/header.php'); ?>

    <div class="cadre">
        <div class="confirmation">
            <h2 class="text_confirmation">Confirmation de commande</h2>
            <p>Merci pour votre commande, <?= htmlspecialchars($commande['prenom']) ?> <?= htmlspecialchars($commande['nom']) ?>.</p>
            <p>Votre commande a été passée avec succès. Voici les détails :</p>

            <h3>Détails de la commande</h3>
            <p>Numéro de commande: <?= htmlspecialchars($commande['id']) ?></p>
            <p>Date: <?= htmlspecialchars($commande['date_commande']) ?></p>
            <p>Adresse de livraison: <?= htmlspecialchars($commande['adresse']) ?>, <?= htmlspecialchars($commande['ville']) ?>, <?= htmlspecialchars($commande['code_postal']) ?></p>
            <p>Email: <?= htmlspecialchars($commande['email']) ?></p>

            <h3>Produits commandés</h3>
            <table>
                <thead>
                    <tr>
                        <th>Produit</th>
                        <th>Quantité</th>
                        <th>Prix HT</th>
                        <th>Total HT</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($produits as $produit) : ?>
                        <tr>
                            <td><?= htmlspecialchars($produit['produit_nom']) ?></td>
                            <td><?= htmlspecialchars($produit['quantite']) ?></td>
                            <td><?= htmlspecialchars(number_format($produit['prix_ht'], 2)) ?> €</td>
                            <td><?= htmlspecialchars(number_format($produit['prix_ht'] * $produit['quantite'], 2)) ?> €</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <p>Total de la commande: <?= htmlspecialchars(number_format($commande['total'], 2)) ?> €</p>
        </div>
    </div>

    <?php include('./templates/footer.php'); ?>
</body>

</html>