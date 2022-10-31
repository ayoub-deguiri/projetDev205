<?php
include('inc/db.php');
session_start();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // get user and password
    $user = $_POST["matricule"];
    $password = $_POST["password"];


    // Validate Form Data
    $user = htmlspecialchars($user);
    $user = trim($user);
    $user = stripslashes($user);
    $_SESSION['CEF'] = $user;

    $password = htmlspecialchars($password);
    $password = trim($password);
    $password = stripslashes($password);


    // feching the data
    $sql = "SELECT * FROM  compte  WHERE user = ? and password = ?";
    $pdo_statement = $conn->prepare($sql);
    $pdo_statement->bindParam(1, $user);
    $pdo_statement->bindParam(2, $password);
    $pdo_statement->execute();
    $result = $pdo_statement->fetch();


    // redrection to main pages
    if (empty($result)) {
        header('location:./logout.php');
    } else {
        if ($result['compteType'] == 'stagiaire') {
            $_SESSION['compteType'] = $result['compteType'] ;
            header('location:./responsable.php');
        } elseif ($result['compteType'] == 'directrice') {
            $_SESSION['compteType'] = $result['compteType'] ;
            header('location:./accueil-directrice.php');
        }
        // anzidoha fach yt9ado les page t surveillance general
        //elseif ($result['compteType'] == 'sg') {
        //     header('location:./accueil-sg.html');
        // }
    }
}

// created by Rguibi Marouane  and Idrissi Mohammed
// hiba test
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <link
      rel="stylesheet"
      href="./styles/login.css"
      media="screen"
      type="text/css"
    />
    <title>Login </title>
  </head>
  <body>
    <div class="container">
      <div class="header">
        <div class="logoOfppt">
          <img src="./images/Ofpptlogo.png" alt="logoOfppt" id="logoOfppt" />
        </div>
        <div class="logoApp">
        <img src="./images/logoApp.png" width="100px" height="100px" alt="logo" id="logoApp" />
        </div>
      </div>
      <div id="container">
        <h1>Bienvenue!</h1>
        <form id="form" action="#" method="POST">
          <div id="formControl ">
            <label><b>Votre matricule:</b></label>
            <span id="star">*</span>
            <input
              type="text"
              placeholder="Entrer votre matricule"
              name="matricule"
              id="matricule"
            />
            <div class="error" id="error"></div>
          </div>
          <div id="formControl">
            <label><b> Votre mot de passe:</b></label>
            <span id="star">*</span>
            <input
              type="password"
              placeholder="Entrer le mot de passe"
              name="password"
              id="password"
            />
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
