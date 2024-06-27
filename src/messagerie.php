<?php

session_start();

require_once("./connect.php");

// On vérifie si dans $_POST valider existe

if (isset($_POST["valider"])) {
    // Si les champs ne sont pas vides 
    if (!empty($_POST["nom"]) && !empty($_POST["prenom"]) && !empty($_POST["message"])) {
        // Déclarer en variable nom en htmlspecialchars pour éviter que l'utilisateur mette un code html à l'intérieur du champs
        $nom = htmlspecialchars($_POST["nom"]);
        $prenom = htmlspecialchars($_POST["prenom"]);
        $message = nl2br(htmlspecialchars($_POST["message"]));


        $sql = "INSERT INTO messagerie (nom, prenom, message) VALUES (:nom, :prenom, :message)";
        $query = $db->prepare($sql);

        $query->bindValue(":nom", $nom);
        $query->bindValue(":prenom", $prenom);
        $query->bindValue(":message", $message);

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
    <form method="POST">
        <input type="text" name="nom" placeholder="Nom">
        <br>
        <input type="text" name="prenom" placeholder="Prénom">
        <br>
        <textarea name="message" placeholder="Votre message"></textarea>
        <br>
        <input type="submit" name="valider">
    </form>
    <section id="messages"></section>

    <script>
        setInterval('load_messages()', 10);

        function load_messages() {
            $('#messages').load('loadmessages.php');
        }
    </script>
</body>

</html>