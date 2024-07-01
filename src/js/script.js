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
