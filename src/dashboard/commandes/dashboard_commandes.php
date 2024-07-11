<?php
session_start();
require_once("../../connect.php");

// Récupérer toutes les commandes et leurs détails
$sql = "SELECT c.id, c.nom, c.prenom, c.adresse, c.ville, c.code_postal, c.email, c.date_commande, c.total, p.nom_produit AS produit_nom, cd.quantite, cd.prix_ht 
        FROM commandes c
        JOIN commande_details cd ON c.id = cd.commande_id
        JOIN produits p ON cd.produit_id = p.id
        ORDER BY c.id, p.nom_produit";
$query = $db->prepare($sql);
$query->execute();
$commandes = $query->fetchAll(PDO::FETCH_ASSOC);

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
    <link rel="stylesheet" href="../../css/dashboard/dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Dashboard Commandes</title>
</head>

<body>
    <?php
    include '../../templates/navbar_dashboard.php';
    ?>
    <section class="dashboard">
        <br>
        <br>
        <table class="table table-striped table-hover table-bordered">
            <thead>
                <tr>
                    <th>ID Commande</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Adresse</th>
                    <th>Ville</th>
                    <th>Code Postal</th>
                    <th>Email</th>
                    <th>Date de Commande</th>
                    <th>Total</th>
                    <th>Produit</th>
                    <th>Quantité</th>
                    <th>Prix HT</th>
                    <th>Total Produit HT</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $current_id = null;
                foreach ($commandes as $commande) {
                    if ($current_id !== $commande["id"]) {
                        if ($current_id !== null) {
                            // fermer la ligne précédente si nécessaire
                            echo "</tbody>";
                        }
                        // nouvelle commande, afficher les détails du client
                        $current_id = $commande["id"];
                        echo "<tbody>";
                        echo "<tr>";
                        echo "<td rowspan=\"" . count($commandes) . "\">" . htmlspecialchars($commande["id"]) . "</td>";
                        echo "<td rowspan=\"" . count($commandes) . "\">" . htmlspecialchars($commande["nom"]) . "</td>";
                        echo "<td rowspan=\"" . count($commandes) . "\">" . htmlspecialchars($commande["prenom"]) . "</td>";
                        echo "<td rowspan=\"" . count($commandes) . "\">" . htmlspecialchars($commande["adresse"]) . "</td>";
                        echo "<td rowspan=\"" . count($commandes) . "\">" . htmlspecialchars($commande["ville"]) . "</td>";
                        echo "<td rowspan=\"" . count($commandes) . "\">" . htmlspecialchars($commande["code_postal"]) . "</td>";
                        echo "<td rowspan=\"" . count($commandes) . "\">" . htmlspecialchars($commande["email"]) . "</td>";
                        echo "<td rowspan=\"" . count($commandes) . "\">" . htmlspecialchars(formatDateToFrench($commande["date_commande"])) . "</td>";
                        echo "<td rowspan=\"" . count($commandes) . "\">" . htmlspecialchars(number_format($commande["total"], 2)) . " €</td>";
                    }
                    // afficher les détails du produit
                    echo "<td>" . htmlspecialchars($commande["produit_nom"]) . "</td>";
                    echo "<td>" . htmlspecialchars($commande["quantite"]) . "</td>";
                    echo "<td>" . htmlspecialchars(number_format($commande["prix_ht"], 2)) . " €</td>";
                    echo "<td>" . htmlspecialchars(number_format($commande["prix_ht"] * $commande["quantite"], 2)) . " €</td>";
                    echo "</tr>";
                }
                if ($current_id !== null) {
                    // fermer la dernière ligne
                    echo "</tbody>";
                }
                ?>
            </tbody>
        </table>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>