<?php
session_start();
require_once("../../connect.php");

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
    <link rel="stylesheet" href="../../css/dashboard/dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Dashboard</title>
</head>

<body>
    <?php
    include '../../templates/navbar_dashboard.php';
    ?>
    <section class="dashboard">

        <br>
        <br>
        <div class="add">
            <a href="../produits/create_produits.php"><button type="button" class="btn btn-outline-secondary">AJOUTER UN
                    PRODUIT</button></a>
        </div>
        <br>
        <br>
        <table class="table table-striped table-hover table table-bordered">
            <thead>
                <th>Image</th>
                <th>Nom</th>
                <th>Genre</th>
                <th>Reference</th>
                <th>Marque</th>
                <th>Type</th>
                <th>Couleur</th>
                <th>Matiere</th>
                <th>Motif</th>
                <th>Description</th>
                <th>taille</th>
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
                        <td><img src="/<?= $produit["image_produit"] ?>" alt="<?= $produit["categorie_type"] ?>" width='96px' height='127px'></td>
                        <td><?= $produit["nom_produit"] ?></td>
                        <td><?= $produit["genre"] ?></td>
                        <td><?= $produit["reference"] ?></td>
                        <td><?= $produit["marque"] ?></td>
                        <td><?= $produit["categorie_type"] ?></td>
                        <td><?= $produit["couleur"] ?></td>
                        <td><?= $produit["matiere"] ?></td>
                        <td><?= $produit["motif"] ?></td>
                        <td><?= $produit["description"] ?></td>
                        <td><?= $produit["taille"] ?></td>
                        <td><?= $produit["quantite"] ?></td>
                        <td><?= $produit["prix_ht"] ?> €</td>

                        <td>
                            <a href="fiche_produit.php?id=<?= $produit["id"] ?>">VOIR</a>
                            <a href="update_produits.php?id=<?= $produit["id"] ?>">MODIFIER</a>
                            <a href="./delete_produits.php?id=<?= $produit["id"] ?>">SUPPRIMER</a>
                        </td>
                    </tr>
                <?php
                }

                ?>


            </tbody>
        </table>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>