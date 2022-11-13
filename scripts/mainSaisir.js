function CheckBox(event) {
  var Absence = document.getElementById("absence");
  var Retard = document.getElementById("retard");

  if (Absence.checked != true && Retard.checked != true) {
    alert("Champs case obligatoire ! ");
    event.preventDefault();
  }
}
