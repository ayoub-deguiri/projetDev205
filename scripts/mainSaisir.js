function CheckSaisie(event) {
  var formateur = document.getElementById("formateur").value;
  var Date = document.getElementById("date").value;
  var Module = document.getElementById("module").value;
  var Groupe = document.getElementById("groupe").value;
  var Année = document.getElementById("annee").value;
  var AnnéeSc = document.getElementById("anneeSc").value;
  var Filiére = document.getElementById("filiere").value;

  if (
    formateur == "" ||
    Date == "" ||
    Module == "" ||
    Groupe == "" ||
    Année == "" ||
    AnnéeSc == "" ||
    Filiére == ""
  ) {
    event.preventDefault();
    alert("Veuillez remplir tout les champs ");
  }
}
