<?php
session_start();

// Vérifier si l'utilisateur connecté est un super admin
$isSuperAdmin = isset($_SESSION['user']) && $_SESSION['user']['roles'] === '["ROLE_SUPER_ADMIN"]';


// Déterminer le rôle
if ($isSuperAdmin && isset($_POST["role"])) {
    $role = $_POST["role"];
} else {
    $role = 'ROLE_USER';
}




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
    <link rel="stylesheet" href="../../css/dashboard/dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Dashboard_users</title>
</head>

<body>
    <?php
    include '../../templates/navbar_dashboard.php';
    ?>
    <section class="dashboard">
        <br>
        <br>
        <div class="add">
            <a classe="deco" href="./create_users.php"><button type="button" class="btn btn-outline-secondary">AJOUTER UN UTILISATEUR</button></a>

        </div>
        <br>
        <br>
        <table class="table table-striped table-hover table table-bordered">
            <thead>
                <th>id</th>
                <th>Prénom</th>
                <th>Nom</th>
                <th>email</th>
                <th>adresse</th>
                <th>roles</th>
                <?php if ($isSuperAdmin) : ?>
                    <!-- seul le super admin peut avoir accès à action -->
                    <th>Actions</th>
                <?php endif; ?>
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
                        <?php if ($isSuperAdmin) : ?>
                            <td>
                                <a href="update_users.php?id=<?= $user["id"] ?>">MODIFIER</a>
                                <a href="delete_users.php?id=<?= $user["id"] ?>">SUPPRIMER</a>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php
                }

                ?>


            </tbody>
        </table>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>