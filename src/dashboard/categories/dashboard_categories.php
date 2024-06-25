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
    <link rel="stylesheet" href="style.css">
    <title>Dashboard</title>
</head>

<body>
    <section class="dashboard">

        <?php
        include '../../templates/navbar_dashboard.php';
        ?>

        <br>
        <br>
        <br>
        <br>

        <table class="tb">
            <thead>
                <th>id</th>
                <th>type</th>
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
                            <a href="user.php?id=<?= $categorie["id"] ?>"><img src="img/icon/pngegg.png" height="25px" alt=""></a>
                            </dt>
                        <td>
                            <a href="update.php?id=<?= $categorie["id"] ?>"><img src="img/icon/pen.png" height="25px" alt=""></a>
                        </td>
                        <td>
                            <a href="delete.php?id=<?= $categorie["id"] ?>"><img src="img/icon/trash.png" height="25px" alt=""></a>
                        </td>
                    </tr>
                <?php
                }

                ?>

                <div>

                    <a classe="deco" href="./form_categories.php"><button class="dashboard-btn">Ajouter une categorie</button></a>
                    <br>
                    <br>

                </div>
            </tbody>
        </table>
    </section>
</body>

</html>