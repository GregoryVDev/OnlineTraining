<?php
// On verifie qu' il ya bien un id dans l'url et que l'utilisateur correspondant existe
// On vérifie qu'il y a bien un id dans l'url et que l'utilisateur correspondant existe
if (isset($_GET["id"]) && !empty($_GET["id"])) {
    require_once("../../connect.php");
    $id = strip_tags($_GET["id"]);

    $sql = "SELECT * FROM users WHERE id = :id";
    $query = $db->prepare($sql);
    $query->bindValue(":id", $id, PDO::PARAM_INT);
    $query->execute();
    $users = $query->fetch();

    if ($users) {
        $sql = "DELETE FROM users WHERE id = :id";
        $query = $db->prepare($sql);
        $query->bindValue(":id", $id, PDO::PARAM_INT);
        $query->execute();
    }

    header("Location: dashboard_users.php");
} else {
    header("Location: index.php");
}
