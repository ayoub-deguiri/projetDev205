<?php
include_once('./inc/db.php');
session_start();
if (empty($_SESSION) or $_SESSION['compteType'] != "serveillant") {
  header('location:./login.php');
}
// cureDate
$cureDate = date('Y-m-d');
// nbrAbs CureDate
$absence = 'absence';
$sql = 'SELECT Get_CountAbs_Date(?,?) AS nbr';
$pdo_statement = $conn->prepare($sql);
$pdo_statement->bindParam(1, $cureDate);
$pdo_statement->bindParam(2, $absence);
$pdo_statement->execute();
$nbrAbs = $pdo_statement->fetch();
// nbrRet CureDate
$retard = 'retard';
$sql = 'SELECT Get_CountAbs_Date(?,?) AS nbr';
$pdo_statement = $conn->prepare($sql);
$pdo_statement->bindParam(1, $cureDate);
$pdo_statement->bindParam(2, $retard);
$pdo_statement->execute();
$nbrRet = $pdo_statement->fetch();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link rel="stylesheet" media="screen" href="./styles/Accueil-serveillant.css" />
  <script src="./scripts/jquery-3.6.1.min.js"></script>
  <script>
    $(document).ready(function () {
      // Ajax for Modal
      $('.calendar').on('change', function () {
        let date = $(this).val()
        $.ajax({
          type: 'GET',
          url: './inc/AjaxCalendar.php',
          data: { date: date },
          dataType: 'json',
          success: function (data) {
            $("#date-ver").val(date)
            newRet = data['ret']
            newAbs = data['abs']
            newData = [newRet, newAbs]
            myChart.data.datasets[0].data = newData
            myChart.options.title.text = `Nombre des absences et retards du ${date} non justifiés`
            myChart.update();
          }
        });
      })
    });
  </script>
  <title>Accueil</title>
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
        <a href="#"><button><i class="fa fa-plus-circle" aria-hidden="true"></i>AJOUTER</button></a>
      </li>
      <li>
        <a href="#"><button><i  aria-hidden="true"></i>Justifier</button></a>
      </li>
    </ul>
  </nav>
  <table>
    <tr>
      <div class="date">
        <td><label for="date">Date :</label></td>
        <td>
          <input type="date" id="date" class="calendar" />
        </td>
      </div>
    </tr>
  </table>
  <input type="hidden" id="nbrAbs" value=<?= $nbrAbs[0] ?>>
  <input type="hidden" id="nbrRet" value=<?= $nbrRet[0] ?>>
  <div class="chart">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <canvas id="myChart"></canvas>

    <script>
      // add for grphicale use 
      const date = new Date();
      let day = date.getDate();
      let month = date.getMonth() + 1;
      let year = date.getFullYear();
      let currentDate = `${year}-${month}-${day}`;
      // chart
      let nbrAbs = document.getElementById('nbrAbs').value;
      let nbrRet = document.getElementById('nbrRet').value;
      var xValues = ["Retard", "Absence"];
      var yValues = [nbrRet, nbrAbs];

      var barColors = ["#FB931B", "#155A93"];
      let myChart = new Chart("myChart", {
        type: "pie",
        data: {
          labels: xValues,
          datasets: [
            {
              backgroundColor: barColors,
              data: yValues,
            },
          ],
        },
        options: {
          title: {
            display: true,
            text: `Nombre des absences et retards du ${currentDate} non justifiés `,
          },
        },
      });
    </script>
  </div>
  <form action="./Absence_par_date.php" method="POST">
    <div class="btn">
      <input type="hidden" id="date-ver" name="date-sent" value=<?= $cureDate ?>>
      <input type="submit" name='absence' id="absence" value="ABSENCE" />
      <input type="submit" name="retard" id="retard" value="RETARD" />
    </div>
  </form>
  <footer>
    <p>© Copyright | DevWFS205 |2022</p>
  </footer>
</body>

</html>