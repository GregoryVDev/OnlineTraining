<nav>
    <div class="navbar">
        <div class="navBar_gauche">
            <div id="menuBurger"><img src="./img/navBar/menuBurger.png" alt="Menu"></div>
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
        <div class="logoOnline">
            <img src="./img/navBar/logo-online-training.png" width="80px" alt="Logo Online Training">
        </div>
        <div class="rubrique">
            <div><a class="menuNoir" href="#">NOUVEAUTES</a></div>
            <div><a class="menuRouge" href="#">FEMMME</a></div>
            <div><a class="menuRouge" href="#">HOMME</a></div>
            <div id="catalogue"><span>CATALOGUE</span>
                <ul id="catalogueCategories">
                    <li><a href="#">Polo Manches Courtes</a></li>
                    <li><a href="#">Polo Manches Longues</a></li>
                    <li><a href="#">Short</a></li>
                    <li><a href="#">Pantalon Chino</a></li>
                    <li><a href="#">Pantalon</a></li>
                </ul>
            </div>

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
    let catalogue = document.getElementById('catalogue');
    let catalogueCategories = document.getElementById('catalogueCategories');
    let hideTimeout;

    function showMenu(menu) {
        clearTimeout(hideTimeout);
        menu.style.display = 'block';
    }

    function hideMenu(menu) {
        hideTimeout = setTimeout(function() {
            menu.style.display = 'none';
        }, 300);
    }

    menuBurger.addEventListener('mouseenter', function() {
        showMenu(menuCategories);
    });

    menuBurger.addEventListener('mouseleave', function(event) {
        if (!menuCategories.contains(event.relatedTarget)) {
            hideMenu(menuCategories);
        }
    });

    menuCategories.addEventListener('mouseleave', function(event) {
        if (!menuBurger.contains(event.relatedTarget)) {
            hideMenu(menuCategories);
        }
    });

    menuCategories.addEventListener('mouseenter', function() {
        showMenu(menuCategories);
    });

    catalogue.addEventListener('mouseenter', function() {
        showMenu(catalogueCategories);
    });

    catalogue.addEventListener('mouseleave', function(event) {
        if (!catalogueCategories.contains(event.relatedTarget)) {
            hideMenu(catalogueCategories);
        }
    });

    catalogueCategories.addEventListener('mouseleave', function(event) {
        if (!catalogue.contains(event.relatedTarget)) {
            hideMenu(catalogueCategories);
        }
    });

    catalogueCategories.addEventListener('mouseenter', function() {
        showMenu(catalogueCategories);
    });

    hideMenu(menuCategories);
    hideMenu(catalogueCategories);
});
</script>