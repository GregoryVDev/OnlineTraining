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

include('./templates/requete_navbar_menu_catalogue.php');

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/navBar.css">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="stylesheet" href="./css/commande/confirmation_commande.css">
    <link rel="stylesheet" href="css/fonts/fonts.css">
    <title>Confirmation de commande</title>
</head>

<body>
    <?php include('./templates/header.php'); ?>
    <main>
        <div class="container-confirmation-commande">
            <div class="confirmation-container">
                <h2 class="text-confirmation">Confirmation de commande</h2>
                <p>Merci pour votre commande, <?= ($commande['prenom']) ?> <?= ($commande['nom']) ?>.</p>
                <p>Votre commande a été passée avec succès. Voici les détails :</p>
            </div>
            <div class="details-commande">
                <h3>Détails de la commande</h3>
                <p><span class="details-commande-gras">Numéro de commande:</span> <?= ($commande['id']) ?></p>
                <p><span class="details-commande-gras">Date:</span> <?= ($commande['date_commande']) ?></p>
                <p><span class="details-commande-gras">Adresse de livraison:</span> <?= ($commande['adresse']) ?></p>
                <p><span class="details-commande-gras">Ville:</span> <?= ($commande['ville']) ?></p>
                <p><span class="details-commande-gras">Code postal:</span> <?= ($commande['code_postal']) ?></p>
                <p><span class="details-commande-gras">Email:</span> <?= ($commande['email']) ?></p>
            </div>

            <h3>Produits commandés</h3>
            <div class="produit-container">
                <div class="produit-row header">
                    <div class="produit-col">Produit</div>
                    <div class="produit-col droit">Quantité</div>
                    <div class="produit-col droit">Prix HT</div>
                    <div class="produit-col droit">Total HT</div>
                </div>
                <?php foreach ($produits as $produit) : ?>
                <div class="produit-row">
                    <div class="produit-col"><?= ($produit['produit_nom']) ?></div>
                    <div class="produit-col droit"><?= ($produit['quantite']) ?></div>
                    <div class="produit-col droit"><?= (number_format($produit['prix_ht'], 2)) ?> €
                    </div>
                    <div class="produit-col droit">
                        <?= (number_format($produit['prix_ht'] * $produit['quantite'], 2)) ?> €</div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <p class="total">Total de la commande: <?= (number_format($commande['total'], 2)) ?> €</p>
    </main>
    <?php include('./templates/footer.php'); ?>
    <script src="./js/script.js"></script>
</body>

</html>