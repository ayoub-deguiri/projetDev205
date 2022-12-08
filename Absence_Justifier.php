<?php
include_once('inc/db.php');
session_start();
if (empty($_SESSION) or $_SESSION['compteType'] !== "serveillant") {
  header('location:./login.php');
}
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["AjaxValider"])) {
  // Get All Justified Absence
  $sql = "SELECT a.CEF ,s.nomStagiaire,s.prenomStagiaire,a.type,concat(f.nomFormateur,f.prenomFormateur) as formateur,dateAbsence,moduleAbsence,a.heureDebutAbsence
        ,a.heureFinAbsence,a.idAbsence from absence a ,stagiaire s , 
        formateur f where s.CEF=a.CEF and a.matricule=f.matricule  and a.justifier = 'oui' and  a.idGroupe = (?) ";
  $pdo_statement = $conn->prepare($sql);
  $pdo_statement->bindParam(1, $_GET["groupe"]);
  $pdo_statement->execute();
  $AbsencesJustifer = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
  // Get Group Name
  $sql = "SELECT nomGroupe from groupe where idGroupe = ?";
  $pdo_statement = $conn->prepare($sql);
  $pdo_statement->bindParam(1, $_GET["groupe"]);
  $pdo_statement->execute();
  $group = $pdo_statement->fetch();
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link rel="stylesheet" media="screen" href="./styles/Absence_Justifier.css" />
  <link rel="stylesheet" media="screen" href="./styles/snackbar.css.">
  <title>Absence Justifier</title>
  <script src="./scripts/jquery-3.6.1.min.js"></script>
  <script>
    $(document).ready(function () {
      // Ajax for select
      $('#année-scolaire').on('change', function () {
        var annescolID = $(this).val();
        if (annescolID) {
          $.get(
            './inc/AjaxSelect.php',
            { annescolID: annescolID },
            function (data) {
              $('#année').html(data);
            }
          );
        }
      })
      $('#année').on('change', function () {
        var anneeID = $(this).val();
        if (anneeID) {
          $.get(
            './inc/AjaxSelect.php',
            { anneeID: anneeID },
            function (data) {
              $('#filiére').html(data);
            }
          );
        }
      })
      $('#filiére').on('change', function () {
        var filiereID = $(this).val();
        if (filiereID) {
          $.get(
            './inc/AjaxSelect.php',
            { filiereID: filiereID },
            function (data) {
              $('#groupe').html(data);
            }
          );
        }
      })
      $("#valider").click(function (ev) {
        if ($('#groupe').val() === null) {
          ev.preventDefault()
          alert("Choisissez s'il vous plaît  un groupe")
        }
      })

      // Ajax for Delete Justificaiton
      $(".switcher").on('change', function () {
        const idabs = $(this).val()
        if (idabs) {
          $.ajax({
            method: "POST",
            url: './inc/DeleteAbsJustife.php',
            data: { idabs: idabs },
            success: function (data) {
              $("#success-delete").html(data)
            }
          })
        }
      })

    })
  </script>
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
        <a href="Absence_Justifier.php"><button><i aria-hidden="true"></i>Justifier</button></a>
      </li>
    </ul>
  </nav>
  <main>
    <!--******************** --- [ liste   ] --- ********************-->
    <form action="" method="get">
      <div class="selects">
        <ul>
          <li> <label for="année-scolaire">année scolaire</label></li>
          <?php
          $sql = ("SELECT * FROM anneeScolaire ");
          $pdo_statement = $conn->prepare($sql);
          $pdo_statement->execute();
          $anneeScolaire = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
          ?>
          <li><select name="annee-Scolaire" id="année-scolaire">
              <option value="" disabled selected>Année Scolaire</option>
              <?php
              if (isset($anneeScolaire)) {
                foreach ($anneeScolaire as $row) {
              ?>
              <option value="<?= $row['idAnneeScolaire'] ?>">
                <?= $row['nomAnneeScolaire'] ?>
              </option>
              <?php
                }
              }
              ?>
            </select>
          </li>
          <li> <label for="année">année</label></li>
          <li>
            <select id="année" name="annee" required></select>
          </li>
          <li> <label for="filier" id='filiérelb'>filière</label></li>
          <li>
            <select id="filiére" name="filiere" required></select>
          </li>
          <li> <label for="">groupe</label></li>
          <li>
            <select id="groupe" name="groupe" required></select>
          </li>
          <li><input type="submit" name="AjaxValider" value="valider" id="valider"> </li>
        </ul>
      </div>
    </form>

    <!--******************** --- [ Affichage Nom groupe ] --- ********************-->
    <caption>

      <div class="affiche_nom_groupe">
        <?php if (isset($group)) {
          echo 'Liste ' . $group[0];
        } ?>
      </div>
    </caption>
    <!--******************** --- [ table   ] --- ********************-->
    <?php
    if (!isset($_GET['AjaxValider'])) {
      echo "<div class='first-msg'> Veuillez sélectionner un groupe </div>";
    }
    if (isset($_GET['AjaxValider']) && empty($AbsencesJustifer)) {
      echo "<div class='first-msg'> Aucune Absence Justifier pour ce groupe </div>";
    } elseif (isset($_GET['AjaxValider']) && !empty($AbsencesJustifer)) {
    ?>
    <div>
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
          <th>Nature de Justifier</th>
          <th>Justifier</th>
        </tr>
        <?php
      foreach ($AbsencesJustifer as $row) {

        ?>

        <tr>
          <td>
            <?= $row['CEF'] ?>
          </td>
          <td>
            <?= $row['nomStagiaire'] ?>
          </td>
          <td>
            <?= $row['prenomStagiaire'] ?>
          </td>
          <td>
            <?= $row['type'] ?>
          </td>
          <td>
            <?= $row['formateur'] ?>
          </td>
          <td>
            <?= $row['dateAbsence'] ?>
          </td>
          <td>
            <?= $row['moduleAbsence'] ?>
          </td>
          <td>
            <?= $row['heureDebutAbsence'] ?>
          </td>
          <td>
            <?= $row['heureFinAbsence'] ?>
          </td>
          <td>
            <?php
        $idabs = $row['idAbsence'];
        $sql = "SELECT Justifie_motif from justifierabsence where idAbsence = ?";
        $pdo_statement = $conn->prepare($sql);
        $pdo_statement->bindParam(1, $idabs);
        $pdo_statement->execute();
        $NatureDeJustifier = $pdo_statement->fetch(pdo::FETCH_COLUMN);
            ?>
            <input class="commentaire" type="text" value=<?= $NatureDeJustifier ?> />
          </td>
          <td>
            <label class="switch">
              <input type="checkbox" class="switcher" checked value="<?= $row['idAbsence'] ?>">
              <span class="slider round"></span>
            </label>
          </td>
        </tr>
        <?php
      }
        ?>
      </table>
    </div>
    <?php
    }
    ?>
  </main>
  <div id="snackbar">l'opération terminée avec succes..</div>
  <input type="hidden" id="success-delete"></input>
  <!--******************** --- [ footer   ] --- ********************-->
  <footer>
    <p>© Copyright | DevWFS205 |2022</p>
  </footer>
</body>

</html>