<?php
include_once('./inc/db.php');
session_start();
if (empty($_SESSION) or $_SESSION['compteType'] !== "serveillant") {
  header('location:./login.php');
}
if (!empty($_SESSION["groupe"])) {
  $grp = $_SESSION["groupe"];
  // get group name
  $sql = "SELECT nomGroupe from groupe where idGroupe = ?";
  $pdo_statement = $conn->prepare($sql);
  $pdo_statement->bindParam(1, $grp);
  $pdo_statement->execute();
  $GroupName = $pdo_statement->fetch();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link rel="stylesheet" media="screen" href="./styles/styleAjouter.css" />
  <link rel="shortcut icon" href="./images/logoApp.png" type="image/x-icon" />
  <title>Saisir</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"
    integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
    crossorigin="anonymous"></script>

  <script src="./scripts/mainSaisir.js"></script>
</head>

<body>
  <header>
    <div class="logoOfppt">
      <img src="./images/Ofpptlogo.png" alt="logoOfppt" id="logoOfppt" />
      <!-- <img src="./images/logo-photochop.png" alt="logoOfppt" id="logoOfppt" /> -->
    </div>
    <div class="logoApp">
      <img src="./images/logoApp.png" alt="logo" class="logoApp" />
      <!-- <img src="./images/logo.png" alt="logo" class="logoApp" /> -->
    </div>
    <div class="déconnexion">
      <button type="button" id="Déconnexion">
        <a href="./logout.php">DÉCONNEXION</a>
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
        <a href="./note.php"><button><i class="fa fa-calendar" aria-hidden="true"></i>NOTES</button> </a>
      </li>
      <li>
        <a href="./Deperdition.php"><button><i class="fa fa-plus-circle" aria-hidden="true"></i>deperdition</button></a>
      </li>
      <li>
        <a href="./Absence_Justifier.php"><button><i aria-hidden="true"></i>Justifier</button></a>
      </li>
    </ul>
  </nav>
  <main>
    <h1>VEUILLEZ CHOISIR UNE OPTION</h1>
    <?php
    if (!empty($GroupName)) {
    ?>
    <h1>groupe choisi est :<span>
        <?= $GroupName[0] ?>
      </span>
    </h1>
    <div class="container">
      <a href="./ajouterStagiaire.php?idgrp=<?= $_SESSION["groupe"] ?>">
        <div class="nvCandidat">ajouter un nouveau candidat</div>
      </a>
      <a href="./modifier-groupe.php">
        <div class="chGroupe">changement de groupe</div>
      </a>
    </div>
    <?php
    } else {
    ?>
    <h1>
      veuillez revenir en arrière et choisir un groupe
      <h1>
        <div class="container">
          <a style="pointer-events: none" href="./ajouterStagiaire.php">
            <div class="nvCandidat">ajouter un nouveau candidat</div>
          </a>
          <a style="pointer-events: none" href="./modifier-groupe.php">
            <div class="chGroupe">changement de groupe</div>
          </a>
        </div>
        <?php
    }
        ?>
  </main>
  <footer>
    <p>© Copyright | DevWFS205 |2022</p>
  </footer>
</body>

</html>

</html>