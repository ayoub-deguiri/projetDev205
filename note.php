<?php
include_once('inc/db.php');
include_once('inc/Calc_Note_sur_15.php');
session_start();
if (empty($_SESSION) or $_SESSION['compteType'] !== "serveillant") {
    header('location:./login.php');
}
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["AjaxValider"])) {

    $_SESSION["anneeScolaire"] = $_GET["annee-Scolaire"];
    $_SESSION["annee"] = $_GET["annee"];
    $_SESSION["filiere"] = $_GET["filiere"];
    $_SESSION["groupe"] = $_GET["groupe"];

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
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Note</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="./images/logoApp.png" type="image/x-icon">
    <link rel="stylesheet" media="screen" href="./styles/note.css">
    <script src="./scripts/jquery-3.6.1.min.js"></script>
    <script>
        $(document).ready(function () {
            // Ajax Note 
            $('#addNote').click(function () {
                const countrow = parseInt($('#trcount').val())
                for (i = 1; i < countrow; i++) {
                    const inputval = $("#tr-" + i + " td:nth-child(9) .input_val").val()
                    if (inputval != 0) {
                        const cef = $("#tr-" + i + " td:nth-child(1)").text().trim()
                        console.log(cef)
                        if (cef) {
                            $.ajax({
                                url: './inc/NoteFinale.php',
                                type: 'GET',
                                data: { cef: cef, Comportement: inputval },
                            })
                        }
                    }
                }
                $("#main_tab").load(location.href + " #main_tab>*", "");
            })
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
                <a href="./Accueil-serveillant.php"><button><i class="fa fa-home"
                            aria-hidden="true"></i>ACCUEIL</button></a>
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
                <a href="./note.php"><button id="Note"><i class="fa fa-calendar" aria-hidden="true"></i>NOTE</button>
                </a>
            </li>
            <li>
                <a href="./Deperdition.php"><button><i class="fa fa-plus-circle"
                            aria-hidden="true"></i>Deperdition</button></a>
            </li>
            <li>
                <a href="./Absence_Justifier.php"><button>Justifier</button></a>
            </li>
        </ul>
    </nav>
    <form action="#" method="GET">
        <div class="selects">
            <ul>

                <li> <label for="année-scolaire">année scolaire</label>
                    <?php
                    $sql = ("SELECT * FROM anneeScolaire ");
                    $pdo_statement = $conn->prepare($sql);
                    $pdo_statement->execute();
                    $anneeScolaire = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                    <select name="annee-Scolaire" id="année-scolaire">
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
                <li> <label for="filier" id='filiérelb'>filière</label></li>
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
    <main>
        <?php
        if (empty($Stagiaires)) {
            echo "<div class='first-msg'>" . "<span>&#8593</span>" . " Veuillez sélectionner un groupe " . "</div>";
        } else {
        ?>
        <table id='main_tab'>
            <caption class="titre">Group :
                <?= $group['nomGroupe'] ?>
            </caption>
            <tr>
                <th>CEF</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Nombre Absence</th>
                <th>Nombre</br>Retard</th>
                <th>Poins à </br> deduire</th>
                <th>Sanctions</th>
                <th>Note/15</th>
                <th>Comportement</th>
                <th>Note</th>
            </tr>
            <?php
            $c = 1;
            foreach ($Stagiaires as $row) {
                $inc_data = Calc_Note($row["CEF"]);
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
                <td>
                    <?php
                echo $inc_data['Nombre_Absence']
                        ?>
                </td>
                <td>
                    <?php
                echo $inc_data['Nombre_Retard']
                        ?>
                </td>
                <td>
                    <?php
                echo $inc_data['points']
                        ?>
                </td>
                <td>
                    <?php
                echo $inc_data['msg']
                        ?>
                </td>
                <td>
                    <?php
                echo $inc_data['note15']
                        ?>
                </td>
                <td><input class="input_val" value="0" type="number" /></td>
                <td>
                    <?php
                $cef = $row["CEF"];
                $sql = "SELECT  `note` FROM `note` WHERE `CEF` = ?";
                $pdo_statement = $conn->prepare($sql);
                $pdo_statement->bindParam(1, $cef);
                $pdo_statement->execute();
                $res = $pdo_statement->fetch();
                echo ($res[0])
                        ?>
                </td>
            </tr>
            <?php
            }
            ?>
            <input type="hidden" id="trcount" value="<?= $c ?>" />
        </table>
        <div class="valider">
            <input type="submit" value="valider" id="addNote">
        </div>
        <?php
        }
        ?>
    </main>
    <footer>
        <p>© Copyright | DevWFS205 |2022</p>
    </footer>

</body>

</html>