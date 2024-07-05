<?php
session_start();
require_once("../../connect.php");
if (isset($_GET["id"]) && !empty($_GET["id"])) {
    require_once("../../connect.php");
    // echo $_GET["id"];
    $id = strip_tags($_GET["id"]);
    $sql = "SELECT * FROM produits WHERE id = :id";
    $query = $db->prepare($sql);
    $query->bindValue(":id", $id, PDO::PARAM_INT);
    $query->execute();
    $produit = $query->fetch();
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/dashboard/dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title><?= $produit["nom_produit"] ?></title>
</head>

<body>
    <?php
    include '../../templates/navbar_dashboard.php';
    ?>
    <h2 class="titre_dash">LE PRODUIT : <?= htmlspecialchars($produit["nom_produit"]) ?></h2>
    <div class="form_fiche_produit">
        <div><img src="../../<?= htmlspecialchars($produit["image_produit"]) ?>" alt="<?= htmlspecialchars($produit["nom_produit"]) ?>" width='400px'></div>
        <form class="formulaire_fiche_produit" method="post" enctype="multipart/form-data">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="nom_produit" placeholder="NOM" name="nom_produit" value="<?= htmlspecialchars($produit["nom_produit"]) ?>" disabled readonly>
                <label for="floatingInput">NOM</label>
            </div>
            <div class="form-floating">
                <select class="form-select" aria-label="Floating label select example" id="genre" name="genre" disabled readonly>
                    <option value="<?= htmlspecialchars($produit["genre"]) ?>" selected><?= htmlspecialchars($produit["genre"]) ?></option>
                    <option value="HOMME">HOMME</option>
                    <option value="FEMME">FEMME</option>
                </select>
                <br>
                <label for="floatingSelect">GENRE</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="reference" placeholder="REFERENCE" name="reference" value="<?= htmlspecialchars($produit["reference"]) ?>" disabled readonly>
                <label for="floatingInput">REFERENCE</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="marque" placeholder="MARQUE" name="marque" value="<?= htmlspecialchars($produit["marque"]) ?>" disabled readonly>
                <label for="floatingInput">MARQUE</label>
            </div>
            <div class="form-floating">
                <select class="form-select" aria-label="Floating label select example" id="categorie_id" name="categorie_id" disabled readonly>
                    <option value="<?= htmlspecialchars($produit["categorie_id"]) ?>" selected><?= htmlspecialchars($produit["categorie_id"]) ?></option>
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
                <label for="floatingSelect">CATEGORIE</label>
            </div>
            <br>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="couleur" placeholder="COULEUR" name="couleur" value="<?= htmlspecialchars($produit["couleur"]) ?>" disabled readonly>
                <label for="floatingInput">COULEUR</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="matiere" placeholder="MATIERE" name="matiere" value="<?= htmlspecialchars($produit["matiere"]) ?>" disabled readonly>
                <label for="floatingInput">MATIERE</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="motif" placeholder="MOTIF" name="motif" value="<?= htmlspecialchars($produit["motif"]) ?>" disabled readonly>
                <label for="floatingInput">MOTIF</label>
            </div>
            <div class="form-floating mb-3">
                <textarea type="" class="form-control" id="description" placeholder="DESCRIPTION" name="description" disabled readonly><?= htmlspecialchars($produit["description"]) ?></textarea>
                <label for="floatingInput">DESCRIPTION</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="taille" placeholder="TAILLE" name="taille" value="<?= htmlspecialchars($produit["taille"]) ?>" disabled readonly>
                <label for="floatingInput">TAILLE</label>
            </div>
            <div class="form-floating mb-3">
                <input type="number" class="form-control" placeholder="QUANTITE" id="quantite" name="quantite" value="<?= htmlspecialchars($produit["quantite"]) ?>" disabled readonly min="0">
                <label for="floatingInput">QUANTITE</label>
            </div>
            <div class="form-floating mb-3">
                <input type="number" class="form-control" placeholder="PRIX HT" id="prix_ht" name="prix_ht" value="<?= htmlspecialchars($produit["prix_ht"]) ?>" disabled readonly min="0">
                <label for="floatingInput">PRIX HT</label>
            </div>
        </form>
    </div>
</body>

</html>