document.addEventListener("DOMContentLoaded", function () {
  // Sélectionnez l'élément h1
  var myT = document.getElementById("myT");

  // Ajoutez la classe 'anime' après un délai de 1 seconde
  setTimeout(function () {
    myT.classList.add("anime");
  }, 1000);
});
/*Cette fonction est responsable de l'affichage ou de la masquage de la barre de navigation.*/

function toggleNav() {
  var nav = document.querySelector("#header nav");
  if (nav.style.display === "none" || nav.style.display === "") {
    nav.style.display = "block";
  } else {
    nav.style.display = "none";
  }
}

//conserver les infos lors du clique reserver

function reserver(choix, image, titre, description) {
  // Créer un objet avec toutes les informations du massage
  var massageInfo = {
    choix: choix,
    image: image,
    titre: titre,
    description: description,
  };

  // // Stocker l'objet dans le stockage local
  localStorage.setItem("choixMassage", JSON.stringify(massageInfo));

  // Rediriger vers la page suivante
  window.location.href = "jereserve1.html";
}

// Récupérer le choix du stockage local
var choixMassageJSON = localStorage.getItem("choixMassage");

if (choixMassageJSON) {
  //     // Convertir la chaîne JSON en objet JavaScript
  var choixMassage = JSON.parse(choixMassageJSON);

  // Afficher les informations sur la page
  var infoMassageDiv = document.getElementById("infoMassage");
  infoMassageDiv.innerHTML +=
    "<img src='" + choixMassage.image + "' alt='" + choixMassage.titre + "'>";
  infoMassageDiv.innerHTML += "<h2>" + choixMassage.titre + "</h2>";
  infoMassageDiv.innerHTML += "<p>" + choixMassage.description + "</p>";
} else {
  // Gérer le cas où le choix n'est pas défini
  document.body.innerHTML += "<p>Aucun choix de massage sélectionné</p>";
}
  // afficher le message d'erreur lorsque l'utilisateur commence à taper dans le champ de mot de passe 

  $(document).ready(function() {
    $('#pwd, #pwdConfirmation').on('input', function() {
        var password = $('#pwd').val();
        var confirmPassword = $('#pwdConfirmation').val();
        if (password.length > 0 && !/(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}/.test(password)) {
            $('.password-help').show();
        } else {
            $('.password-help').hide();
        }
    });
}); 