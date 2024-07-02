<?php

date_default_timezone_set('Europe/Paris');

session_start();
require_once("./connect.php");

// On vérifie si dans $_POST valider existe

if (isset($_POST["valider"])) {
    // Si les champs ne sont pas vides 
    if (!empty($_POST["message"])) {
        // Déclarer en variable nom en htmlspecialchars pour éviter que l'utilisateur mette un code html à l'intérieur du champs
        $message = nl2br(htmlspecialchars($_POST["message"]));
        $user_id = $_SESSION["user"]["user_id"];


        $sql = "INSERT INTO messagerie (message, user_id, time) VALUES (:message, :user_id, CONVERT_TZ(NOW(), '+00:00', '+02:00'))"; // Convertir l'heure actuelle de UTC+0 à UTC+2 pour les messages envoyés        
        $query = $db->prepare($sql);

        $query->bindValue(":message", $message);
        $query->bindValue(":user_id", $user_id);

        $query->execute();
    } else {
        echo "Veuillez compléter tous les champs...";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/messagerie/messagerie.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <title>Messagerie instantanée</title>
</head>

<body>

    <section id="messages"></section>
    <div id="discussion"></div>
    <form method="POST">
        <textarea name="message" placeholder="Votre message"></textarea>
        <br>
        <input type="submit" name="valider">
    </form>

    <script>
        setInterval('load_messages()', 10);

        function load_messages() {
            $('#messages').load('loadmessages.php');
        }
    </script>
</body>

</html>