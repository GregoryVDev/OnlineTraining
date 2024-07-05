<?php
session_start();

// On vérifie si la requête a été envoyé avec la method POST et si la clé "id" est définie dans les données POST. Cela signifie que le formulaire d'ajout au panier a été envoyé
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    // On récupère les données du produit depuis le formulaire
    $id_produit = $_POST["id"];
    $taille = $_POST["taille"];
    $couleur = $_POST["couleur"];
    $nom_produit = $_POST["nom_produit"];
    $prix_ht = $_POST["prix_ht"];
    $image_produit = $_POST["image_produit"];
    $quantite = 1; // Vous pouvez ajouter une entrée de quantité dans le formulaire si nécessaire

    // Initialiser le panier si nécessaire
    // On vérifie si la clé "panier" n'est pas défini dans la session
    if (!isset($_SESSION['panier'])) {
        // Si ce n'est pas le cas, elle initialise un tableau vide pour le panier dans la session (il créé un panier)
        $_SESSION['panier'] = [];
    }

    // Vérifier si le produit est déjà dans le panier

    $found = false;
    foreach ($_SESSION['panier'] as &$produit) {
        if ($produit['id'] == $id_produit && $produit['taille'] == $taille && $produit['couleur'] == $couleur) {
            $produit['quantite'] += $quantite;
            $found = true;
            break;
        }
    }
    unset($produit);

    if (!$found) {
        // Ajouter le produit au panier
        $item = [
            'id' => $id_produit,
            'nom_produit' => $nom_produit,
            'prix_ht' => $prix_ht,
            'image_produit' => $image_produit,
            'taille' => $taille,
            'couleur' => $couleur,
            'quantite' => $quantite,
        ];
        $_SESSION['panier'][] = $item;
    }

    header("Location: panier.php");
    exit();
}
