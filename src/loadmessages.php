<?php

session_start();
require_once("./connect.php");

$sql = "SELECT * FROM messagerie";
$query = $db->prepare($sql);

$query->execute();

while ($message = $query->fetch(PDO::FETCH_ASSOC)) {
?>
    <div class="message">
        <h4><?= htmlspecialchars($message["nom"]) . " " . htmlspecialchars($message["prenom"]); ?></h4>
        <p><?= $message["message"]; ?></p>
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