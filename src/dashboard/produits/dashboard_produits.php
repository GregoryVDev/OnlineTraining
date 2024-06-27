<?php
session_start();
require_once("../../connect.php");

// if ($_SESSION['admin'] !== 1) {
//     header("Location: index.php");
// }

// <?php
// if (!empty($_SESSION["message"])) {
//     echo "<p>" . $_SESSION["message"] . "</p>";
//     $_SESSION["message"] = "";
// }
// ? >

// <?php
// include './element/navbar.php';
// ? >

$sql = "SELECT p.*, c.type as categorie_type FROM produits p JOIN categories c ON p.categorie_id = c.id";
$query = $db->prepare($sql);
$query->execute();
$produits = $query->fetchAll(PDO::FETCH_ASSOC);
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
    <?php
    include '../../templates/navbar_dashboard.php';
    ?>
    <section class="dashboard">



        <br>
        <br>
        <br>
        <br>

        <table class="tb">
            <thead>
                <th>Image</th>
                <th>alt</th>
                <th>Genre</th>
                <th>Reference</th>
                <th>Marque</th>
                <th>Type</th>
                <th>Couleur</th>
                <th>Matiere</th>
                <th>Motif</th>
                <th>Description</th>
                <th>Quantite</th>
                <th>Prix HT</th>
                <th>Actions</th>
            </thead>
            <tbody>

                <?php
                // pour chaque utilisateur recupéré dans $users on affiche une nouvelle ligne dans la table html
                foreach ($produits as $produit) {
                    // chaque utillisateur de la table $users sera identifié dans le foreach en tant que $user
                ?>
                    <tr>
                        <td><img src="<?= $produit["image_produit"] ?>" alt="<?= $produit["alt"] ?>" width='120px' height='159px'></td>
                        <td><?= $produit["alt"] ?></td>
                        <td><?= $produit["genre"] ?></td>
                        <td><?= $produit["reference"] ?></td>
                        <td><?= $produit["marque"] ?></td>
                        <td><?= $produit["categorie_type"] ?></td>
                        <td><?= $produit["couleur"] ?></td>
                        <td><?= $produit["matiere"] ?></td>
                        <td><?= $produit["motif"] ?></td>
                        <td><?= $produit["description"] ?></td>
                        <td><?= $produit["quantite"] ?></td>
                        <td><?= $produit["prix_ht"] ?> €</td>

                        <td>
                            <a href="user.php?id=<?= $produit["id"] ?>">voir</a>
                            <a href="update_produits.php?id=<?= $produit["id"] ?>">Modifier</a>
                            <a href="./delete_produits.php?id=<?= $produit["id"] ?>">Supprimer</a>
                        </td>
                    </tr>
                <?php
                }

                ?>

                <div>

                    <a classe="deco" href="../produits/create_produits.php"><button class="dashboard-btn">Ajouter un produit</button></a>
                    <br>
                    <br>

                </div>
            </tbody>
        </table>
    </section>
</body>

</html>