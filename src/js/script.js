// Variables globales
let lastId = 0; // id du dernier message affiché

// On attend de changement du document

window.onload = () => {
  // On va chercher la zone texte
  let texte = document.querySelector("#message");
  texte.addEventListener("keyup", verifEntree);

  // On charge les nouveaux messages
  setInterval(chargeMessages, 1000);
};

// On charge les derniers messages en Ajax et les insères dans la discussion
function chargeMessages() {
  // On instancie XMLHttpRequest
  let xmlhttp = new XMLHttpRequest();

  // On gère la réponse
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4) {
      if (this.status == 200) {
        // On a une réponse
        // On convertit la réponse en objet JS
        let messages = JSON.parse(this.response);

        // On retourne l'object
        message.reverse();

        // On récupère la div #discussion
        let discussion = document.querySelector("#discussion");

        // Un message parmi les messages
        for (let message of messages) {
          // On transforme la date du message en JS
          let dateMessage = new Date(message.created_at);

          // On ajout le contenu avant le contenu actuel de discussion
          discussion.innerHTLM =
            `<p>${
              message.user_id
            } a écrit le ${dateMessage.toLocaleString()} : ${
              message.message
            }</p>` + discussion.innerHTML;

          // On met à jour le lastId
          lastId = message.id;
        }
      } else {
        // On gère les erreurs
        let erreur = JSON.parse(this.response);
        alert(erreur.message);
      }
    }
  };

  // On ouvre la requête
  xmlhttp.open("GET", "/src/ajax/chargeMessages.php?lastId=" + lastId);

  // On envoie
  xmlhttp.send();
}

function verifEntree(e) {
  if (e.key === "Enter") {
    ajoutMessage();
  }
}

function ajoutMessage() {
  // On récupère la valeur dans le champ "texte"
  let message = document.querySelector("#message").value;

  // On vérifie si on a un message
  //   if (message != "") {
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
// }
