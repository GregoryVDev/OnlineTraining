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
            <div><a class="menuRouge" href="#">FEMME</a></div>
            <div><a class="menuRouge" href="#">HOMME</a></div>
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
                <a href="panier.php"><img src="./img/navBar/cart.png" alt="Panier"></a>

                <!-- <div class="overlay_3"> -->
                <div>

                    <!-- <?php include('menu_panier.php');?></li> -->

                </div>
            </div>
        </div>
    </div>
    </div>
</nav>