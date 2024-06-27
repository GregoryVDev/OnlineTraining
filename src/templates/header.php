<nav>
    <div class="navbar">
        <div class="navBar_gauche">
            <div id="menuBurger"><img src="./img/navBar/menuBurger.png" alt="Menu"></div>
            <ul id="menuCategories">
                <li>CATALOGUE</li>
                <li><a href="#">Pantalon</a></li>
                <li><a href="#">Pantalon Chino</a></li>
                <li><a href="#">Polo Manches Courtes</a></li>
                <li><a href="#">Polo Manches Longues</a></li>
                <li><a href="#">Short</a></li>
            </ul>

        </div>
        <div class="logoOnline">
            <img src="./img/navBar/logo-online-training.png" width="80px" alt="Logo Online Training">
        </div>
        <div class="rubrique">
            <div><a class="menuNoir" href="#">NOUVEAUTES</a></div>
            <div><a class="menuRouge" href="#">FEMMME</a></div>
            <div><a class="menuRouge" href="#">HOMME</a></div>
            <div><a class="menuNoir" href="#">CATALOGUE</a></div>
        </div>
        <div class="navBar_droite">
            <div><a href="#"><img src="./img/navBar/iconSearch.png" alt="Rechercher"></a></div>
            <div><a href="./connexion.php"><img src="./img/navBar/account.png" alt="Compte"></a></div>
            <div><a href="#"><img src="./img/navBar/cart.png" alt="Panier"></a></div>
        </div>
    </div>
</nav>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let menuBurger = document.getElementById('menuBurger');
    let menuCategories = document.getElementById('menuCategories');
    let promo = document.getElementById('promo');
    let hideTimeout;

    // Fonction pour afficher le menu
    function showMenu() {
        clearTimeout(hideTimeout); // Annule tout délai de masquage en cours
        menuCategories.style.display = 'block';
        promo.style.display = 'block';
    }

    // Fonction pour masquer le menu
    function hideMenu() {
        hideTimeout = setTimeout(function() {
            menuCategories.style.display = 'none';
            promo.style.display = 'none';
        }, 300); // Ajoute un délai de 300ms avant de masquer le menu
    }

    // Gestion du survol de la souris sur le menu burger
    menuBurger.addEventListener('mouseenter', showMenu);

    // Gestion de la sortie de la souris du menu burger
    menuBurger.addEventListener('mouseleave', function(event) {
        if (!menuCategories.contains(event.relatedTarget)) {
            hideMenu();
        }
    });

    // Gestion de la sortie de la souris du menu catégories
    menuCategories.addEventListener('mouseleave', function(event) {
        if (!menuBurger.contains(event.relatedTarget)) {
            hideMenu();
        }
    });

    // Empêche le masquage du menu lorsque la souris se déplace sur le menu catégories
    menuCategories.addEventListener('mouseenter', showMenu);

    // Initialiser l'état du menu
    hideMenu();
});
</script>