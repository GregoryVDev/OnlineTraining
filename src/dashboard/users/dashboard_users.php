<?php
session_start();
require_once("../../connect.php");

$sql = "SELECT * FROM users";
$query = $db->prepare($sql);
$query->execute();
$users = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Dashboard_users</title>
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
                <th>id</th>
                <th>Prénom</th>
                <th>Nom</th>
                <th>email</th>
                <th>adresse</th>
                <th>roles</th>
            </thead>
            <tbody>

                <?php
                // pour chaque utilisateur recupéré dans $users on affiche une nouvelle ligne dans la table html
                foreach ($users as $user) {
                    // chaque utillisateur de la table $users sera identifié dans le foreach en tant que $user
                ?>
                    <tr>
                        <td><?= $user["id"] ?></td>
                        <td><?= $user["prenom"] ?></td>
                        <td><?= $user["nom"] ?></td>
                        <td><?= $user["email"] ?></td>
                        <td><?= $user["adresse"] ?></td>
                        <td><?= $user["roles"] ?></td>
                        <td>
                            <a href="update_users.php?id=<?= $user["id"] ?>">Modifier</a>
                        </td>
                        <td>
                            <a href="delete_users.php?id=<?= $user["id"] ?>">Supprimer</a>
                        </td>
                    </tr>
                <?php
                }

                ?>

                <div>

                    <a classe="deco" href="./create_users.php"><button class="dashboard-btn">Ajouter un utilisateur</button></a>
                    <br>
                    <br>

                </div>
            </tbody>
        </table>
    </section>
</body>

</html>