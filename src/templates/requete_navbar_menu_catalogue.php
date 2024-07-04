<?php

// Requête pour récupérer toutes les catégories pour les vetement (utile pour la navbar)
$sql_categories_burger = "SELECT * FROM categories";
$query_categories_burger = $db->prepare($sql_categories_burger);
$query_categories_burger->execute();
$catalogue_type_burger = $query_categories_burger->fetchAll(PDO::FETCH_ASSOC);

// Requête pour récupérer toutes les catégories pour les vetement (utile pour la navbar)
$sql_categories = "SELECT * FROM categories";
$query_categories = $db->prepare($sql_categories);
$query_categories->execute();
$catalogue_type = $query_categories->fetchAll(PDO::FETCH_ASSOC);

?>