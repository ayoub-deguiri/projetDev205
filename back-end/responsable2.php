<?php
include "db.php";
session_start();
if (empty($_SESSION)) {
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

<?php
if (isset($_POST["valider"])) {
    if (!empty($_POST['date']) and !empty($_POST['formateur'])   and !empty($_POST['module'])
                    and !empty($_POST['heureDebut'])and  !empty($_POST['heureFin'])) {
        $sql='INSERT into absence(dateAbsence,formateurAbsence,moduleAbsence,heureDebutAbsence,heureFinAbsence) values(null,?,?,?,?,?)';
        $pdo_statement =  $conn->prepare($sql);
        $pdo_statement -> bindParam(1, $_POST['date']);
        $pdo_statement -> bindParam(2, $_POST['formateur']);
        $pdo_statement -> bindParam(2, $_POST['module']);
        $pdo_statement -> bindParam(2, $_POST['heureDebut']);
        $pdo_statement -> bindParam(2, $_POST['heureFin']);
        // $pdo_statement->execute();
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>responsable</title>
    <link rel="icon" type="image/x-icon" href="./images/logo.jpeg">
    <link rel="stylesheet" href="../styles/styleResponsable.css">
    <link rel="stylesheet" href="mediaQueries.css">
   
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logoOfppt">
                <img src="./images/Ofpptlogo.png" alt="logoOfppt" id="logoOfppt">
            </div>
            <div class="logoApp">
                <img src="./images/logo.jpeg" alt='logo' id="logoApp">
            </div>
            <a href="./logout.php"><div class="buttonDeconexion"><button>Déconnexion</button></div></a>
    
        </div>
        <section>
            <h1>espace responsable : </h1>
            <form action="" method="POST">
            <div class="responsable">
                
                <div>
                       date        <input type="date" name="date" id="date">
                      
                </div>
                <div>
                      formateur   <input type="text" id="formateur" name='formateur'>
                      
                </div>
                <div> 
                     module   <input type="text" name="module" id="module">
                    
                </div>
            </div>
            <div class="listeEtudiants">
           
               <table>
                <tr>
                    <th>Nom</th>
                    <th>prénom</th>
                    <th>absence</th>
                    <th>retard</th>
                    <th>heure debut</th>
                    <th>heure fin</th>
                </tr>
                <?php

                if (!empty($resultfinale)) {
                    foreach ($resultfinale as $row) {
                        ?>
                <tr>
            
                    <td><?= $row['nomStagiaire']?></td>
                    <td><?= $row['prenomStagiaire']?></td>
                    <td><input type="radio" name=<?=$row['CEF']?> id="btnAb" value="absence" /></td>
                    <td><input type="radio" name=<?=$row['CEF']?> id="btnRet"  value="retard"/></td>
                    <td><input type="time" min="8:30" max="18:30" name="heureDebut"></td>
                    <td> <input type="time" min="8:30" max="18:30" name="heureFin"></td>
                </tr>
                <?php
                    }
                }
?> 
            </table>
            </div>
            <div class="buttonVlaiderPhoto">
                <div class="buttonPhoto">
                <input type="file" name="buttonPhoto" id="buttonPhoto">
            </div>
                <input type="submit" name="valider" value="valider" id="buttonValider" >
            </div>
        </form>
        </section>
        <footer>
                <p>        © Copyright | DevWFS205 |2022 </p>
        </footer>
    </div>
</body>
</html>