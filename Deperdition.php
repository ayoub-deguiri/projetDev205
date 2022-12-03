<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" media="screen" href="./styles/DeperditionCss.css">
    <link rel="shortcut icon" href="./images/logoApp.png" type="image/x-icon">

  
    <title>Document</title>
</head>
<body>
    <!--header-->
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
    <!--Fin-header-->
    <!--nav-bar-->
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
        <a href="Deperdition.php"><button><i class="fa fa-plus-circle" aria-hidden="true"></i>Deperdition</button></a>
      </li>
      <li>
        <a href="Absence_Justifier.php"><button><i  aria-hidden="true"></i>Justifier</button></a>
      </li>
    </ul>
  </nav>
    <!--fin-navbar-->
    <!--filtrer-tableau-->
    <form action="" method="">
        <div class="selects">
          <ul>
            <li> <label for="année-scolaire">année scolaire 
            </label></li>
           
            <li><select name="annee-Scolaire" id="année-scolaire">
                <option value="" disabled selected> </option>
               
                <option calss='option-sent' value="">
                 
                </option>
               
              </select>
            </li>
            <li> <label for="année">année</label></li>
            <li>
              <select id="année" name="annee" required></select>
            </li>
            <li> <label for="filier">filière</label></li>
            <li>
              <select id="filiére" name="filiere" required></select>
            </li>
            <li> <label for="">groupe</label></li>
            <li>
              <select id="groupe" name="groupe" required></select>
            </li>
            <li><input type="submit" name="" value="valider" id="valider"> </li>
          </ul>
        </div>
      </form>
    <!--Fin-filtrer-tableau-->
    <!--Filtrer-tableau-->
    <div class="title">
        <h1 id="bienvenue">Liste </h1>
    </div>
    <!--fin-filtrer-tableau-->
    <!--tableau-->
      <div>
       
            <main> 
            <form>
                
                <table>
                    <tr>
                            <th>CEF</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Groupe</th>
                            <th>Details</th>
                            <th>Supprimer</th>
                            
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><input  type="button" id="btn1" value="Cliquer"></td>
                        <td> <label class="switch">
                            <input type="checkbox">
                            <span class="slider round"></span>
                        </label></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><input  type="button" id="btn1" value="Cliquer"></td>
                        <td> <label class="switch">
                            <input type="checkbox">
                            <span class="slider round"></span>
                        </label></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><input  type="button" id="btn1" value="Cliquer"></td>
                        <td> <label class="switch">
                            <input type="checkbox">
                            <span class="slider round"></span>
                        </label></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><input  type="button" id="btn1" value="Cliquer"></td>
                        <td> <label class="switch">
                            <input type="checkbox">
                            <span class="slider round"></span>
                        </label></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><input  type="button" id="btn1" value="Cliquer"></td>
                        <td> <label class="switch">
                            <input type="checkbox">
                            <span class="slider round"></span>
                        </label></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><input  type="button" id="btn1" value="Cliquer"></td>
                        <td> <label class="switch">
                            <input type="checkbox">
                            <span class="slider round"></span>
                        </label></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><input  type="button" id="btn1" value="Cliquer"></td>
                        <td> <label class="switch">
                            <input type="checkbox">
                            <span class="slider round"></span>
                        </label></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><input  type="button" id="btn1" value="Cliquer"></td>
                        <td> <label class="switch">
                            <input type="checkbox">
                            <span class="slider round"></span>
                        </label></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><input  type="button" id="btn1" value="Cliquer"></td>
                        <td> <label class="switch">
                            <input type="checkbox">
                            <span class="slider round"></span>
                        </label></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><input  type="button" id="btn1" value="Cliquer"></td>
                        <td> <label class="switch">
                            <input type="checkbox">
                            <span class="slider round"></span>
                        </label></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><input  type="button" id="btn1" value="Cliquer"></td>
                        <td> <label class="switch">
                            <input type="checkbox">
                            <span class="slider round"></span>
                        </label></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><input  type="button" id="btn1" value="Cliquer"></td>
                        <td> <label class="switch">
                            <input type="checkbox">
                            <span class="slider round"></span>
                        </label></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><input  type="button" id="btn1" value="Cliquer"></td>
                        <td> <label class="switch">
                            <input type="checkbox">
                            <span class="slider round"></span>
                        </label></td>
                    </tr>

                </table>
                
            </form>

            </main>
      </div>
    <!--fin-tableau-->
    
    
    <!--footer-->
    <footer>
        <p>© Copyright | DevWFS205 |2022</p>
    </footer>   
    <!--fin-->          
</body>
</html>
