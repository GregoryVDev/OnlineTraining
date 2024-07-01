// On attend de changement du document

window.onload = () => {
  // On va chercher la zone texte
  let texte = document.querySelector("#texte");
  texte.addEventListener("keyup", verifEntree);
};

function verifEntree(e) {
  if (e.key === "Enter") {
    ajoutMessage();
  }
}

function ajoutMessage() {
  // On récupère la valeur dans le champ "texte"
  let message = document.querySelector("#message").value;

  // On vérifie si on a un message
  if (message != "") {
    // On créé un objet JS pour le message
    let donnees = {};
    donnees["message"] = message;

    // On convertit les données en json
    let donneesJson = JSON.stringify(donnees);

    // On envoie les données en POST en Ajax
    // On instancie XMLHttpRequest
    let xmlhttp = new XMLHttpRequest();

    // On gère la réponse
    xmlhttp.onreadystatechange = function () {
      // On vérifie si la requête est terminée (avec le chiffre 4)
      if (this.readyState == 4) {
        // On vérifie si on reçoit un code 201
        if (this.status == 201) {
          // L'enregistrement a fonctionné
          // On efface le champ texte
          document.querySelector("#message").value = "";
        } else {
          // L'enregistrement a échoué
          let reponse = JSON.parse(this.response);
          alert(reponse.message);
        }
      }
    };

    // On ouvre la requête
    xmlhttp.open("POST", "/src/ajax/ajoutMessage.php");

    // On envoie la requête avec les données
    xmlhttp.send(donneesJson);
  }
}

//CODE POUR LE CAROUSSEL
//CODE POUR LE CAROUSSEL
//CODE POUR LE CAROUSSEL
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
//CODE POUR LE CAROUSSEL
//CODE POUR LE CAROUSSEL
//CODE POUR LE CAROUSSEL
//CODE POUR LE CAROUSSEL

// AFFICHE LA BOITE POUR SE DECONNECTER ETC
// AFFICHE LA BOITE POUR SE DECONNECTER ETC
// AFFICHE LA BOITE POUR SE DECONNECTER ETC
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
// AFFICHE LA BOITE POUR SE DECONNECTER ETC
// AFFICHE LA BOITE POUR SE DECONNECTER ETC
// AFFICHE LA BOITE POUR SE DECONNECTER ETC
// AFFICHE LA BOITE POUR SE DECONNECTER ETC
