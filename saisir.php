<?php
include_once('inc/db.php');
session_start();
$NomGrp = "";
if (empty($_SESSION) or $_SESSION['compteType'] != "serveillant") {
    header('location:./login.php');
}
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["AjaxValider"])) {
        $_SESSION["anneeScolaire"] = $_POST["annee-Scolaire"];
        $_SESSION["annee"] = $_POST["annee"];
        $_SESSION["filiere"] = $_POST["filiere"];
        $_SESSION["groupe"] = $_POST["groupe"];
       
        $idGroupeV = $_SESSION["groupe"];

       
        $sql = "SELECT CEF,nomStagiaire,prenomStagiaire FROM stagiaire WHERE idGroupe = ? ";
        $pdo_statement = $conn->prepare($sql);
        $pdo_statement->bindParam(1, $idGroupeV);
        $pdo_statement->execute();
        $result = $pdo_statement->fetchall();

        $sql = 'SELECT nomGroupe from groupe where idGroupe= ? ';
        $pdo_statement = $conn->prepare($sql);
        $pdo_statement->bindParam(1, $idGroupeV);
        $pdo_statement->execute();
        $NomGrp = $pdo_statement->fetch();
    }
}
// fetching all the Formateurs 
$sql = "SELECT Matricule,nomFormateur,prenomFormateur from formateur ";
$pdo_statement = $conn->prepare($sql);
$pdo_statement->execute();
$Formateurs = $pdo_statement->fetchAll();




// $sql2 = "SELECT * FROM stagiaire WHERE idGroupe =$idgrp";
// $pdo_statement = $conn->prepare($sql2);
// $pdo_statement->execute();
// $resultfinale = $pdo_statement->fetchALL();
?>

<!DOCTYPE html>
<html lang="en">

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" media="screen" href="./styles/StyleSaisir.css">
    <link rel="shortcut icon" href="./images/logoApp.png" type="image/x-icon">
    <title> Saisir </title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="./scripts/mainSaisir.js"> </script>
    <script src="./scripts/jquery-3.6.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#année-scolaire').on('change', function() {
                var annescolID = $(this).val();
                if (annescolID) {
                    $.get(
                        './inc/AjaxSelect.php', {
                            annescolID: annescolID
                        },
                        function(data) {

                            $('#année').html(data);
                        }
                    );
                }
            })
            $('#année').on('change', function() {
                var anneeID = $(this).val();
                if (anneeID) {
                    $.get(
                        './inc/AjaxSelect.php', {
                            anneeID: anneeID
                        },
                        function(data) {
                            $('#filiére').html(data);
                        }
                    );
                }
            })
            $('#filiére').on('change', function() {
                var filiereID = $(this).val();
                if (filiereID) {
                    $.get(
                        './inc/AjaxSelect.php', {
                            filiereID: filiereID
                        },
                        function(data) {
                            $('#groupe').html(data);
                        }
                    );
                }
            })
        });
    </script>

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
                <a href="#"><button><i class="fa fa-home" aria-hidden="true"></i>ACCUEIL</button></a>
            </li>
            <li>
                <a href="#"><button><i class="fa fa-pencil-square" aria-hidden="true"></i>MODIFIER</button></a>
            </li>
            <li>
                <a href="#"><button><i class="fa fa-calendar-times-o" aria-hidden="true"></i>ABSENCE</button></a>
                <ul>
                    <li><a href="#"><button>Affichage</button></a></li>
                    <li><a href="#"><button>Saisir</button></a></li>
                </ul>
            </li>
            <li>
                <a href="#"><button><i class="fa fa-calendar" aria-hidden="true"></i>NOTES</button> </a>
            </li>
            <li>
                <a href="#"><button><i class="fa fa-plus-circle" aria-hidden="true"></i>AJOUTER</button></a>
            </li>
        </ul>
    </nav>
    <form action="" method="post">
        <main>
            <div class="selects">
                <ul>
                    <li> <label for="année-scolaire">année scolaire</label></li>
                    <?php
                    $sql = ("SELECT * FROM anneeScolaire ");
                    $pdo_statement = $conn->prepare($sql);
                    $pdo_statement->execute();
                    $anneeScolaire = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                    <li><select name="annee-Scolaire" id="année-scolaire">
                            <option value="" disabled selected>Année Scolaire</option>
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
                        </select>
                    </li>
                    <li> <label for="année">année</label></li>
                    <li>
                        <select id="année" name="annee" required></select>
                    </li>
                    <li> <label for="filier">filière</label></li>
                    <li>
                        <select id="filiére" name="filiere" required></select>
                    </li>
                    <li> <label for="">groupe</label></li>
                    <li>
                        <select id="groupe" name="groupe" required></select>
                    </li>
                    <li><input type="submit" name="AjaxValider" value="valider" id="valider"> </li>
                </ul>
    </form>
    </div>
    <div class="listeEtudiants">
        <form action="test.php" id='table-form' method="post">
            <div class="responsable">
                <div>
                    date
                    <!-- <select name="date" id="date"></select> -->
                    <input type="date" name="" id="">


                </div>
                <div>
                    formateur
                    <select name="formateur" id="formateur">
                        <option value="" disabled selected>Choisir Formateur</option>
                        <?php
                        if (isset($Formateurs)) {
                            foreach ($Formateurs as $row) {
                        ?>
                                <option value="<?= $row['Matricule'] ?>">
                                    <?= $row['nomFormateur'] ?> <?= $row['prenomFormateur'] ?>
                                </option>
                        <?php
                            }
                        }
                        ?>
                    </select>




                </div>
                <div>
                    module
                    <!-- <select name="module" id="module"></select> -->
                    <input type="text" name="" id="" placeholder="Saisir le nom module">


                </div>
            </div>
            <table>
                <caption> Nom Groupe : <?php echo $NomGrp["nomGroupe"] ?>

                </caption>
                <tr>
                    <th>CEF</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Absence</th>
                    <th>Retard</th>
                    <th>Heure debut </th>
                    <th>Heure Fin </th>
                </tr>
                <?php
                if (isset($result)) {
                    foreach ($result as $row) {
                ?>
                        <tr>
                            <td><?= $row['CEF'] ?> </td>
                            <td><?= $row['nomStagiaire'] ?></td>
                            <td> <?= $row['prenomStagiaire'] ?></td>
                            <td> <input type="checkbox" name="absence" id="absence"></td>
                            <td> <input type="checkbox" name="retard" id="retard"></td>
                            <td> <input type="time" name="heureDebut" id="heureDebut" /> </td>
                            <td> <input type="time" name="heureFin" id="heureFin" /> </td>

                        </tr>
                <?php
                    }
                }
                ?>


            </table>
    </div>
    </main>
    </div>

    <div class="valider">
        <input type="submit" value="valider" onclick="CheckBox(event)" id="valider-responsable">
    </div>
    </form>
    </div>

    <footer>
        <p>© Copyright | DevWFS205 |2022</p>
    </footer>




</body>

</html>