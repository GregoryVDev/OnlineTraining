<!DOCTYPE html>
<html lang="fr">

<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire Produits</title>
</head>

<body>
    <?php
    include '../../templates/navbar_dashboard.php';
    ?>
    <div class="conteneur_login">
        <div class="conteneur_form_form">
            <h1>AJOUTER UN PRODUIT: </h1>
            <form action="./create_produits.php" method="post" enctype="multipart/form-data">

                <label for="image_produit">Image:</label>
                <input type="file" id="image_produit" name="image_produit" value="">
                <br>
                <label for="alt">Description de l'image:</label>
                <input type="text" id="alt" name="alt" required>
                <br>
                <label for="genre">Genre:</label>
                <select id="genre" name="genre" required>
                    <option value="">Sélectionnez un Genre</option>
                    <option value="Homme">Homme</option>
                    <option value="Femme">Femme</option>
                </select>
                <br>
                <label for="reference">Référence:</label>
                <input type="text" id="reference" name="reference" required>
                <br>
                <label for="marque">Marque:</label>
                <input type="text" id="marque" name="marque" required>
                <br>
                <label for="categorie_id">Catégorie:</label>
                <select id="categorie_id" name="categorie_id" required>
                    <option value="">Sélectionnez une catégorie</option>
                    <?php
                    require_once("../../connect.php");
                    // Assumez que la connexion à la base de données est déjà établie
                    $sql = "SELECT id, type FROM categories";
                    $query = $db->query($sql);
                    while ($categories = $query->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value=\"{$categories['id']}\">{$categories['type']}</option>";
                    }
                    ?>
                </select>
                <br>
                <label for="couleur">Couleur:</label>
                <input type="text" id="couleur" name="couleur" required>
                <br>
                <label for="matiere">Matière:</label>
                <input type="text" id="matiere" name="matiere" required>
                <br>
                <label for="motif">Motif:</label>
                <input type="text" id="motif" name="motif" required>
                <br>
                <label for="description">Description:</label>
                <input type="text" id="description" name="description" required>
                <br>
                <label for="quantite">Quantité:</label>
                <input type="text" id="quantite" name="quantite" required>
                <br>
                <label for="prix_ht">Prix HT:</label>
                <input type="text" id="prix_ht" name="prix_ht" required>
                <br>
                <br>
                <button type="submit" class="login-btn">Ajouter</button>
            </form>

            <br>
            <button class="login-btn"><a href="./dashboard_produits.php">Retour</a></button>
        </div>
    </div>
</body>

</html>