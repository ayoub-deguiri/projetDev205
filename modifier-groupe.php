<!--html-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/Modifier-groupe.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="./images/logoApp.png" type="image/x-icon">
    <title>Modifier-groupe</title>
</head>
<body>
    <header>
        <div class="logoOfppt">
            <img src="./images/Ofpptlogo.png" alt="logoOfppt" id="logoOfppt">
        </div>
        <div class="logoApp">
            <img src="./images/logoApp.png" alt="logo" class="logoApp">
        </div>
        <div class="déconnexion">
            <button type="button" id="Déconnexion"><a href="./logout.php">Déconnexion</a></button>
        </div>
    </header>
  <nav>
    <ul>
      <li>
        <a href="./Accueil-serveillant.php"><button><i class="fa fa-home" aria-hidden="true"></i>ACCUEIL</button></a>
      </li>
      <li>
        <a href="./Modifier-Stagiaire.php"><button><i class="fa fa-pencil-square"
              aria-hidden="true"></i>MODIFIER</button></a>
      </li>
      <li>
        <a href=""><button><i class="fa fa-calendar-times-o" aria-hidden="true"></i>ABSENCE</button></a>
        <ul>
          <li><a href="./Affichage-surveillant.php"><button>Affichage</button></a></li>
          <li><a href="./SasireAbsence-surveillant.php"><button>Saisir</button></a></li>
        </ul>
      </li>
      <li>
        <a href="./note.html"><button><i class="fa fa-calendar" aria-hidden="true"></i>NOTES</button> </a>
      </li>
      <li>
        <a href="#"><button><i class="fa fa-plus-circle" aria-hidden="true"></i>deperdition</button></a>
      </li>
      <li>
        <a href="#"><button><i  aria-hidden="true"></i>Justifier</button></a>
      </li>
    </ul>
  </nav>
    <form action="" method="post">
        <main>
            <div class="container">
                <table>
                    <tr>
                        <th> CEF : </th>
                        <td><input type="text" id="cef" ></td>

                    </tr>
                    <tr>
                        <th> année scolaire : </th>
                        <td>  <select name="annéescolaire" id="annéescolaire">
                            <option value=""  selected>Année Scolaire</option>
                            <option value="1"  >1</option>
                        </select> </td>
                    </tr>
                    <tr>
                        <th> année  : </th>
                        <td><select name="année" id="année">
                            <option value=""  selected>Année </option>
                            <option value="1"  >1</option>
                        </select></td>
                    </tr>
                    <tr>
                        <th> Groupe  : </th>
                        <td><select name="Groupe" id="Groupe">
                            <option value=""  selected>Groupe</option>
                            <option value="1"  >1</option>
                        </select></td>
                    </tr>
                    <tr>
                        <th> filière  : </th>
                        <td><select name="filière" id="filière">
                            <option value=""  selected>filière</option>
                            <option value="1"  >1</option>
                        </select></td>
                    </tr>
                    <tr>
                        <td colspan="2"><button type="submit" class="button" onclick="return checkobligatoire() ">valider</button></td>
                    </tr>
                </table>
                
            </div>
        </main>   
    </form>
    <footer>
        <p>© Copyright | DevWFS205 |2022</p>
    </footer>
    <script>
        var cef = document.getElementById('cef')
        var annéescolaire = document.getElementById('annéescolaire')
        var année = document.getElementById('année')
        var Groupe = document.getElementById('Groupe')
        var filière = document.getElementById('filière')
        function checkobligatoire()
        {
            var etat1,etat2,etat3,etat4,etat5 
            if(cef.value =='')
            {
                etat1 =false
                cef.style.border='2px solid red'
            }
            else{
                etat1 =true
                cef.style.border='2px solid var(--color2)'
            }
            if(annéescolaire.value =='')
            {
                etat2 =false
                annéescolaire.style.border='2px solid red'
            }
            else{
                etat2 =true
                annéescolaire.style.border='2px solid var(--color2)'
            }
            if(année.value =='')
            {
                etat3 =false
                année.style.border='2px solid red'
            }
            else{
                etat3 =true
                année.style.border='2px solid var(--color2)'
            }
            if(Groupe.value =='')
            {
                etat4 =false
                Groupe.style.border='2px solid red'
            }
            else{
                etat4 =true
                Groupe.style.border='2px solid var(--color2)'
            }
            if(filière.value =='')
            {
                etat5 =false
                filière.style.border='2px solid red'
            }
            else{
                etat5 =true
                filière.style.border='2px solid var(--color2)'
            }

            if(etat1 ==false|| etat2==false || etat3==false ||etat4==false || etat5==false)
            {
         
                return false
            }
            else{
               
                return true
            }
           
           
        }
    </script>
</body>

</html>
