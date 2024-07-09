<?php
// Assurez-vous que la session est démarrée
// session_start();

// Compter le nombre de produits dans le panier
$panier_quantite = 0;
if (isset($_SESSION['panier'])) {
    foreach ($_SESSION['panier'] as $produit) {
        $panier_quantite += $produit['quantite'];
    }
}
?>

<nav>
    <div class="navbar">
        <div class="overlay-container1">
            <div><img src="../img/navBar/menuBurger.png" alt="Menu">
            </div>
            <div class="overlay_1">
                <div>
                    <ul id="menuCategories">

                        <?php foreach($catalogue_type_burger as $catalogue_type_burger): ?>
                        <li>
                            <a href="categories.php?categories_type=<?= urlencode($catalogue_type_burger["type"]) ?>">
                                <?= ($catalogue_type_burger["type"]) ?>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="logoOnline">
            <a href="../index.php">
                <img src="./img/navBar/logo-online-training.png" alt="Logo Online Training">
            </a>
        </div>
        <div class="rubrique">
            <div><a class="menuRouge" href="categories.php?genre=femme">FEMME</a></div>
            <div><a class="menuRouge" href="categories.php?genre=homme">HOMME</a></div>
            <div class="overlay-container2">
                <div class="menuNoir" href="#"> CATALOGUE</a></div>
                <div class="overlay_2">

                    <ul class="catalogueCategories">
                        <?php foreach($catalogue_type as $catalogue_type): ?>
                        <li>
                            <a href="categories.php?categories_type=<?= urlencode($catalogue_type["type"]) ?>">
                                <?= ($catalogue_type["type"]) ?>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>

                </div>
            </div>

        </div>

        <div class="navBar_droite">
            <div>
                <a href="#"><img src="./img/navBar/iconSearch.png" alt="Rechercher"></a>
            </div>
            <div>
                <?php if (!isset($_SESSION["user"])) : ?>
                <a href="./connexion.php"><img src="./img/navBar/user.png" alt="Compte"></a>
                <?php else : ?>
                <ul class="container-deconnexion">
                    <li>
                        <a href="./connexion.php">
                            <img src="./img/navBar/user_connect.png" alt="Compte" id="account-link">
                        </a>
                    </li>
                    <li class="deconnexion">
                        <a href="../deconnexion.php" id="logout-link">
                            <div class="logout">
                                <img src="./img/navBar/x.png" alt="deconnexion logo">
                                <span>Déconnexion</span>
                            </div>
                        </a>
                        <a href="../messagerie.php">
                            <div class="logout">
                                <img src="./img/navBar/envelope.png" alt="deconnexion logo">
                                <span>Messagerie</span>
                            </div>
                        </a>
                        <a href="../dashboard/produits/dashboard_produits.php">
                            <div class="logout">
                                <img src="./img/navBar/dashboard.png" alt="deconnexion logo">
                                <span>Dashboard</span>
                            </div>
                        </a>
                    </li>
                </ul>
                <?php endif; ?>
            </div>
            <div class="overlay-container3">
                <?php if (empty($_SESSION['panier'])) : ?>
                <img src="./img/navBar/cart.png" alt="Panier">
                <?php else : ?>
                <a href="panier.php">
                    <img src="./img/navBar/cart_user.png" alt="Panier">
                    <?php if ($panier_quantite > 0) : ?>
                    <span><sup><?= $panier_quantite ?></sup></span>
                    <?php endif; ?>
                </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    </div>
</nav>