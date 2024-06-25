

<nav>
    <div class="navbar">
        <div class="navBar_gauche">
            <label for="menuBurger"><img src="./img/navBar/menuBurger.png" width="20px" alt="Menu"></label>
            <input type="checkbox" id="menuBurger">
            <ul id="menuCategories">
                <li>CATEGORIES</li>
                <li><a href="">TOP, TEE-SHIRT</li>
                <li><a href="">CHEMISIER, BLOUSE</li>
                <li><a href="">PULL, GILET</a></li>
                <li><a href="">JUPE, SHORT</a></li>
                <li><a href="">ROBE, COMBINAISON</a></li>
                <li><a href="">PANTALON, LEGGING</a></li>
                <li><a href="">HOMEWEAR, SPORTWEAR</a></li>
            </ul>
            <div id="promo">
                <img src="../img/footer/facebook.png">
            </div>
        </div>
        <div class="logoOnline">
            <img src="./img/navBar/logo-online-training.png" width="80px" alt="Logo Online Training">
        </div>
        <div class="rubrique">
            <div><a class="menuNoir" href="">TENDANCE</a></div>
            <div><a class="menuRouge" href="">FEMMME</a></div>
            <div><a class="menuRouge" href="">HOMME</a></div>
            <div><a class="menuNoir" href="">PETITS/PRIX</a></div>
        </div>
        <div class="navBar_droite">
            <div><a href=""><img src="./img/navBar/iconSearch.png" alt="Rechercher"></a></div>
            <div><a href=""><img src="./img/navBar/account.png" alt="Compte"></a></div>
            <div><a href=""><img src="./img/navBar/cart.png" alt="Panier"></a></div>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    let menuBurger = document.getElementById('menuBurger');
    let menuCategories = document.getElementById('menuCategories');
    let promo = document.getElementById('promo');

    menuBurger.addEventListener('change', function() {
        if (this.checked) {
            menuCategories.classList.add('active');
            promo.style.display = 'block';
        } else {
            menuCategories.classList.remove('active');
            promo.style.display = 'none';
        }
    });

    document.addEventListener('click', function(event) {
        if (!menuBurger.contains(event.target) && !menuCategories.contains(event.target) && !promo.contains(event.target)) {
            menuCategories.classList.remove('active');
            menuBurger.checked = false;
            promo.style.display = 'none';
        }
    });
});
</script>