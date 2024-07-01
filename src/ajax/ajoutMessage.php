<?php
// Ce fichier reçoit les données en JSON et enregistre le message
session_start();

// On vérifie la méthode 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // On vérifie si l'utilisateur est connecté
    if (isset($_SESSION['user']['id'])) {
        // L'utilisateur est connecté
        $donneesJson = file_get_contents('php://input');

        // On convertit les données en objet PHP
        $donnees = json_decode($donneesJson);

        // On vérifie si on a un message
        if (isset($donnees->message) && !empty($donnees->message)) {
            // On a un message
        } else {
            // Pas de message
            http_response_code(400);
            echo json_encode(['message' => 'Le message est vide']);
        }
    } else {
        // Non connecté
        http_response_code(400);
        echo json_encode(['message' => "Vous devez vous connecter"]);
    }
} else {
    // Mauvaise méthode
    http_response_code(405);
    echo json_encode(['message' => 'Mauvaise méthode']);
}
