<?php

date_default_timezone_set('Europe/Paris');

session_start();
require_once("./connect.php");

$current_user_id = $_SESSION["user"]["user_id"];

// Requête SQL pour joindre les tables messagerie et users et récupérer les prénoms
$sql = "
    SELECT m.*, u.prenom, DATE_FORMAT(CONVERT_TZ(m.time, '+00:00', '+02:00'), '%H:%i') AS formatted_time
    FROM messagerie m
    JOIN users u ON m.user_id = u.id
    ORDER BY m.time ASC
";

$query = $db->prepare($sql);
$query->execute();

while ($message = $query->fetch(PDO::FETCH_ASSOC)) {
    $message_class = ($message["user_id"] == $current_user_id) ? 'sent' : 'received';
?>
<div class="message <?= $message_class ?>">
    <p><strong><?= htmlspecialchars($message["prenom"]); ?> :</strong>
        <?= nl2br(htmlspecialchars($message["message"])); ?></p>
    <small>
        <div class="message_time"><?= (new DateTime($message['time']))->format('d/m/Y H:i'); ?></div>
    </small>
</div>
<?php
}
?>