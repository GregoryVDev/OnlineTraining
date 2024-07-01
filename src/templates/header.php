<nav>
    <div class="navbar">
        <div class="overlay-container">
            <div><img src="./img/navBar/menuBurger.png" alt="Menu">
            </div>
            <div class="overlay">
                <div>
                    <ul id="menuCategories">
                        <hr>
                        <li class="catalogueRouge"><b>CATALOGUE</b></li>
                        <hr>
                        <li><a href="#">Polo Manches Courtes</a></li>
                        <li><a href="#">Polo Manches Longues</a></li>
                        <li><a href="#">Short</a></li>
                        <li><a href="#">Pantalon Chino</a></li>
                        <li><a href="#">Pantalon</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="logoOnline">
            <a href="../index.php">
                <img src="./img/navBar/logo-online-training.png" width="80px" alt="Logo Online Training">
            </a>
        </div>
        <div class="rubrique">
            <div><a class="menuNoir" href="#">NOUVEAUTES</a></div>
            <div><a class="menuRouge" href="#">FEMMME</a></div>
            <div><a class="menuRouge" href="#">HOMME</a></div>
            <div class="overlay-container1">
                <div class="menuNoir">
                    CATALOGUE
                </div>
                <div class="overlay">
                    <div>
                        <ul class="catalogueCategories">
                            <li><a href="#">Polo Manches Courtes</a></li>
                            <li><a href="#">Polo Manches Longues</a></li>
                            <li><a href="#">Short</a></li>
                            <li><a href="#">Pantalon Chino</a></li>
                            <li><a href="#">Pantalon</a></li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>

        <div class="navBar_droite">
            <div>
                <a href="#"><img src="./img/navBar/iconSearch.png" alt="Rechercher"></a>
            </div>
            <div>
                <?php if(!isset($_SESSION["user"])): ?>
                <a href="./connexion.php"><img src="./img/navBar/user.png" alt="Compte"></a>
                <?php else: ?>
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
            <div>
                <a href="#"><img src="./img/navBar/cart.png" alt="Panier"></a>
            </div>
        </div>
    </div>
</nav>

<script>
// AFFICHE LA BOITE POUR SE DECONNECTER ETC 
document.getElementById('account-link').addEventListener('click', function(event) {
    event.preventDefault(); // Empêche le lien de suivre sa destination
    document.querySelector('.deconnexion').classList.toggle('visible');
});

// Optionnel : Fermer la boîte si on clique en dehors
document.addEventListener('click', function(event) {
    var deconnexionBox = document.querySelector('.deconnexion');
    var accountLink = document.getElementById('account-link');
    if (!deconnexionBox.contains(event.target) && !accountLink.contains(event.target)) {
        deconnexionBox.classList.remove('visible');
    }
});
</script>