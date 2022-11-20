var Année_Scolaire = document.getElementById("année-scolaire");
var Année = document.getElementById("année");
var filiére = document.getElementById("filiére");
var Nombre = document.getElementById("groupe");
function checkSelect() {
  if (
    Année_Scolaire.value == "" ||
    Année.value == "" ||
  
    Nombre.value == ""
  )
    return false;
  else return true;
}
function infos() {
  if (checkSelect() == true) {
    let div = document.getElementById("here");
    div.innerHTML = "";
    for (let i = 1; i <= parseInt(Nombre.value); i++) {
      div.innerHTML += `
      <div>
          <label id='color' for='NG'> Nom Filiere :</label>
          <input type='text' name='NG' id='NG'>
        
        
      </div>
`;
    }
    document.getElementById("form").style.display = "block";
    document.getElementById("valider").style.display = "block";
  }
}
