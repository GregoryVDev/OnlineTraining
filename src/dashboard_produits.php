<?php
session_start();
require_once("connect.php");

if ($_SESSION['admin'] !== 1) {
    header("Location: index.php");
}

$sql = "SELECT * FROM produits";
$query = $db->prepare($sql);
$query->execute();
$produuits = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Dashboard</title>
</head>

<body>
    <section class="dashboard">
        <?php
        include './element/navbar.php';
        ?>

        <h1 class="article_dashboard">DASHBOARD</h1>

        <a href="index.php"><button class="dashboard-btn dashboard-btn_1">Déconnexion</button></a>
        <a href="dashboard_produits.php"><button class="dashboard-btn dashboard-btn_1">produits</button></a>
        <a href="dashboard_categories.php"><button class="dashboard-btn dashboard-btn_1">categories</button></a>
        <a href="dashboard_commandes.php"><button class="dashboard-btn dashboard-btn_1">commandes</button></a>
        <a href="dashboard_messagerie.php"><button class="dashboard-btn dashboard-btn_1">messagerie</button></a>
        <a href="dashboard_panier.php"><button class="dashboard-btn dashboard-btn_1">panier</button></a>
        <a href="dashboard_users.php"><button class="dashboard-btn dashboard-btn_1">utilisateur</button></a>

        <?php
        if (!empty($_SESSION["message"])) {
            echo "<p>" . $_SESSION["message"] . "</p>";
            $_SESSION["message"] = "";
        }
        ?>
        <br>

        <table class="tb">
            <thead>
                <th>id</th>
                <th>reference</th>
                <th>marque</th>
                <th>couleur</th>
                <th>categorie_id</th>
                <th>couleur</th>
                <th>matiere</th>
                <th>motif</th>
                <th>description</th>
                <th>image_produit</th>
                <th>alt</th>
                <th>quantite</th>
                <th>prix HT</th>
                <th>Voir</th>
                <th>Modifier</th>
                <th>Supprimer</th>


            </thead>
            <tbody>

                <?php
                // pour chaque utilisateur recupéré dans $users on affiche une nouvelle ligne dans la table html
                foreach ($produits as $produit) {
                    // chaque utillisateur de la table $users sera identifié dans le foreach en tant que $user
                ?>
                    <tr>
                        <td><?= $produit["id"] ?></td>
                        <td><?= $produit["reference"] ?></td>
                        <td><?= $produit["marque"] ?></td>
                        <td><?= $produit["categorie_id"] ?></td>
                        <td><?= $produit["couleur"] ?></td>
                        <td><?= $produit["matiere"] ?></td>
                        <td><?= $produit["motif"] ?></td>
                        <td><?= $produit["description"] ?></td>
                        <td><?= $produit["image_produit"] ?></td>
                        <td><?= $produit["alt"] ?></td>
                        <td><?= $produit["quantite"] ?></td>
                        <td><?= $produit["prix_ht"] ?></td>

                        <td>
                            <a href="user.php?id=<?= $produit["id"] ?>"><img src="img/icon/pngegg.png" height="25px" alt=""></a>
                            </dt>
                        <td>
                            <a href="update.php?id=<?= $produit["id"] ?>"><img src="img/icon/pen.png" height="25px" alt=""></a>
                        </td>
                        <td>
                            <a href="delete.php?id=<?= $produit["id"] ?>"><img src="img/icon/trash.png" height="25px" alt=""></a>
                        </td>
                    </tr>
                <?php
                }

                ?>

                <div>

                    <a classe="deco" href="form.php"><button class="dashboard-btn">Ajouter un produit</button></a>
                    <br>
                    <br>

                </div>
            </tbody>
        </table>
    </section>
</body>

</html>