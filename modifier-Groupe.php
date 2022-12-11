<?php
include_once('inc/db.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['valider'])) {
        //modifier le groupe
        $sql = "UPDATE stagiaire set idGroupe =? where cef= ?";
        $pdo_statement = $conn->prepare($sql);
        $pdo_statement->bindParam(1,$_POST['Groupe']);
        $pdo_statement->bindParam(2,$_POST['cef']);
        $pdo_statement->execute();

        //modifier la filiere 
        $sql = "UPDATE groupe set idFiliere =? where idGroupe= ?";
        $pdo_statement = $conn->prepare($sql);
        $pdo_statement->bindParam(1,$_POST['filiere']);
        $pdo_statement->bindParam(2,$_POST['Groupe']);
        $pdo_statement->execute();


        //modifier l'annee
        $sql = "UPDATE filiere set idAnnee =? where idFiliere= ?";
        $pdo_statement = $conn->prepare($sql);
        $pdo_statement->bindParam(1,$_POST['annee']);
        $pdo_statement->bindParam(2,$_POST['filiere']);
        $pdo_statement->execute();
        
        //modifier l'annee scolaire
        $sql = "UPDATE annee set idAnneeScolaire =? where idAnnee= ?";
        $pdo_statement = $conn->prepare($sql);
        $pdo_statement->bindParam(1,$_POST['anneeScolaire']);
        $pdo_statement->bindParam(2,$_POST['annee']);
        $pdo_statement->execute();

    }}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/Modifier-groupe.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="./images/logoApp.png" type="image/x-icon">
    <title>Modifier-groupe</title>
