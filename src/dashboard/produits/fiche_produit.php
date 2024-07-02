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
    <div class="form_produit">
        <div><img src="../../<?= htmlspecialchars($produit["image_produit"]) ?>" alt="<?= htmlspecialchars($produit["nom_produit"]) ?>" width='400px'></div>
        <form class="formulaire_produit" method="post" enctype="multipart/form-data">
            <input type="hidden" name="image_produit_current" value="<?= htmlspecialchars($produit["image_produit"]) ?>">
            <input class="form-control" type="text" placeholder="NOM" aria-label=".form-control-sm example" id="nom_produit" name="nom_produit" value="<?= htmlspecialchars($produit["nom_produit"]) ?>" disabled readonly>
            <select class="form-select" aria-label="Default select example" id="genre" name="genre" disabled readonly>
                <option value="<?= htmlspecialchars($produit["genre"]) ?>"><?= htmlspecialchars($produit["genre"]) ?></option>
                <option value="HOMME">HOMME</option>
                <option value="FEMME">FEMME</option>
            </select>
            <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="REFERENCE" id="reference" name="reference" value="<?= htmlspecialchars($produit["reference"]) ?>" disabled readonly>
            <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="MARQUE" id="marque" name="marque" value="<?= htmlspecialchars($produit["marque"]) ?>" disabled readonly>
            <select class="form-select" aria-label="Default select example" id="categorie_id" name="categorie_id" disabled readonly>
                <option value=""><?= htmlspecialchars($produit["categorie_id"]) ?></option>
                <?php
                $sql = "SELECT id, type FROM categories";
                $query = $db->query($sql);
                while ($categories = $query->fetch(PDO::FETCH_ASSOC)) {
                    $selected = $categories['id'] == $produit["categorie_id"] ? "selected" : "";
                    echo "<option value=\"{$categories['id']}\" $selected>{$categories['type']}</option>";
                }
                ?>
            </select>
            <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="COULEUR" id="couleur" name="couleur" value="<?= htmlspecialchars($produit["couleur"]) ?>" disabled readonly>
            <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="COULEUR" id="couleur" name="couleur" value="<?= htmlspecialchars($produit["couleur"]) ?>" disabled readonly>
            <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="MATIERE" id="matiere" name="matiere" value="<?= htmlspecialchars($produit["matiere"]) ?>" disabled readonly>
            <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="MOTIF" id="motif" name="motif" value="<?= htmlspecialchars($produit["motif"]) ?>" disabled readonly>
            <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="DESCRIPTION" id="description" name="description" value="<?= htmlspecialchars($produit["description"]) ?>" disabled readonly>
            <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="TAILLE" id="taille" name="taille" value="<?= htmlspecialchars($produit["taille"]) ?>" disabled readonly>
            <input type="number" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="QUANTITE" id="quantite" name="quantite" value="<?= htmlspecialchars($produit["quantite"]) ?>" disabled readonly>
            <input type="number" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="PRIX HT" id="prix_ht" name="prix_ht" value="<?= htmlspecialchars($produit["prix_ht"]) ?>" disabled readonly>
        </form>

    </div>



</body>

</html>