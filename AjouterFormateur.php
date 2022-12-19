<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link rel="stylesheet" media="screen" href="./styles/modifierFormateur.css" />
  <link rel="shortcut icon" href="./images/logoApp.png" type="image/x-icon">
  <title>Document</title>
</head>

<body>
  <?php
  include_once('inc/db.php');
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['matricule']) and isset($_POST['nom']) and isset($_POST['prenom'])) {
      $pdo_statement = $conn->prepare("SELECT Matricule FROM formateur where Matricule=?");
      $pdo_statement->bindParam(1, $_POST['matricule']);
      $pdo_statement->execute();
      $Matricule = $pdo_statement->fetch(PDO::FETCH_ASSOC);
      if ($Matricule) {
        echo '<script>alert("ce formateur déjà existe")</script>';
      } else {
        $sql = "INSERT INTO formateur(Matricule,nomFormateur,prenomFormateur)
                    VALUES (:cef,:nom,:prenom)";
        $pdo_statement = $conn->prepare($sql);
        $pdo_statement->bindParam(':cef', $_POST['matricule']);
        $pdo_statement->bindParam(':nom', $_POST['nom']);
        $pdo_statement->bindParam(':prenom', $_POST['prenom']);
        $pdo_statement->execute();
        echo '<script>alert("Formateur Bien Ajouter");</script>';
      }
    }
  }

  ?>
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
        <a href="./creation.php"><button>Création</button></a>
      </li>
      <li>
        <a href="./ImporterModule.php"><button>Module</button></a>
      </li>
      <li>
        <a href="./ImporterFormateur.php"><button>Formateur</button></a>
      </li>
      <li>
        <a href="#"><button>Stagiaire</button> </a>
      </li>
    </ul>
  </nav>
  <main>
    <form id="form" method="POST" action="">
      <table>
        <tr>
          <td><label for="cef" id="label">Matricule:</label></td>
          <td><input type="text" id="cef" name="matricule" required /></td>
        </tr>
        <tr>
          <td>
            <div id="error"></div>
          </td>
        </tr>
        <tr>
          <td><label for="nom" id="label">Nom:</label></td>
          <td><input type="text" id="nom" name="nom" required /></td>
        </tr>
        <tr>
          <td>
            <div id="error2"></div>
          </td>
        </tr>
        <tr>
          <td><label for="prenom" id="label">Prenom:</label></td>
          <td><input type="text" id="prenom" name="prenom" required /></td>
        </tr>
        <tr>
          <td>
            <div id="error3"></div>
          </td>
        </tr>
        <tr>
          <td><input type="submit" id="btn" name="btn" value="Valider" /></td>
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