
function ouvertureInsc() {
    document.getElementById("container_formulaire_ins").style.display = "block";
    document.getElementById("valider").innerHTML = "Valider";
  }

  document
    .getElementById("creeruncompte")
    .addEventListener("click", ouvertureInsc);

  function toggleForm(formId) {
    document.getElementById('container_formulaire_con').classList.toggle('hidden');
    document.getElementById('container_formulaire_ins').classList.toggle('hidden');
  }
  document.getElementById('annuler').addEventListener('click', function () {
    document.getElementById('container_formulaire_ins').style.display = 'none';
});