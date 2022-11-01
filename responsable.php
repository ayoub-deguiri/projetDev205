<?php
include('inc/db.php');
session_start();
if (empty($_SESSION) or $_SESSION['compteType'] == "directrice") {
    header('location:./login.php');
}
?>
<?php
$user = $_SESSION['CEF'];

$sql = "SELECT * FROM stagiaire WHERE CEF = $user";
$pdo_statement = $conn->prepare($sql);
$pdo_statement->execute();
$result = $pdo_statement->fetch();
$idgrp = $result['groupe_idGroupe'];


$sql2 = "SELECT * FROM stagiaire WHERE groupe_idGroupe =$idgrp";
$pdo_statement = $conn->prepare($sql2);
$pdo_statement->execute();
$resultfinale = $pdo_statement->fetchALL();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>responsable 🥼</title>
    <link rel="shortcut icon" type="image/png" href="./images/icon.png" />
    <link rel="icon" type="image/x-icon" href="./images/logo.jpeg">
    <link rel="stylesheet" href="./styles/styleResponsable.css">
    <link rel="stylesheet" href="mediaQueries.css">
   
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logoOfppt">
                <img src="./images/Ofpptlogo.png" alt="logoOfppt" id="logoOfppt">
            </div>
            <div class="logoApp">
                <img src="./images/logoApp.png" alt='logo' id="logoApp">
            </div >
            <div class="buttonDeconexion"><a href="logout.php"> <button>Déconnexion</button></a>
            </div>
        </div>
        <section>
            <h1>espace responsable  <?=$result['nomStagiaire']." ".$result['prenomStagiaire'];?></h1>
            <div class="responsable">
            <form action="./inc/InsertAbsence.php" method="POST" enctype="multipart/form-data">
            <div class="listeEtudiants">
                <div>
                       Date  : <input placeholder="La Date" name="date" class="textbox-n" type="text" onfocus="(this.type='date')" id="date">
                </div>
                <div>
                      Formateur : <input type="text" name="formateur" id="formateur"  placeholder="Le Formateur">
                </div>
                <div> 
                     Module : <input type="text" name="module" id="module" placeholder="Le Module">
                </div>
            </div>
          
                <table>
                    <tr>
                       
                        <th>nom</th>
                        <th>prénom</th>
                        <th>absence</th>
                        <th>retard</th>
                        <th>heure debut</th>
                        <th>heure fin</th>
                    </tr>
                    <?php
                    if (!empty($resultfinale)) {
                        foreach ($resultfinale as $row) {
                            $id = $row['CEF'];
                            $_SESSION['idgrp'] =$row['groupe_idGroupe']
                            ?>
                     <tr>
                        <td><?= $row['nomStagiaire']?></td>
                        <td><?= $row['prenomStagiaire']?></td>
                        <td><input type="checkbox" name="absence-<?=$id?>" id="btnAb"  value="absence" /></td>
                        <td><input type="checkbox" name="retard-<?=$id?>" id="btnRet" value="retard"/></td>
                        <td><input type="time" name="debut-<?=$id?>" min="8:30" max="18:30"></td>
                        <td> <input type="time" name="Fin-<?=$id?>" min="8:30" max="18:30"></td>
                    </tr>
                     <?php

                        }
                    }
?> 
      
                </table>
                
            </div>
            <div class="buttonVlaiderPhoto">
                <div class="buttonPhoto">
                <input type="file" name="file" id="buttonPhoto">
            </div>
                <input type="submit" value="valider" name="valider" id="buttonValider" >
            </div>
        </form>
        </section>
        <footer>
                <p>        © Copyright | DevWFS205 |2022 </p>
        </footer>
    </div>
</body>
</html>







