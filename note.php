<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="./images/logoApp.png" type="image/x-icon">
    <link rel="stylesheet" media="screen" href="./styles/note.css">
  
    <title>Document</title>
</head>
<body>
    <header>
        <div class="logoOfppt">
            <img src="./images/Ofpptlogo.png"  alt="logoOfppt" id="logoOfppt">
        </div>
        <div class="logoApp">
            <img src="./images/logoApp.png"  alt="logo" class="logoApp">
        </div>
        <div class="déconnexion">
        <button type="button" id="Déconnexion"><a href="./logout.php">Déconnexion</a></button>
      </div> 
    </header>
    <nav>
        <ul>
          <li>
              <a href="./Accueil-serveillant.php"><button ><i class="fa fa-home" aria-hidden="true"></i>ACCUEIL</button></a>
          </li>
          <li>
              <a href="./Modifier-Stagiaire.php"><button><i class="fa fa-pencil-square" aria-hidden="true"></i>MODIFIER</button></a> 
          </li>
          <li> 
              <a href=""><button><i class="fa fa-calendar-times-o" aria-hidden="true"></i>ABSENCE</button></a>
              <ul>
                  <li><a href="./Affichage-surveillant.php"><button>Affichage</button></a></li>
                  <li><a href="./SasireAbsence-surveillant.php"><button>Saisir</button></a></li>
              </ul>
          </li>
          <li>  
              <a href="./note.php"><button id="Note"><i class="fa fa-calendar" aria-hidden="true"></i>NOTE</button> </a>
          </li>
          <li>  
              <a href="./Deperdition.php"><button ><i class="fa fa-plus-circle" aria-hidden="true"></i>Deperdition</button></a>
          </li>
          <li>  
            <a href="./Absence_Justifier.php"><button >Justifier</button></a>
        </li>
        </ul>
      </nav>
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
      <h2 class="titre">Nom-groupe de filière</h2>
            <main>
               
               
               
                <table>
                    <tr>
                            <th>CEF</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Nombre Absence</th>
                            <th>Nombre</br>Retard</th>
                            <th>Sanctions</th>
                            <th>Poins à </br> deduire</th>
                            <th>Note/15</th>
                            <th>Comportement</th>
                            <th>Note</th>
                    </tr>
                    <tr>
                        <td>.</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><input type="text"/></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>.</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><input type="text"/></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>.</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><input type="text" /></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>.</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><input type="text" /></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>.</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><input type="text" /></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>.</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><input type="text" /></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>.</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><input type="text" /></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>.</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><input type="text" /></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>.</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><input type="text" /></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>.</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><input type="text" /></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>.</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><input type="text" /></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>.</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><input type="text" /></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>.</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><input type="text" /></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>.</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><input type="text" /></td>
                        <td></td>
                    </tr>
             
                    
                </table>
                
                

            </main>
           <div class="valider">
                <input type="submit" value="valider" id="validee" >
            </div>
            <footer>
                     <p>© Copyright | DevWFS205 |2022</p>
            </footer>   
                 
            
</body>
</html>
