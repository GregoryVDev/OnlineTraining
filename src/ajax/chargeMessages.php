<?php
// On vérifie la méthode utilisée
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    // On est en GET
    // On vérifie si on a reçu un id
    if (isset($_GET['lastId'])) {
        // On récupère l'id et on le nettoie 
        $lastId = (int)strip_tags($_GET['id']);
    }
} else {
    // Mauvaise méthode
    http_response_code(405);
    echo json_encode(['message' => 'Mauvaise méthode']);
}
