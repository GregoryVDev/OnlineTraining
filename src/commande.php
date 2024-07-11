<?php
session_start();
require('connect.php');

// On utilise la fonction "escape" en mettant "htmlspecialchars" pour empêcher les injections XSS en échappant les caractères spéciaux
function escape($string)
{
    return htmlspecialchars($string ?? '', ENT_QUOTES, 'UTF-8');
}

// Vérifier si le panier est dans la session
if (!isset($_SESSION['panier']) || empty($_SESSION['panier'])) {
    header('Location: panier.php');
    exit();
}

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $nom = escape($_POST['nom'] ?? '');
    $prenom = escape($_POST['prenom'] ?? '');
    $adresse = escape($_POST['adresse'] ?? '');
    $ville = escape($_POST['ville'] ?? '');
    $code_postal = escape($_POST['code_postal'] ?? '');
    $email = escape($_POST['email'] ?? '');

    // Valider les données
    if (empty($nom) || empty($prenom) || empty($adresse) || empty($ville) || empty($code_postal) || empty($email)) {
        $error = "Tous les champs sont obligatoires.";
    } else {
        // Démarrer la transaction
        $db->beginTransaction();

        try {
            // Calculer le total de la commande
            $total = 0;
            foreach ($_SESSION['panier'] as $produit) {
                $total += $produit['prix_ht'] * $produit['quantite'];
            }

            // Enregistrer la commande dans la base de données
            $stmt = $db->prepare("INSERT INTO commandes (nom, prenom, adresse, ville, code_postal, email, total, date_commande) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())");
            $stmt->execute([$nom, $prenom, $adresse, $ville, $code_postal, $email, $total]);
            $commande_id = $db->lastInsertId();

            // Enregistrer les détails de la commande
            foreach ($_SESSION['panier'] as $produit) {
                $stmt = $db->prepare("INSERT INTO commande_details (commande_id, produit_id, quantite, prix_ht) VALUES (?, ?, ?, ?)");
                $stmt->execute([$commande_id, $produit['id'], $produit['quantite'], $produit['prix_ht']]);

                // Mise à jour du stock
                $sql = "SELECT * FROM produits WHERE id = :id";
                $query = $db->prepare($sql);
                $query->bindValue(":id", $produit['id']);
                $query->execute();
                $result = $query->fetch();
                $stock_initial = $result['quantite'];
                $stock_final = $stock_initial - $produit['quantite'];

                $sql = "UPDATE produits SET quantite = :quantite WHERE id = :id";
                $query = $db->prepare($sql);
                $query->bindValue(":quantite", $stock_final);
                $query->bindValue(":id", $produit['id']);
                $query->execute();
            }

            // Valider la transaction
            $db->commit();

            // Vider le panier
            $_SESSION['panier'] = [];

            // Redirection vers la page de confirmation
            header('Location: confirmation.php?id=' . $commande_id);
            exit();
        } catch (Exception $e) {
            // Annuler la transaction en cas d'erreur
            $db->rollBack();
            $error = "Une erreur s'est produite lors de la finalisation de votre commande : " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/navBar.css">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="stylesheet" href="./css/commande.css">
    <link rel="stylesheet" href="./css/commande/commande.css">
    <link rel="stylesheet" href="css/fonts/fonts.css">
    <title>Finaliser la commande</title>
</head>

<body>
    <?php include('./templates/header.php'); ?>

    <div class="cadre">
        <div class="commande">
            <h2 class="text_commande">Finaliser la commande</h2>

            <?php if (isset($error)) : ?>
                <p class="error"><?= $error ?></p>
            <?php endif; ?>

            <form method="post" action="commande.php">
                <div>
                    <label for="nom">Nom:</label>
                    <input type="text" id="nom" name="nom" required>
                </div>
                <div>
                    <label for="prenom">Prénom:</label>
                    <input type="text" id="prenom" name="prenom" required>
                </div>
                <div>
                    <label for="adresse">Adresse:</label>
                    <input type="text" id="adresse" name="adresse" required>
                </div>
                <div>
                    <label for="ville">Ville:</label>
                    <input type="text" id="ville" name="ville" required>
                </div>
                <div>
                    <label for="code_postal">Code Postal:</label>
                    <input type="text" id="code_postal" name="code_postal" required>
                </div>
                <div>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div>
                    <button type="submit" class="finaliser-commande-btn">Finaliser la commande</button>
                </div>
            </form>
        </div>
    </div>

    <?php include('./templates/footer.php'); ?>
</body>

</html>