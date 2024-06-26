<?php

session_start();
require_once("./connect.php");

// On vérifie la méthode de requête

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // On récupère les données nécessaires
    $sender_id = $_SESSION["user_id"];
    $receiver_id = $_SESSION["receiver_id"];
    $message = $_POST["message"];

    $sql = "INSERT INTO messagerie (sender_id, receiver_id, message VALUES (:sender_id, :receiver_id, :message)";

    $query = $db->prepare($sql);
    $query->bindValue(":sender_id", $sender_id);
    $query->bindValue(":receiver_id", $receiver_id);
    $query->bindValue(":message", $message);

    $query->execute();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/messagerie/messagerie.css">
    <title>Envoie de message</title>
</head>

<body>

    <form method="POST">
        <input type="hidden" name="receiver_id" value="RECEIVER_ID">
        <textarea name="message" required></textarea>
        <button type="submit">Envoyer</button>
    </form>

</body>

</html>