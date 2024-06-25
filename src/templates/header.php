

<nav>
    <div class="navbar">
        <div class="navBar_gauche">
            <label for="menuBurger"><img src="./img/navBar/menuBurger.png" width="20px" alt="Menu"></label>
            <input type="checkbox" id="menuBurger">
            <ul id="menuItems">
                <li>CATEGORIES</li>
                <li><a href="">TOP, TEE-SHIRT</li>
                <li><a href="">CHEMISIER, BLOUSE</li>
                <li><a href="">PULL, GILET</li>
                <li><a href="">JUPE, SHORT</li>
                <li><a href="">ROBE, COMBINAISON</li>
                <li><a href="">PANTALON, LEGGING</li>
                <li><a href="">HOMEWEAR, SPORTWEAR</li>
            </ul>
            <div id="additionalContent">
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
            <div><img src="./img/navBar/iconSearch.png" alt="Rechercher"></div>
            <div><img src="./img/navBar/account.png" alt="Compte"></div>
            <div><img src="./img/navBar/cart.png" alt="Panier"></div>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    var menuBurger = document.getElementById('menuBurger');
    var menuItems = document.getElementById('menuItems');
    var additionalContent = document.getElementById('additionalContent');

    menuBurger.addEventListener('change', function() {
        if (this.checked) {
            menuItems.classList.add('active');
            additionalContent.style.display = 'block';
        } else {
            menuItems.classList.remove('active');
            additionalContent.style.display = 'none';
        }
    });

    document.addEventListener('click', function(event) {
        if (!menuBurger.contains(event.target) && !menuItems.contains(event.target) && !additionalContent.contains(event.target)) {
            menuItems.classList.remove('active');
            menuBurger.checked = false;
            additionalContent.style.display = 'none';
        }
    });
});
</script>