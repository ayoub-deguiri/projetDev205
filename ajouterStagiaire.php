<?php
include('inc/db.php');
session_start();
// $_SESSION["groupe"];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['valider'])) {
    $sql = "INSERT INTO stagiaire  VALUES (?,?,?,?)";
    $pdo_statement = $conn->prepare($sql);
    $pdo_statement->bindParam(1, $_POST['cef']);
    $pdo_statement->bindParam(2, $_POST['nom']);
    $pdo_statement->bindParam(3, $_POST['prenom']);
    $pdo_statement->bindParam(4, $_SESSION["groupe"]);

    $pdo_statement->execute();
    header("location:Modifier-Stagiaire.php");


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
  <link rel="stylesheet" media="screen" href="./styles/modification.css" />
  <link rel="shortcut icon" href="./images/logoApp.png" type="image/x-icon">
  <title>Document</title>
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
        <a href=""><button><i class="fa fa-home" aria-hidden="true"></i>ACCUEIL</button></a>
      </li>
      <li>
        <a href="#"><button><i class="fa fa-pencil-square" aria-hidden="true"></i>MODIFIER</button></a>
      </li>
      <li>
        <a href=""><button><i class="fa fa-calendar-times-o" aria-hidden="true"></i>ABSENCE</button></a>
        <ul>
          <li><a href=""><button>Affichage</button></a></li>
          <li><a href=""><button>Saisir</button></a></li>
        </ul>
      </li>
      <li>
        <a href=""><button><i class="fa fa-calendar" aria-hidden="true"></i>NOTES</button> </a>
      </li>
      <li>
        <a href="#"><button><i class="fa fa-plus-circle" aria-hidden="true"></i>AJOUTER</button></a>
      </li>
    </ul>
  </nav>
  <h1 id="title">
    <?= $_SESSION['nomGroupe'] ?>
  </h1>

  <main>

    <form id="form" method="POST">
      <table>
        <tr>
          <td><label for="cef" id="label">CEF:</label></td>
          <td><input type="text" id="cef" name="cef" /></td>
        </tr>
        <tr>
          <td>
            <div id="error"></div>
          </td>
        </tr>
        <tr>
          <td><label for="nom" id="label">Nom:</label></td>
          <td><input type="text" id="nom" name="nom" /></td>
        </tr>
        <tr>
          <td>
            <div id="error2"></div>
          </td>
        </tr>
        <tr>
          <td for="prenom" id="label">Prenom:</td>
          <td><input type="text" id="prenom" name="prenom" /></td>
        </tr>
        <tr>
          <td>
            <div id="error3"></div>
          </td>
        </tr>
        <tr>
          <td><input type="submit" id="btn" value="valider" name="valider"></td>
        </tr>



      </table>
    </form>

  </main>
  <footer>
    <p>© Copyright | DevWFS205 |2022</p>
  </footer>

  <script src="./scripts/AjouterStagaire.js"></script>
</body>

</html>
