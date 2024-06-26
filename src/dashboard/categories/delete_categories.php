<?php
// On verifie qu' il ya bien un id dans l'url et que l'utilisateur correspondant existe
// On vérifie qu'il y a bien un id dans l'url et que l'utilisateur correspondant existe
if (isset($_GET["id"]) && !empty($_GET["id"])) {
    require_once("../../connect.php");
    $id = strip_tags($_GET["id"]);

    $sql = "SELECT * FROM categories WHERE id = :id";
    $query = $db->prepare($sql);
    $query->bindValue(":id", $id, PDO::PARAM_INT);
    $query->execute();
    $categories = $query->fetch();

    if ($categories) {
        $sql = "DELETE FROM categories WHERE id = :id";
        $query = $db->prepare($sql);
        $query->bindValue(":id", $id, PDO::PARAM_INT);
        $query->execute();
    }

    header("Location: dashboard_categories.php");
} else {
    header("Location: index.php");
}
