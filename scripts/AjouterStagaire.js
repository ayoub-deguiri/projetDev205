const cef = document.getElementById("cef");
const nom = document.getElementById("nom");
const prenom = document.getElementById("prenom");
const form = document.getElementById("form");
const error = document.getElementById("error");
const error2 = document.getElementById("error2");
const error3 = document.getElementById("error3");

let etat1 = false;
let etat2 = false;
let etat3 = false;

form.addEventListener("keyup", () => {
  let cefValue = cef.value.trim();
  let nomValue = nom.value.trim();
  let prenomValue = prenom.value.trim();
  errorValue = error.value;
  if (cefValue == "") {
    error.innerText = "cef obligatoire";

    etat1 = false;
  } else {
    error.innerHTML = "";
    etat1 = true;
  }

  if (nomValue == "") {
    error2.innerText = "nom obligatoire";

    etat2 = false;
  } else {
    error2.innerHTML = "";
    etat2 = true;
  }

  if (prenomValue == "") {
    error3.innerText = "prenom obligatoire";

    etat3 = false;
  } else {
    error3.innerHTML = "";

    etat3 = true;
  }
});

form.addEventListener("submit", (e) => {
  if (etat1 == false || etat2 == false || etat3 == false) {
    e.preventDefault();
  }
});

form.addEventListener("submit", () => {
  let cefValue = cef.value.trim();
  let nomValue = nom.value.trim();
  let prenomValue = prenom.value.trim();
  errorValue = error.value;
  if (cefValue == "") {
    error.innerText = "cef obligatoire";

    etat1 = false;
  } else {
    error.innerHTML = "";
    etat1 = true;
  }

  if (nomValue == "") {
    error2.innerText = "nom obligatoire";

    etat2 = false;
  } else {
    error2.innerHTML = "";
    etat2 = true;
  }

  if (prenomValue == "") {
    error3.innerText = "prenom obligatoire";

    etat3 = false;
  } else {
    error3.innerHTML = "";

    etat3 = true;
  }
});
