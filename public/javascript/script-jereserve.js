let divestouvert1 = false;
function plusToMoins() {
  if (divestouvert1) {
    document.getElementById("cache1").style.display = "none";
    divestouvert1 = false;
  } else {
    document.getElementById("cache1").style.display = "block";
    divestouvert1 = true;
  }
}
document.getElementById("tiret1").addEventListener("click", plusToMoins);

let divestouvert2 = false;
function plusToMoins2() {
  if (divestouvert2) {
    document.getElementById("cache2").style.display = "none";
    divestouvert2 = false;
  } else {
    document.getElementById("cache2").style.display = "block";
    divestouvert2 = true;
  }
}
document.getElementById("tiret2").addEventListener("click", plusToMoins2);

let divestouvert3 = false;
function plusToMoins3() {
  if (divestouvert3) {
    document.getElementById("cache3").style.display = "none";
    divestouvert3 = false;
  } else {
    document.getElementById("cache3").style.display = "block";
    divestouvert3 = true;
  }
}
document.getElementById("tiret3").addEventListener("click", plusToMoins3);

//
function et1ToEt2() {
  document.getElementById("formulaire-e2").style.display = "block";
}
document.getElementById("suivant1").addEventListener("click", et1ToEt2);

function et2ToEt3() {
  document.getElementById("formulaire-e3").style.display = "block";
}
document.getElementById("suivant2").addEventListener("click", et2ToEt3);

function et3ToEt4() {
  document.getElementById("formulaire-e4").style.display = "block";
}
document.getElementById("suivant3").addEventListener("click", et3ToEt4);

function et4ToEtInsc() {
  document.getElementById("formulaire-e5").style.display = "block";
}
document.getElementsById("creeruncompte").addEventListener("click", et4ToEtInsc);