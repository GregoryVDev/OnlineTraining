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

$sql = "SELECT * FROM categories";
$query = $db->prepare($sql);
$query->execute();
$categories = $query->fetchAll(PDO::FETCH_ASSOC);
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
        <table class="table table-striped table-hover table table-bordered">
            <thead>
                <th>id</th>
                <th>type</th>
                <th>Actions</th>

            </thead>
            <tbody>

                <?php
                // pour chaque utilisateur recupéré dans $users on affiche une nouvelle ligne dans la table html
                foreach ($categories as $categorie) {
                    // chaque utillisateur de la table $users sera identifié dans le foreach en tant que $user
                ?>
                    <tr>
                        <td><?= $categorie["id"] ?></td>
                        <td><?= $categorie["type"] ?></td>



                        <td>
                            <a href="update_categories.php?id=<?= $categorie["id"] ?>">Modifier</a>
                            <a href="delete_categories.php?id=<?= $categorie["id"] ?>">Supprimer</a>
                        </td>
                    </tr>
                <?php
                }

                ?>

                <div>
                    <div class="add">
                        <a classe="deco" href="./create_categories.php"><button type="button" class="btn btn-outline-secondary">AJOUTER UNE CATEGORIE</button></a>
                    </div>
                    <br>
                    <br>
                </div>
            </tbody>
        </table>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>