<?php
include_once('inc/db.php');
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Validate Form Data
  $user = Validate($_POST["matricule"]);
  $password = Validate($_POST["password"]);
  // fetching the data
  $sql = "SELECT * FROM  compte  WHERE user = ?";
  $pdo_statement = $conn->prepare($sql);
  $pdo_statement->bindParam(1, $user);
  $pdo_statement->execute();
  $result = $pdo_statement->fetch();
  $hashed_password = $result[1];
  if (!empty($result)) {
    if (password_verify($password, $hashed_password)) {
      // redirection to main pages
      $_SESSION['CEF'] = $user;
      if ($result['compteType'] == 'stagiaire') {
        $_SESSION['compteType'] = $result['compteType'];
        header('location:./responsable.php');
        exit();
      } elseif ($result['compteType'] == 'directrice') {
        $_SESSION['compteType'] = $result['compteType'];
        header('location:./accueil-directrice.php');
        exit();
      } elseif ($result['compteType'] == 'serveillant') {
        $_SESSION['compteType'] = $result['compteType'];
        header('location:./Accueil-serveillant.php');
        exit();
      } elseif ($result['compteType'] == 'superAdmin') {
        $_SESSION['compteType'] = $result['compteType'];
        header('location:./creation.php');
        exit();
      }
    } else {
      header('location:./login.php?msg=Login Or Password incorrect');
      exit();
    }

  } else {
    header('location:./login.php?msg=Login Or Password incorrect');
    exit();
  }
}

// created by Rguibi Marouane  and Idrissi Mohammed
// hiba test
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="./styles/login.css" media="screen" type="text/css" />
  <link rel="shortcut icon" href="./images/logoApp.png" type="image/x-icon">
  <title>Login </title>
</head>

<body>
  <div class="container">
    <div class="header">
      <div class="logoOfppt">
        <img src="./images/Ofpptlogo.png" alt="logoOfppt" id="logoOfppt" />
      </div>
      <div class="logoApp">
        <img src="./images/logoApp.png" alt="logo" id="logoApp" />
      </div>
    </div>
    <div id="container">
      <h1>Bienvenue!</h1>
      <div class="error-msg">
        <?php
        if (isset($_GET['msg'])) {

          echo $_GET['msg'];
        }
        ?>
      </div>
      <form id="form" action="#" method="POST">
        <div id="formControl ">
          <label><strong> Login :</strong></label>
          <span id="star">*</span>
          <input type="text" placeholder="Entrer votre login" name="matricule" id="matricule" />
          <div class="error" id="error"></div>
        </div>
        <div id="formControl">
          <label><strong> Mot de passe :</strong></label>
          <span id="star">*</span>
          <input type="password" placeholder="Entrer votre mot de passe" name="password" id="password" />
          <div class="error" id="error"></div>
        </div>

        <button type="submit">Se connecter</button>
      </form>
    </div>
    <footer>
      <p>© Copyright | DevWFS205 |2022</p>
    </footer>
  </div>
  <script src="./scripts/login.js"></script>
</body>

</html>