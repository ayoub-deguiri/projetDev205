<?php
include_once('./inc/db.php');
session_start();
if (empty($_SESSION) or $_SESSION['compteType'] !== "serveillant") {
    header('location:./login.php');
}

$dateAbsence='2020-01-03';
include('db.php');
$sql="SELECT a.CEF ,s.nomStagiaire,s.prenomStagiaire,f.nomFormateur ,a.type,a.heureDebutAbsence
,a.heureFinAbsence,a.idAbsence,moduleAbsence,g.nomGroupe from absence a ,groupe g ,stagiaire s , 
formateur f where s.CEF=a.CEF and a.matricule=f.matricule and a.idGroupe=g.idGroupe and a.dateAbsence=? ";
 $pdo_statement = $conn->prepare($sql);
 $pdo_statement->bindParam(1,$dateAbsence);
 $pdo_statement->execute();
 $AbsencesAujourdhui =$pdo_statement->fetchAll();


 if (isset($_POST['valider'])) {
    $max = count($AbsencesAujourdhui);
    for ($i = 0; $i <= $max; $i++) {
        if (!empty($_POST["justif-" . $AbsencesAujourdhui[$i]['CEF']]) && isset($_POST["check-btn-" . $AbsencesAujourdhui[$i]['CEF']])) {
            $motif = $_POST["justif-" . $AbsencesAujourdhui[$i]['CEF']];
            $idabs = $_POST["idAbs-" . $AbsencesAujourdhui[$i]['CEF']];
            $sql2 = "INSERT into justifierabsence VALUES(?,?)";
            $pdo_statement = $conn->prepare($sql2);
            $pdo_statement->bindParam(1, $idabs);
            $pdo_statement->bindParam(2, $motif);
            $pdo_statement->execute();
            header('location:./Absence2.php');
        } else {
            echo '<script>
            alert("Verifier votre Saisire")
            </script>';
            header('location:./Absence2.php');
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" media="screen" href="./styles/absence.css">
  
    <title>Document</title>
</head>
<body>
    <header>
        <div class="logoOfppt">
            <img src="./images/Ofpptlogo.png"  alt="logoOfppt" id="logoOfppt">
        </div>
        <div class="logoApp">
            <img src="./images/logoApp.png"  alt="logo" class="logoApp">
        </div>
        <div class="déconnexion">
        <button type="button" id="Déconnexion"><a href="./logout.php">Déconnexion</a></button>
      </div> 
    </header>
    <nav>
        <ul>
          <li>
              <a href=""><button ><i class="fa fa-home" aria-hidden="true"></i>ACCUEIL</button></a>
          </li>
          <li>
              <a href="modification.html"><button><i class="fa fa-pencil-square" aria-hidden="true"></i>MODIFIER</button></a> 
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
              <a href="#"><button ><i class="fa fa-plus-circle" aria-hidden="true"></i>AJOUTER</button></a>
          </li>
        </ul>
      </nav>
      <h2 class="titre">Les absences de <?php echo $dateAbsence ?></h2>
            <main>
            <form method="POST">

<table>
    <tr>
        <th>CEF</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Types</th>
        <th>Formateur</th>
        <th>Groupe</th>
        <th>Module</th>
        <th>Heure</br>debut</th>
        <th>Heure</br>fin</th>
        <th>justifier</th>
        <th>Nature de justifier</th>
    </tr>

    <?php
    foreach ($AbsencesAujourdhui as $row) {
    ?>
    <tr>
        <td>
            <?php echo $row['CEF'] ?>
        </td>
        <td>
            <?php echo $row['nomStagiaire'] ?>
        </td>
        <td>
            <?php echo $row['prenomStagiaire'] ?>
        </td>
        <td>
            <?php echo $row['type'] ?>
        </td>
        <td>
            <?php echo $row['nomFormateur'] ?>
        </td>
        <td>
            <?php echo $row['nomGroupe'] ?>
        </td>
        <td>
            <?php echo $row['moduleAbsence'] ?>
        </td>
        <td>
            <?php echo $row['heureDebutAbsence'] ?>
        </td>
        <td>
            <?php echo $row['heureFinAbsence'] ?>
        </td>
        <td><input type="checkbox" name="check-btn-<?= $row['CEF'] ?>" onclick="Enable(this)" class="btn1">
        </td>
        <td><input class="commentaire" type="text" name="justif-<?= $row['CEF'] ?>" disabled></td>
        <td><input type="hidden" name="idAbs-<?= $row['CEF'] ?>" value="<?= $row['idAbsence'] ?>"> </td>
    </tr>
    <?php
    }
    ?>
</table>
</main>
<div class="valider">
<input type="submit" value="valider" id="validee" name="valider">
</div>
</form>
    
            <footer>
                     <p>© Copyright | DevWFS205 |2022</p>
            </footer> 
           
  
            
            <script type="text/javascript">
                      
                    var Commentaire = document.getElementsByClassName("commentaire");
                    var btn = document.getElementsByClassName("btn1");
                    var nombre1 = btn.length;
                    var nombre2 = Commentaire.length;
                    function Enable() {
                        for (i = 0; i < nombre1; i++) {
                        if (btn[i].checked == true) {
                            Commentaire[i].removeAttribute("disabled");
                             
                        } else {
                            btn.disabled = "true";
                            Commentaire[i].setAttribute("disabled", "");
                            Commentaire[i].value = "";
                        }     
                        }
                    }
    </script>
                 
            
</body>
</html>