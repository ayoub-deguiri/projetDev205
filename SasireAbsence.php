<!DOCTYPE html>
<html lang="en">

    <!DOCTYPE html>
    <html lang="en">
    
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" media="screen" href="./styles/StyleSaisir.css">
        <link rel="shortcut icon" href="./images/logoApp.png" type="image/x-icon">
        <title> Saisir </title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"
            integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk"
            crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
            crossorigin="anonymous"></script>
        <script src="./scripts/mainSaisir.js">  </script>
      
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
                <a href="#"><button><i class="fa fa-home" aria-hidden="true"></i>ACCUEIL</button></a>
            </li>
            <li>
                <a href="#"><button><i class="fa fa-pencil-square" aria-hidden="true"></i>MODIFIER</button></a>
            </li>
            <li>
                <a href="#"><button><i class="fa fa-calendar-times-o" aria-hidden="true"></i>ABSENCE</button></a>
                <ul>
                    <li><a href="#"><button>Affichage</button></a></li>
                    <li><a href="#"><button>Saisir</button></a></li>
                </ul>
            </li>
            <li>
                <a href="#"><button><i class="fa fa-calendar" aria-hidden="true"></i>NOTES</button> </a>
            </li>
            <li>
                <a href="#"><button><i class="fa fa-plus-circle" aria-hidden="true"></i>AJOUTER</button></a>
            </li>
        </ul>
    </nav>
    <form action="" method="post">
        <main>
            <div class="selects">
                <ul>
                    <li> <label for="année-scolaire">année scolaire</label></li>
                
                    <li><select name="annee-Scolaire" id="année-scolaire" required>
                           

                        </select>
                    </li>
                    <li> <label for="année">année</label></li>
                    <li>
                        <select id="année" name="annee" required>
                        </select>
                    </li>
                    <li> <label for="filier">filière</label></li>
                    <li>
                        <select id="filiére" name="filiere" required>

                        </select>
                    </li>
                    <li> <label for="">groupe</label></li>
                    <li>
                        <select id="groupe" name="groupe" required>

                        </select>
                    </li>
                    <li><input type="submit" name="AjaxValider" value="valider" id="valider"
                           > </li>
                </ul>
    </form>
    </div>
    <div class="listeEtudiants">
        <form action="test.php" id='table-form' method="post">
            <div class="responsable">
                <div>
                  date
                  <select name="date" id="date"></select>
      
               
                </div>
                <div>
                  formateur
                  <select name="formateur" id="formateur"></select>
       
            
                
          
                </div>
                <div>
                  module
                  <select name="module" id="module"></select>
               
           
                </div>
              </div>
            <table>
                <caption> Nom Groupe :
                  
                </caption>
                <tr>
                    <th>CEF</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Absence</th>
                    <th>Retard</th>
                    <th>Heure debut </th>
                    <th>Heure Fin </th>
                </tr>
              
                <tr >
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td> <input type="checkbox" name="absence" id="absence"></td>
                    <td> <input type="checkbox" name="retard" id="retard"></td>
                    <td> <input type="time" name="heureDebut" id="heureDebut"/> </td>
                    <td> <input type="time" name="heureFin" id="heureFin"/>  </td>

                </tr>
            
            </table>
    </div>
    </main>
    </div>
    <div class="modal fade" id="empModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>
    <div class="ajoute-valider">
     

        </div>
        <div class="valider">
            <input type="submit" value="valider" onclick="CheckBox(event)" id="valider-responsable" >
        </div>
        </form>
    </div>

    <footer>
        <p>© Copyright | DevWFS205 |2022</p>
    </footer>



 
</body>

</html>
