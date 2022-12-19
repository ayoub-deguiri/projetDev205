<?php
include_once('inc/db.php');
session_start();
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["AjaxValider"])) {

    $_SESSION["anneeScolaire"] = $_GET["annee-Scolaire"];
    $_SESSION["annee"] = $_GET["annee"];
    $_SESSION["filiere"] = $_GET["filiere"];
    // get all filiere 
    $sql = "SELECT nomModule from module where idFiliere = ?";
    $pdo_statement = $conn->prepare($sql);
    $pdo_statement->bindParam(1, $_GET["filiere"]);
    $pdo_statement->execute();
    $Modules = $pdo_statement->fetchAll(PDO::FETCH_COLUMN);

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" media="screen" href="./styles/modifier.css">
    <link rel="stylesheet" href="./styles/ImporterModule.css">
    <link rel="shortcut icon" href="./images/logoApp.png" type="image/x-icon">
    <title>modifier</title>
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
            $("#validerAjax").click(function (ev) {
                if ($('#année').val() === null) {
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
                <a href="./creation.php"><button>Création</button></a>
            </li>
            <li>
                <a href="./ImporterModule.php"><button class="module">Module</button></a>
            </li>
            <li>
                <a href="./ImporterFormateur.php"><button>Formateur</button></a>
            </li>
            <li>
                <a href="./ImporterStagiaire.php"><button>Stagiaire</button> </a>
            </li>
        </ul>
    </nav>
    <?php
    if (!empty($_GET['msg'])) {
        echo '<h2 style="text-align: center;color : green;margin-top:2%">' . $_GET['msg'] . '</h2>';
    }
    ?>
    <form action="" method="GET">
        <div class="container">
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
                <li> <label for="filier" id='filiérelb'>filière</label></li>
                <li>
                    <select id="filiére" name="filiere" required></select>
                </li>
                <li><input type="submit" name="AjaxValider" onclick="checkobligatoire()" value="Valider"
                        id="validerAjax"> </li>
            </ul>
        </div>
    </form>
    <main>
        <form method="POST" action="./libs/Main.php" enctype="multipart/form-data">
            <div class="selects">
                <ul>
                    <li> <label for="">
                            <h3>Importer module</h3>
                        </label></li>
                    <li>
                        <div class="telecharger"> <img src="./images/upload-cloud.svg" alt="" srcset=""
                                id="icon-upload">
                            <a href="./CSV_Files_Examples/Module.csv" download="Module.csv"><input type="button"
                                    value="Télécharger" id="telecherger"></a>
                        </div>
                    </li>

                    <li>
                        <div class="validerImporter">
                            <input type="hidden" name="table" value="Module">
                            <input type="submit" name="Submit" value="Valider" id="valider" onclick=" return vk()">
                            <input type="file" name="file" id="file">
                            <label for="file" id='buttonPhoto'>Importer</label>
                        </div><span id="lbimport"></span>

                    </li>

                </ul>
        </form>
        <br>

        </div>
        <div class="listeModules">
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "GET" and isset($_GET["AjaxValider"]) and empty($Modules)) {
                echo "<div class='first-msg-2'>" . "<span>&#8593;</span>" . " Aucune Module attribuée a ce groupe ,Veuillez sélectionner un autre groupe " . "</div>";
            } elseif (empty($Modules)) {
                echo "<div class='first-msg'>" . "<span>&#8593;</span>" . " Veuillez sélectionner un groupe " . "</div>";
            } else {
            ?>
            <table>
                <tr>
                    <th>Nom module</th>
                </tr>
                <?php
                $c = 1;
                foreach ($Modules as $row) {
                ?>
                <tr>
                    <td>
                        <?= $row ?>
                    </td>
                </tr>
                <?php
                }


                ?>
            </table>
            <?php
            }


            ?>
        </div>
        <div class="buttonInserer">
            <a href="./ImporterFormateur.php"><button type="button" id="inserer"> Insérer Formateur
                    &#10154;</button></a>
        </div>


    </main>

    <footer>
        <p>© Copyright | DevWFS205 |2022</p>
    </footer>

    <script>
        var file = document.getElementById('file')
        var lbimport = document.getElementById('lbimport')
        function vk() {
            var etat;
            if (file.value == '') {
                etat = false
                lbimport.innerHTML = 'please check your import file '
            }
            else {
                etat = true
            }
            return etat
        }
    </script>
    <script>
        var annéescolaire = document.getElementById('année-scolaire')
        var année = document.getElementById('année')
        function checkobligatoire() {
            var etat1, etat2;
            if (annéescolaire.value == '') {
                etat1 = false
                annéescolaire.style.border = '2px solid red'
            }
            else {
                etat1 = true
                annéescolaire.style.border = '2px solid var(--color2)'
            }
            if (année.value == '') {
                etat3 = false
                année.style.border = '2px solid red'
            }
            else {
                etat3 = true
                année.style.border = '2px solid var(--color2)'
            }

            if (etat1 == false || etat2 == false) {

                return false
            }
            else {

                return true
            }


        }
    </script>

</body>

</html>