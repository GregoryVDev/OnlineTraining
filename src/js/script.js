setInterval(loadMessages, 100);
window.onload = loadMessages; // Charger les messages immédiatement au chargement de la page



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
