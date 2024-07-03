//CODE POUR LE CAROUSSEL
document.addEventListener("DOMContentLoaded", () => {
  const ligne = document.querySelector(".ligne");
  const cards = Array.from(document.querySelectorAll(".carte"));
  const leftArrow = document.querySelector(".arrow-left");
  const rightArrow = document.querySelector(".arrow-right");
  const cardWidth = cards[0].clientWidth + 20; // 20 est la marge droite
  let index = cards.length; // Commence à la fin pour afficher la première série après les clones

  // Clone toutes les cartes et les ajoute à la fin
  cards.forEach((card) => {
    const clone = card.cloneNode(true);
    ligne.appendChild(clone);
  });

  // Clone toutes les cartes et les ajoute au début
  [...cards].reverse().forEach((card) => {
    const clone = card.cloneNode(true);
    ligne.insertBefore(clone, cards[0]);
  });

  // Ajuster la largeur de la ligne
  ligne.style.width = `${cards.length * 3 * cardWidth}px`;
  ligne.style.transform = `translateX(${-index * cardWidth}px)`;

  function showNextImage() {
    index++;
    updateCarousel();
  }

  function showPreviousImage() {
    index--;
    updateCarousel();
  }

  function updateCarousel() {
    ligne.style.transition = "transform 0.5s ease-in-out";
    const translateX = -index * cardWidth;
    ligne.style.transform = `translateX(${translateX}px)`;

    ligne.addEventListener("transitionend", handleTransitionEnd);
  }

  function handleTransitionEnd() {
    if (index >= cards.length * 2) {
      // Quand on atteint les clones à la fin
      ligne.style.transition = "none";
      index = cards.length; // Réinitialiser à la première série de cartes
      ligne.style.transform = `translateX(${-index * cardWidth}px)`;
    } else if (index < cards.length) {
      // Quand on atteint les clones au début
      ligne.style.transition = "none";
      index = cards.length * 2 - 1; // Réinitialiser à la dernière série de cartes
      ligne.style.transform = `translateX(${-index * cardWidth}px)`;
    }
    ligne.removeEventListener("transitionend", handleTransitionEnd);
  }

  leftArrow.addEventListener("click", showPreviousImage);
  rightArrow.addEventListener("click", showNextImage);

  setInterval(showNextImage, 4000); // Un intervalle de 4 secondes pour une meilleure visibilité
});

// AFFICHE LA BOITE POUR SE DECONNECTER ETC
document
  .getElementById("account-link")
  .addEventListener("click", function (event) {
    event.preventDefault(); // Empêche le lien de suivre sa destination
    document.querySelector(".deconnexion").classList.toggle("visible");
  });

// Optionnel : Fermer la boîte si on clique en dehors
document.addEventListener("click", function (event) {
  var deconnexionBox = document.querySelector(".deconnexion");
  var accountLink = document.getElementById("account-link");
  if (
    !deconnexionBox.contains(event.target) &&
    !accountLink.contains(event.target)
  ) {
    deconnexionBox.classList.remove("visible");
  }
});
