<?php
// On demarre une session 
session_start();
if (
    isset($_POST["type"]) && !empty($_POST["type"])

) {
    require_once("../../connect.php");
    $type = $_POST["type"];



    $sql = "INSERT INTO categories (type) VALUES (:type)";

    $query = $db->prepare($sql);

    $query->bindValue(":type", $type);


    $query->execute();

    $_SESSION["message"] = "Article ajouté";
    header("Location: dashboard_categories.php");
} else {
    echo "Veulliez remplir TOUS les formulaires !";
}
