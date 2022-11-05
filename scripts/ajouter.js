function checkSelect()
{
       var Année_Scolaire= document.getElementById("année-scolaire").value;
       var Année= document.getElementById("année").value;
       var filiére= document.getElementById("filiére").value;
       var Nombre = document.getElementById("groupe").value;
       if(Année_Scolaire == "" || Année == "" || filiére == ""|| Nombre=="")
         return false;
       else
          return true;

}
function infos()
{
   var info =document.getElementById("importGroup")
   if( checkSelect()== true)
    {
      info.style.display = "inline";
   }
   else
    {
      info.style.display = "none";
    }
}

