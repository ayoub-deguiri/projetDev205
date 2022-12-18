<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link rel="stylesheet" media="screen" href="./styles/creation.css" />
  <script src="./scripts/creation.js" defer></script>
  <title>creation</title>
</head>

<body>
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
  <nav>
    <ul>
      <li>
        <a href="./creation.php"><button class="creation">Création</button></a>
      </li>
      <li>
        <a href="./ImporterModules.php"><button>Module</button></a>
      </li>
      <li>
        <a href="./ImporterFormateur.php"><button>Formateur</button></a>
      </li>
      <li>
        <a href="./Importer_stagiaire.php"><button>Stagiaire</button> </a>
      </li>
    </ul>
  </nav>
  <main>
      <div class="container">
        <form action="infosCreaction.php" method="POST">
          <div class="row">
              <div class="col-25">
                <label for="année-scolaire">Année Scolaire :</label>
              </div>
              <div class="col-75">
                        <select class = "anneeScolaire" id="année-scolaire" name="anneeScolaire" required>
                          <option value="-1" disabled >select annee scolaire</option>
                          <option value="2023-2024">2023-2024</option>
                          <option value="2024-2025">2024-2025</option>
                          <option value="2025-2026">2025-2026</option>
                          <option value="2026-2027">2026-2027</option>

                        </select>
              </div>
            </div>
          <div class="row">
            <div class="col-25">
              <label for="année">Année :</label>
            </div>
            <div class="col-75">
                  <td>
                      <select class = "annee" id="année" name="annee" required>
                        <option value="-1" disabled >select anne</option>
                        <option value="1ere Annee">1ere Annee</option>
                        <option value="2eme Annee">2eme Annee</option>
                      </select>
                  </td>
                </tr>
            </div>
          </div>

          <div class="row">
            <div class="col-25">
              <label for="groupe" disabled>Nombre:</label>
            </div>
            <div class="col-75">
              <input type="text" id="groupe" name="nombre" required />
            </div>
          </div>

          <div class="box-submit">
            <input type="button" value="OK" onclick="infos()" id="button" />
          </div>
          <div id="importGroup">
        <div id="form" class="form2">
          <div id="here">
        </div>
          <input type="submit" name = "valider" value ="valider" onclick="myFunction()" id="btnValider" />
      </div>
        </form>
      </div>

       
        

    </main>
  <footer>
    <p>© Copyright | DevWFS205 |2022</p>
  </footer>




  <script src="./scripts/creation.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
