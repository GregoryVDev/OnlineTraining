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