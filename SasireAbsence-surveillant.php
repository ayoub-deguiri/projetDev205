<?php
include_once('inc/db.php');
session_start();
if (empty($_SESSION) or $_SESSION['compteType'] !== "serveillant") {
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

        // get all Stagiaire 
        $sql = "SELECT CEF ,nomStagiaire,prenomStagiaire from stagiaire where idGroupe = ?";
        $pdo_statement = $conn->prepare($sql);
        $pdo_statement->bindParam(1, $_SESSION["groupe"]);
        $pdo_statement->execute();
        $Stagiaires = $pdo_statement->fetchAll();
        // get group name
        $sql = "SELECT nomGroupe from groupe where idGroupe = ?";
        $pdo_statement = $conn->prepare($sql);
        $pdo_statement->bindParam(1, $_SESSION["groupe"]);
        $pdo_statement->execute();
        $group = $pdo_statement->fetch();
        $_SESSION["nomGroupe"] = $group['nomGroupe'];

    }
}
?>
<!--html-->
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" media="screen" href="./styles/SasireAbsence-surveillant.css">
    <link rel="shortcut icon" href="./images/logoApp.png" type="image/x-icon">
    <title> Saisir </title>
    <script src="./scripts/mainSaisir.js">  </script>
    <script src="./scripts/jquery-3.6.1.min.js"></script>
    <script>
        $(document).ready(function () {
            // Ajax for select
            $('#année-scolaire').on('change', function () {
                var annescolID = $(this).val();
                if (annescolID) {
                    $.get(
                        './inc/AjaxSelect.php',
                        { annescolID: annescolID },
                        function (data) {
                            $('#année').html(data);
                        }
                    );
                }
            })
            $('#année').on('change', function () {
                var anneeID = $(this).val();
                if (anneeID) {
                    $.get(
                        './inc/AjaxSelect.php',
                        { anneeID: anneeID },
                        function (data) {
                            $('#filiére').html(data);
                        }
                    );
                }
            })
            $('#filiére').on('change', function () {
                var filiereID = $(this).val();
                if (filiereID) {
                    $.get(
                        './inc/AjaxSelect.php',
                        { filiereID: filiereID },
                        function (data) {
                            $('#groupe').html(data);
                        }
                    );
                }
            })
            $("#valider").click(function (ev) {
                if ($('#groupe').val() === null) {
                    ev.preventDefault()
                    alert("Choisissez s'il vous plaît  un groupe")
                }
            })
            // verefication 
            const countrow = parseInt($('#trcount').val())
            $('#buttonValider').click(function (e) {
                let countDubt = 0
                let countFin = 0
                let checkboxLength2 = $("input:checkbox:checked").length
                let errorgenral = 1
                let breaker = false
                for (i = 1; i <= countrow; i++) {
                    if (breaker) {
                        break
                    }
                    let checkboxLength = $("#tr-" + i + " input:checkbox:checked").length
                    if (checkboxLength == 1) {
                        $("#tr-" + i + " input[type=time]").each(function () {
                            let debut = 0
                            let fin = 0
                            if ($(this).hasClass("debut")) {
                                if ($(this).val() != '') {
                                    debut = 1
                                }
                            }
                            if ($(this).hasClass("fin")) {
                                if ($(this).val() != '') {
                                    fin = 1

                                }
                            }

                            if (debut !== 1 && fin !== 1) {
                                $('#tr-' + i).css({
                                    "color": "red",
                                });
                                errorgenral = 1
                                breaker = true
                                return false
                            } else {
                                $('#tr-' + i).css({
                                    "color": "green",
                                });
                                errorgenral = 0
                            }
                        })
                    } else {
                        $('#tr-' + i).css({
                            "color": "black",
                        });
                    }
                }
                if (errorgenral == 0 && $("#date").val() != "" && $("#formateur").val() != "" && $("#module").val() != "") {
                    alert("Enregistré avec succès")
                } else {
                    e.preventDefault()
                    alert('vous avez oublié quelque chose, veuillez revérifier ce que vous avez saisi')
                }
            })
        })
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
        <a href="./Absence_Justifier.php"><button><i  aria-hidden="true"></i>Justifier</button></a>
      </li>
    </ul>
  </nav>
    <main>
        <form action="" method="post">
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
            </div>
        </form>
        <!-- Main Table -->
        <div class="listeEtudiants">
            <form action="./inc/InsertAbsenceSurveillant.php" id='table-form' method="post">
                <?php
                if (empty($Stagiaires)) {
                    echo "<div class='first-msg'>" . "<span>&#8592;</span>" . " Veuillez sélectionner un groupe " . "</div>";
                } else {
                ?>
                <div class="responsable">
                    <div>
                        Date : <input placeholder="La Date" name="date" class="textbox-n" type="text"
                            onfocus="(this.type='date')" id="date" required>
                    </div>
                    <div>
                        <?php
                    $sql = ("SELECT * FROM formateur ");
                    $pdo_statement = $conn->prepare($sql);
                    $pdo_statement->execute();
                    $formateur = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
                        ?>
                        Formateur : <select required class="selectFormateur" name="formateur" id="formateur">
                            <option value="" disabled selected class="first-option">Formateur</option>
                            <?php
                    if (isset($formateur)) {
                        foreach ($formateur as $row) {
                            ?>
                            <option value=<?= $row['Matricule'] ?>>
                                <?= $row['nomFormateur'] . ' ' . $row['prenomFormateur'] ?>
                            </option>
                            <?php
                        }
                    }
                            ?>
                        </select>
                    </div>
                    <div>
                        Module : <input type="text" name="module" id="module" placeholder="Le Module" required>
                    </div>
                </div>
                <table>
                    <caption> Nom Groupe : <?= $group['nomGroupe'] ?>
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
                    $c = 1;
                    foreach ($Stagiaires as $row) {
                        $id = $row['CEF'];
                    ?>
                    <tr id="tr-<?= $c++ ?>">
                        <td>
                            <?= $row["CEF"] ?>
                        </td>
                        <td>
                            <?= $row['nomStagiaire'] ?>
                        </td>
                        <td>
                            <?= $row['prenomStagiaire'] ?>
                        </td>
                        <td><input type="checkbox" name="absence-<?= $id ?>" id="btnAb" value="absence" />
                        </td>
                        <td><input type="checkbox" name="retard-<?= $id ?>" id="btnRet" value="retard" /></td>
                        <td><input type="time" class="debut" name="debut-<?= $id ?>" min="8:30" max="18:30"></td>
                        <td> <input type="time" class="fin" name="Fin-<?= $id ?>" min="8:30" max="18:30"></td>
                    </tr>
                    <?php
                    }
                    ?>
                    <input type="hidden" id="trcount" value="<?= $c ?>" />
                </table>
                <div class="valider">
                    <input type="submit" name='validerAbs' value="valider" id="buttonValider">
                </div>

        </div>
        <?php
                }
                ?>
        <!-- Main Table -->
        </form>
    </main>
    <footer>
        <p>© Copyright | DevWFS205 |2022</p>
    </footer>
</body>

</html>