</head>
<body>
    <header>
        <div class="logoOfppt">
            <img src="./images/Ofpptlogo.png" alt="logoOfppt" id="logoOfppt">
        </div>
        <div class="logoApp">
            <img src="./images/logoApp.png" alt="logo" class="logoApp">
        </div>
        <div class="déconnexion">
            <button type="button" id="Déconnexion"><a href="./logout.php">Déconnexion</a></button>
        </div>
    </header>
    <nav>
        <ul>
            <li>
                <a href="./Accueil-serveillant.php"><button><i class="fa fa-home"
                            aria-hidden="true"></i> Accueil</button></a>
            </li>
            <li>
                <a href="./Modifier-Stagiaire.php"><button><i class="fa fa-pencil-square"
                            aria-hidden="true"></i> Modifier</button></a>
            </li>
            <li>
                <a href=""><button><i class="fa fa-calendar-times-o" aria-hidden="true"></i> Absence</button></a>
                <ul>
                    <li><a href="./Affichage-surveillant.php"><button>Affichage</button></a></li>
                    <li><a href="./SasireAbsence-surveillant.php"><button>Saisir</button></a></li>
                </ul>
            </li>
            <li>
                <a href="./note.html"><button><i class="fa fa-calendar" aria-hidden="true"></i> Notes</button> </a>
            </li>
            <li>
                <a href="#"><button><i class="fa fa-plus-circle" aria-hidden="true"></i> Ajouter</button></a>
            </li>
        </ul>
    </nav>

    <form action="" method="POST">
        <main>
            <div class="container">
                <table>
                    <tr>
                        <th> CEF : </th>
                        <td><input type="text" id="cef" name="cef" ></td>

                    </tr>
                    <tr>
                            <th> année scolaire : </th>
                            <!-- recuperer l'annee scolaire -->
                            <?php
                                $sql = ("SELECT * FROM anneeScolaire ");
                                $pdo_statement = $conn->prepare($sql);
                                $pdo_statement->execute();
                                $anneeScolaire = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
                                ?>
                            <td>  <select name="anneeScolaire" id="annéescolaire">
                                <option value=""  selected>Année Scolaire</option>
                                <?php
                                if (isset($anneeScolaire)) {
                                    foreach ($anneeScolaire as $row) {
                                ?>
                                <option value="<?= $row['idAnneeScolaire'] ?>">
                                    <?= $row['nomAnneeScolaire'] ?>
                                </option>
                                <?php
                                    }
                                }
                                ?>
                            </select> </td>
                    </tr>

                    <tr>
                            <th> année  : </th>
                            <!-- recuperer l'annee  -->
                            <?php
                                $sql = ("SELECT * FROM annee");
                                $pdo_statement = $conn->prepare($sql);
                                $pdo_statement->execute();
                                $annee = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
                                ?>
                            <td><select name="annee" id="année">
                                <option value=""  selected>Année </option>
                                <?php
                                if (isset($anneeScolaire)) {
                                    foreach ($annee as $row) {
                                ?>
                                <option value="<?= $row['idAnnee'] ?>">
                                    <?= $row['nomAnnee'] ?>
                                </option>
                                <?php
                                    }
                                }
                                ?>
                            </select></td>
                    </tr>
                   
                    <tr>
                        <th> Groupe  : </th>
                          <!-- recuperer le groupe  -->
                          <?php
                            $sql = ("SELECT * FROM groupe");
                            $pdo_statement = $conn->prepare($sql);
                            $pdo_statement->execute();
                            $groupe = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
                            ?>
                        <td><select name="Groupe" id="Groupe">
                            <option value=""  selected>Groupe</option>
                            <?php
                           
                                foreach ($groupe as $row) {
                            ?>
                            <option value="<?php echo $row['idGroupe'] ?>">
                                <?php echo $row['nomGroupe'] ?>
                            </option>
                            <?php
                                }
                            
                            ?>
                        </select></td>
                    </tr>
                    <tr>
                        <th> filière  : </th>
                         <!-- recuperer la filiere  -->
                         <?php
                            $sql = ("SELECT * FROM filiere");
                            $pdo_statement = $conn->prepare($sql);
                            $pdo_statement->execute();
                            $filiere = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
                            ?>
                        <td><select name="filiere" id="filière">
                            <option value=""  selected>filière</option>
                            <?php
                            if (isset($filiere)) {
                                foreach ($filiere as $row) {
                            ?>
                            <option value="<?= $row['idFiliere'] ?>">
                                <?= $row['nomFiliere'] ?>
                            </option>
                            <?php
                                }
                            }
                            ?>
                        </select></td>
                    </tr>
                   
                    <tr>
                        <td colspan="2"><button type="submit" class="button" onclick="return checkobligatoire() " name="valider">valider</button></td>
                    </tr>
                </table>
                
            </div>
        </main>   
    </form>
    <footer>
        <p>© Copyright | DevWFS205 |2022</p>
    </footer>
    <script>
        var cef = document.getElementById('cef')
        var annéescolaire = document.getElementById('annéescolaire')
        var année = document.getElementById('année')
        var Groupe = document.getElementById('Groupe')
        var filière = document.getElementById('filière')
        function checkobligatoire()
        {
            var etat1,etat2,etat3,etat4,etat5 
            if(cef.value =='')
            {
                etat1 =false
                cef.style.border='2px solid red'
            }
            else{
                etat1 =true
                cef.style.border='2px solid var(--color2)'
            }
            if(annéescolaire.value =='')
            {
                etat2 =false
                annéescolaire.style.border='2px solid red'
            }
            else{
                etat2 =true
                annéescolaire.style.border='2px solid var(--color2)'
            }
            if(année.value =='')
            {
                etat3 =false
                année.style.border='2px solid red'
            }
            else{
                etat3 =true
                année.style.border='2px solid var(--color2)'
            }
            if(Groupe.value =='')
            {
                etat4 =false
                Groupe.style.border='2px solid red'
            }
            else{
                etat4 =true
                Groupe.style.border='2px solid var(--color2)'
            }
            if(filière.value =='')
            {
                etat5 =false
                filière.style.border='2px solid red'
            }
            else{
                etat5 =true
                filière.style.border='2px solid var(--color2)'
            }

            if(etat1 ==false|| etat2==false || etat3==false ||etat4==false || etat5==false)
            {
         
                return false
            }
            else{
               
                return true
            }
           
           
        }
    </script>
</body>

</html>
