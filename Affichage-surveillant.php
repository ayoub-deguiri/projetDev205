<?php
include_once('inc/db.php');
session_start();
if (empty($_SESSION) or $_SESSION['compteType'] !== "serveillant") {
  header('location:./login.php');
}
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
  if (isset($_GET["AjaxValider"])) {
    $_SESSION["anneeScolaire"] = $_GET["annee-Scolaire"];
    $_SESSION["annee"] = $_GET["annee"];
    $_SESSION["filiere"] = $_GET["filiere"];
    $_SESSION["groupe"] = $_GET["groupe"];

    // get Absence 
    $sql = "SELECT * from absence where idGroupe = ? and justifier ='no'";
    $pdo_statement = $conn->prepare($sql);
    $pdo_statement->bindParam(1, $_SESSION["groupe"]);
    $pdo_statement->execute();
    $absence = $pdo_statement->fetchAll();
    // get group name
    $sql = "SELECT nomGroupe from groupe where idGroupe = ?";
    $pdo_statement = $conn->prepare($sql);
    $pdo_statement->bindParam(1, $_SESSION["groupe"]);
    $pdo_statement->execute();
    $group = $pdo_statement->fetch();
    $_SESSION["nomGroupe"] = $group['nomGroupe'];
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link rel="stylesheet" media="screen" href="./styles/Affichage-surveillant.css" />
  <link rel="stylesheet" href="./styles/snackbar.css">
  <title>Affichage</title>
  <script src="./scripts/jquery-3.6.1.min.js"></script>
  <script>
    $(document).ready(function () {


      // Ajax for select
      $('#année-scolaire').on('change', function () {
        let annescolID = $(this).val();
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
        let anneeID = $(this).val();
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
        let filiereID = $(this).val();
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
      const countrow = parseInt($('#trcount').val())




      // ajax for Delete Ansence
      for (i = 1; i <= countrow; i++) {
        $("#tr-" + i + " button").on("click", function (ev) {
          if (confirm("Êtes - vous sûr de faire ce processus") == true) {
            const idAbsence = $(this).val()
            if (idAbsence) {
              $.post({
                url: './inc/DeleteAbsence.php',
                data: { idAbsence: idAbsence },
                success: function (data) {
                  $("#success-delete").html(data)
                }
              });
            }
          }
        })
      }





      // justifier
      let errorgenral = 1
      $('#validerJutification').click(function (ev) {
        for (i = 1; i <= countrow; i++) {
          let checkboxLength = $("#tr-" + i + " input:checkbox:checked").length
          if (checkboxLength == 1) {
            if ($("#tr-" + i + " input[type=text]").val() == "") {
              $('#tr-' + i).css({
                "color": "red",
              });
              errorgenral = 1
            } else {
              errorgenral = 0
              $('#tr-' + i).css({
                "color": "green",
              });
            }
          } else {
            $('#tr-' + i).css({
              "color": "black",
            });
          }
        }
        if (errorgenral == 0) {
          if (confirm("Enregistré avec succès") != true) {

            ev.preventDefault()
          }
        } else {
          ev.preventDefault()
          alert('vous avez oublié quelque chose, veuillez revérifier ce que vous avez saisi')
        }
      })
    })
  </script>
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
  
            <!--******************** --- [  Fin Nav ] --- ********************-->

 
  <!--******************** --- [ Main ] --- ********************-->
  <main>
    <!-- liste  -->
    <form action="" method="GET">
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
              <option calss='option-sent' value="<?= $row['idAnneeScolaire'] ?>">
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
          <li> <label for="filier">filière</label></li>
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
    <!--  Table -->
    <form action="./inc/JestufierAbs.php" method="POST">
      <?php
      if ($_SERVER["REQUEST_METHOD"] == "GET" and isset($_GET["AjaxValider"]) and empty($absence)) {
        echo "<div class='first-msg-2'>" . "<span>&#8592;</span>" . " Aucune absence pour ce groupe ,Veuillez sélectionner un autre  groupe " . "</div>";
      } elseif (empty($absence)) {
        echo "<div class='first-msg'>" . "<span>&#8592;</span>" . " Veuillez sélectionner un groupe " . "</div>";
      } else {
      ?>
      <table>
          <caption>
          <!--******************** --- [ Affichage Nom groupe ] --- ********************-->
          <div class="affiche_nom_groupe">Group : <?= $group['nomGroupe'] ?>
          </div>
         </caption>
        
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
          <th>Supprimer Absence</th>
        </tr>
        <?php
        $c = 1;
        foreach ($absence as $row) {
          //fetch Nom et prenom stagiaires
          $sql = "SELECT nomStagiaire,prenomStagiaire from stagiaire where CEF=?";
          $pdo_statement = $conn->prepare($sql);
          $pdo_statement->bindParam(1, $row["CEF"]);
          $pdo_statement->execute();
          $Stagiaire = $pdo_statement->fetch();

          //fetch formateur
          $sql = "SELECT concat(nomFormateur,'  ',prenomFormateur) as fullName from formateur where Matricule=?";
          $pdo_statement = $conn->prepare($sql);
          $pdo_statement->bindParam(1, $row["matricule"]);
          $pdo_statement->execute();
          $Formateur = $pdo_statement->fetch();
        ?>
        <tr id="tr-<?= $c++ ?>">
          <td>
            <?= $row["CEF"] ?>
          </td>
          <td>
            <?= $Stagiaire["nomStagiaire"] ?>
          </td>
          <td>
            <?= $Stagiaire["prenomStagiaire"] ?>
          </td>
          <td>
            <?= $row["type"] ?>
          </td>
          <td>
            <?= $Formateur[0] ?>
          </td>
          <td>
            <?= $row["dateAbsence"] ?>
          </td>
          <td>
            <?= $row["moduleAbsence"] ?>
          </td>
          <td>
            <?= $row["heureDebutAbsence"] ?>
          </td>
          <td>
            <?= $row["heureFinAbsence"] ?>
          </td>
          <td>
            <input type="checkbox" id='checkbox' name="check-btn-<?= $row['CEF'] ?>" class="btncheckbox"
              onclick="Enable(this)" />
          </td>
          <td>
            <input class="commentaire" type="text" name="justif-<?= $row['CEF'] ?>" name="select" disabled />
          </td>
          <input type="hidden" name="idAbs-<?= $row['CEF'] ?>" value="<?= $row['idAbsence'] ?>">
          <td>
            <button type="button" id="trashbtn" class="option-sent" value="<?= $row['idAbsence'] ?>">
              <img src="./images/trash-2.svg" id='trash' alt="Delete">
            </button>
          </td>
        </tr>
        <?php
        }
        ?>
        <input type="hidden" id="trcount" value="<?= $c ?>" />
      </table>
      <!--  btn valider -->
      <div class="valider">
        <input type="submit" value="valider" name="sent-verf" id="validerJutification" />
      </div>
      <?php
      }

      ?>
    </form>
  </main>
  <div id="snackbar">l'opération terminée avec succes..</div>
  <input type="hidden" id="success-delete"></input>

  <footer>
    <p>© Copyright | DevWFS205 |2022</p>
  </footer>

  <!--**********************--- [ Code js ] ---*******************************************************-->
  <script type="text/javascript">

    /*----------- [Code js 1 : checkbox]-----------*/
    let Commentaire = document.getElementsByClassName("commentaire");
    let btn = document.getElementsByClassName("btncheckbox");
    let nombre1 = btn.length;
    let nombre2 = Commentaire.length;
    function Enable() {
      for (i = 0; i < nombre1; i++) {
        if (btn[i].checked == true) {
          Commentaire[i].removeAttribute("disabled");
          Commentaire[i].style.backgroundColor = 'rgb(232, 236, 239)';
        } else {
          btn.disabled = "true";
          Commentaire[i].setAttribute("disabled", "");
          Commentaire[i].value = "";
          Commentaire[i].style.backgroundColor = 'rgb(140, 138, 138)';
        }
      }
    }
  </script>
</body>

</html>
