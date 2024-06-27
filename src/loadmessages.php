<?php

date_default_timezone_set('Europe/Paris');

session_start();
require_once("./connect.php");

$current_user_id = $_SESSION["user"]["user_id"];

$sql = "SELECT *, DATE_FORMAT(CONVERT_TZ(time, '+01:00', '+02:00'), '%H:%i') AS formatted_time FROM messagerie ORDER BY time DESC";
$query = $db->prepare($sql);
$query->execute();

while ($message = $query->fetch(PDO::FETCH_ASSOC)) {
    $message_class = ($message["user_id"] == $current_user_id) ? 'sent' : 'received';
?>
    <div class="message <?= $message_class ?>">
        <h4><?= htmlspecialchars($message["nom"]) . " " . htmlspecialchars($message["prenom"]); ?></h4>
        <p><?= $message["message"]; ?></p>
        <small><?= htmlspecialchars($message["time"]); ?></small>
    </div>
<?php
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messagerie instantanée</title>
</head>

<body>

</body>

</html>