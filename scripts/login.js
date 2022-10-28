const form = document.getElementById("form");
const matricule = document.getElementById("matricule");
const password = document.getElementById("password");

form.addEventListener("submit", (e) => {
  if (!checkInputs()) {
    e.preventDefault();
  }
});

const setError = (element, message) => {
  const formControl = element.parentElement;
  const errorDisplay = formControl.querySelector(".error");

  errorDisplay.innerText = message;
  formControl.classList.add("error");
  formControl.classList.remove("success");
};

const setSuccess = (element) => {
  const formControl = element.parentElement;
  const errorDisplay = formControl.querySelector(".error");

  errorDisplay.innerText = "";
  formControl.classList.add("success");
  formControl.classList.remove("error");
};

const checkInputs = () => {
  const matriculeValue = matricule.value.trim();
  const passwordValue = password.value.trim();
  let etat1 = false;
  let etat2 = false;
  if (matriculeValue === "") {
    setError(matricule, "matricule obligatoire");
  } else {
    setSuccess(matricule);
    etat1 = true;
  }

  if (passwordValue === "") {
    setError(password, "mot de passe obligatoire");
    
  } else {
    setSuccess(password);
    etat2 = true;
  }
  if (etat1 === true && etat2 === true) {
    return true;
  } else {
    return false;
  }
};
