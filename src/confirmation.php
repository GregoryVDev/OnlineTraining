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
// Fonction pour formater la date en français
function formatDateToFrench($dateString)
{
    $date = new DateTime($dateString);
    return $date->format('d/m/Y');
}

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
                <p><span class="details-commande-gras">Numéro de commande :</span><?= ($commande['id']) ?></p>
                <p><span class="details-commande-gras">Date :</span>
                    <?= (formatDateToFrench($commande['date_commande'])) ?></p>
                <p><span class="details-commande-gras">Adresse de livraison :</span> <?= ($commande['adresse']) ?></p>
                <p><span class="details-commande-gras">Ville :</span> <?= ($commande['ville']) ?></p>
                <p><span class="details-commande-gras">Code postal :</span> <?= ($commande['code_postal']) ?></p>
                <p><span class="details-commande-gras">Email :</span> <?= ($commande['email']) ?></p>
            </div>

            <h3>Produits commandés</h3>
            <table class="produit-container">

                <tr class="produit-row header">
                    <td class="produit-col">Produit</td>
                    <td class="produit-col droit">Quantité</td>
                    <td class="produit-col droit">Prix&nbsp;HT</td>
                    <td class="produit-col droit">Total&nbsp;HT</td>
                </tr>

                <?php foreach ($produits as $produit) : ?>
                <tr class="produit-row">
                    <td class="produit-col"><?= htmlspecialchars($produit['produit_nom']) ?></td>
                    <td class="produit-col droit"><?= htmlspecialchars($produit['quantite']) ?></td>
                    <td class="produit-col droit"><?= number_format($produit['prix_ht'], 2) ?>&nbsp;€</td>
                    <td class="produit-col droit">
                        <?= number_format($produit['prix_ht'] * $produit['quantite'], 2) ?>&nbsp;€</td>
                </tr>
                <?php endforeach; ?>

            </table>
        </div>
        <p class="total">Total de la commande : <?= (number_format($commande['total'], 2)) ?>&nbsp€</p>
    </main>
    <?php include('./templates/footer.php'); ?>
    <script src="./js/script.js"></script>
</body>

</html>