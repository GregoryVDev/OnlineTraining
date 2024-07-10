<?php
session_start();
require('connect.php');

// On utilise la fonction "escape" en mettant "htmlspecialchars pour empêcher les injections XSS en échappant les caractères spéciaux
function escape($string)
{
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

// Vérifier si l'ID de la commande est passé en paramètre
if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit();
}

$commande_id = (int)$_GET['id'];

// Récupérer les informations de la commande depuis la base de données
$stmt = $conn->prepare("SELECT * FROM commandes WHERE id = ?");
$stmt->bind_param('i', $commande_id);
$stmt->execute();
$result = $stmt->get_result();
$commande = $result->fetch_assoc();

if (!$commande) {
    header('Location: index.php');
    exit();
}

// Récupérer les détails de la commande
$stmt = $conn->prepare("SELECT * FROM commande_details WHERE commande_id = ?");
$stmt->bind_param('i', $commande_id);
$stmt->execute();
$result = $stmt->get_result();
$details = $result->fetch_all(MYSQLI_ASSOC);

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
            <p>Merci pour votre commande, <?= escape($commande['prenom']) ?> <?= escape($commande['nom']) ?> !</p>
            <p>Votre commande a été enregistrée avec succès.</p>
            <h3>Détails de la commande :</h3>
            <ul>
                <?php foreach ($details as $detail) : ?>
                    <li>
                        Produit ID: <?= escape($detail['produit_id']) ?><br>
                        Quantité: <?= escape($detail['quantite']) ?><br>
                        Prix: <?= escape($detail['prix_ht']) ?> €
                    </li>
                <?php endforeach; ?>
            </ul>
            <p>Total: <?= escape($commande['total']) ?> €</p>
        </div>
    </div>

    <?php include('./templates/footer.php'); ?>
</body>

</html>