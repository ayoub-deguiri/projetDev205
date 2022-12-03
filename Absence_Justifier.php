<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link rel="stylesheet" media="screen" href="./styles/Absence_Justifier.css" />
  <title>Absence Justifier</title>
</head>

<body>
<!--******************** --- [ header   ] --- ********************-->
  <header>
    <div class="logoOfppt">
      <img src="./images/Ofpptlogo.png" alt="logoOfppt" id="logoOfppt" />
    </div>
    <div class="logoApp">
      <img src="./images/logoApp.png" alt="logo" class="logoApp" />
    </div>
    <div class="déconnexion">
      <button type="button" id="Déconnexion">
        <a href="./logout.php">Déconnexion</a>
      </button>
    </div>
  </header>
<!--******************** --- [ nav   ] --- ********************-->
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
      <a href="./note.php"><button><i class="fa fa-calendar" aria-hidden="true"></i>NOTES</button> </a>
    </li>
    <li>
      <a href="Deperdition.php"><button><i class="fa fa-plus-circle" aria-hidden="true"></i>deperdition</button></a>
    </li>
    <li>
      <a href="Absence_Justifier.php"><button><i  aria-hidden="true"></i>Justifier</button></a>
    </li>
  </ul>
</nav>
  <main>
<!--******************** --- [ liste   ] --- ********************-->
    <form action="" method="post">
      <div class="selects">
        <ul>
                
                <li> <label for="année-scolaire"  >année scolaire</label>
                    <select name="annee-Scolaire" id="année-scolaire"></select> </li>
            
                <li> <label for="année">année</label>
                      <select id="année" name="annee" required></select></li>

                <li> <label for="filier">filière</label>
                       <select id="filiére" name="filiere" required></select></li>
            
                <li> <label for="">groupe</label>
                     <select id="groupe" name="groupe" required></select> </li>
             
                <li><input type="submit"  value="valider" id="valider"> </li>
        </ul>
      </div>
    </form>

<!--******************** --- [ Affichage Nom groupe ] --- ********************-->
    <caption>
      <div class="affiche_nom_groupe"> NOM GROUPE </div>
    </caption>
<!--******************** --- [ table   ] --- ********************-->
    <form action="./inc/JestufierAbs.php" method="post">
      <table>
      <tr>
          <th>CEF</th>
          <th>Nom</th>
          <th>Prénom</th>
          <th>Types</th>
          <th>Formateur</th>
          <th>Date</th>
          <th>Module</th>
          <th>Heure debut</th>
          <th>Heure fin</th>
          <th>Justifier</th>
          <th>Nature de Justifier</th>
      </tr>
       
      <tr>
          <td></td>
          <td> </td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>

          <td>
             <label class="switch">
                  <input type="checkbox">
                  <span class="slider round"></span>
            </label>
          </td>

          <td>
            <input class="commentaire" type="text"   />
          </td>
       </tr>

      <tr>
        <td></td>
        <td> </td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>
           <label class="switch">
                <input type="checkbox">
                <span class="slider round"></span>
          </label>
        </td>

        <td>
          <input class="commentaire" type="text"   />
        </td>
      </tr>
      <tr>
      <td></td>
      <td> </td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>

      <td>
         <label class="switch">
              <input type="checkbox">
              <span class="slider round"></span>
        </label>
      </td>

      <td>
        <input class="commentaire" type="text"   />
      </td>
      </tr>
      <tr>
        <td></td>
        <td> </td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>

        <td>
          <label class="switch">
                <input type="checkbox">
                <span class="slider round"></span>
          </label>
        </td>

        <td>
          <input class="commentaire" type="text"   />
        </td>
      </tr>
      <tr>
      <td></td>
      <td> </td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>

      <td>
        <label class="switch">
              <input type="checkbox">
              <span class="slider round"></span>
        </label>
      </td>

      <td>
        <input class="commentaire" type="text"   />
      </td>
     </tr>
    </tr>
    <tr>
    <td></td>
    <td> </td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>

    <td>
      <label class="switch">
            <input type="checkbox">
            <span class="slider round"></span>
      </label>
    </td>

    <td>
      <input class="commentaire" type="text"   />
    </td>
   </tr>
  </tr>
  <tr>
  <td></td>
  <td> </td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>

  <td>
    <label class="switch">
          <input type="checkbox">
          <span class="slider round"></span>
    </label>
  </td>

  <td>
    <input class="commentaire" type="text"   />
  </td>
 </tr>
 
    
      </table>  
  
    </form>
  </main>
<!--******************** --- [ btn valider   ] --- ********************-->

  <div class="valider">
    <input type="submit" value="valider" id="validee" >
</div>
<!--******************** --- [ footer   ] --- ********************-->

<footer>
         <p>© Copyright | DevWFS205 |2022</p>
</footer>  
 

</body>
</html>
