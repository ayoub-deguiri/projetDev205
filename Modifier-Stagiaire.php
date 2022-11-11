<?php
include('inc/db.php');
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
        $sql = "SELECT CEF ,nomStagiaire,prenomStagiaire from stagiaire where groupe_idGroupe in 
                (select idGroupe from groupe where idGroupe=? and filiere_idFiliere in ( select idFiliere from filiere where 
                idFiliere=? and anneeScolaire_idAnneeScolaire in 
                (select idAnneeScolaire from anneeSColaire where idAnneeScolaire=? and annee_idAnnee in 
                (select idAnnee from annee where idAnnee=?)
                )));";
        $pdo_statement = $conn->prepare($sql);
        $pdo_statement->bindParam(1, $_SESSION["groupe"]);
        $pdo_statement->bindParam(2, $_SESSION["filiere"]);
        $pdo_statement->bindParam(3, $_SESSION["annee"]);
        $pdo_statement->bindParam(4, $_SESSION["anneeScolaire"]);
        $pdo_statement->execute();
        $Stagiaires = $pdo_statement->fetchAll();
        // get group name 
        $sql = "SELECT nomGroupe from groupe where idGroupe = ?";
        $pdo_statement = $conn->prepare($sql);
        $pdo_statement->bindParam(1, $_SESSION["groupe"]);
        $pdo_statement->execute();
        $group = $pdo_statement->fetch();
        // get Respo
        $respo = "";
        $sql = "SELECT user FROM compte";
        $pdo_statement = $conn->prepare($sql);
        $pdo_statement->execute();
        $users = $pdo_statement->fetchAll(PDO::FETCH_COLUMN);
        foreach ($Stagiaires as $stg) {
            if (in_array($stg['CEF'], $users)) {
                $respo = $stg['CEF'];
            }
        }
    }
}
?>
<!--html-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" media="screen" href="./styles/modifier.css">
    <link rel="shortcut icon" href="./images/logoApp.png" type="image/x-icon">
    <title>modifier</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"
        integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
        crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {
            $('.details').click(function (event) {
                let userid = $(this).data('id');
                $.ajax({
                    url: './inc/AjaxModal.php',
                    type: 'post',
                    data: { userid: userid },
                    success: function (response) {
                        $('.modal-body').html(response);
                        $('#empModal').modal('show');
                    }
                })

            });
            $('.close').click(function () {
                $('#empModal').modal('hide');
            })
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
    <!-- Ajax select -->
    <form action="" method="post">
        <main>
            <div class="selects">
                <ul>
                    <li> <label for="année-scolaire">année scolaire</label></li>
                    <?php
                    $sql = ("SELECT * FROM annee ");
                    $pdo_statement = $conn->prepare($sql);
                    $pdo_statement->execute();
                    $annee = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                    <li><select name="annee-Scolaire" id="année-scolaire">
                            <option value="" disabled selected>Année Scolaire</option>
                            <?php
                            if (isset($annee)) {
                                foreach ($annee as $row) {
                            ?>
                            <option value="<?= $row['idAnnee'] ?>">
                                <?= $row['nomAnnee'] ?>
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
                    <li><input type="submit" name="AjaxValider" value="valider" id="valider"
                            onclick=" return checkdelects()"> </li>
                </ul>
    </form>
    </div>
    <!-- Main Table -->
    <div class="listeEtudiants">
        <form action="test.php" id='table-form' method="post">
            <?php
            if (empty($Stagiaires)) {
                echo "<div class='first-msg'>" . "<span>&#8592;</span>" . " Veuillez sélectionner un groupe " . "<di>";
            } else {
            ?>
            <table>
                <caption>Group :
                    <?= $group['nomGroupe'] ?>
                </caption>
                <tr>
                    <th>cEF</th>
                    <th>nom</th>
                    <th>prénom</th>
                    <th>détails</th>
                    <th>responsable</th>
                    <th>supprimer</th>
                </tr>
                <?php
                foreach ($Stagiaires as $row) {
                    $c = 1;
                ?>
                <tr id="tr-<?= $c++ ?>">
                    <td>
                        <?= $row["CEF"] ?>
                    </td>
                    <td>
                        <?= $row['prenomStagiaire'] ?>
                    </td>
                    <td>
                        <?= $row['nomStagiaire'] ?>
                    </td>
                    <td>
                        <input type="button" value="Info" data-id='<?php echo $row['CEF']; ?>' class="details " />
                    </td>
                    <td>
                        <?php
                    if ($row['CEF'] == $respo) {
                        ?>
                        <input type="radio" name="responsable" id="responsable" checked class="radiobtn">
                        <?php
                    } else {
                        ?>
                        <input type="radio" name="responsable" id="responsable" class="radiobtn">
                        <?php
                    }
                        ?>
                    </td>
                    <td><a href="#"> <img src="./images/trash.svg" id='trash' alt=""></a> </td>
                </tr>
                <?php
                }
            }
                ?>
            </table>
    </div>
    </main>
    </div>
    <div class="modal fade" id="empModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <span class="close">&times;</span>
                <div class="modal-header">
                    <h4 class="modal-title">User Info</h4>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>
    <div class="ajoute-valider">
        <div class="ajoute">
            <a href="#"><img src="./images/plus-circle.svg" alt="">
                <p>Ajouter</p>
            </a>

        </div>
        <div class="valider">
            <input type="submit" value="valider" id="valider-responsable" onclick="return btnr()">
        </div>
        </form>
    </div>

    <footer>
        <p>© Copyright | DevWFS205 |2022</p>
    </footer>



    <script>

        /*                  check select form     */
        var groupe = document.getElementById('groupe')
        var annee = document.getElementById('annee')
        var anneescolaire = document.getElementById('anneescolaire')
        var filier = document.getElementById('filier')

        function checkdelects() {
            var etat1, etat2, etat3, etat4
            if (groupe.value == 'rien') {
                groupe.style.border = '2px solid red'
                etat1 = true
            }
            else {
                groupe.style.border = '2px solid  blue'
                etat2 = false
            }

            if (annee.value == 'rien') {
                annee.style.border = '2px solid red'
                etat2 = true
            }
            else {
                annee.style.border = '2px solid  blue'
                etat2 = false
            }

            if (anneescolaire.value == 'rien') {
                anneescolaire.style.border = '2px solid red'
                etat3 = true
            }
            else {
                anneescolaire.style.border = '2px solid  blue'
                etat3 = false
            }
            if (filier.value == 'rien') {
                filier.style.border = '2px solid red'
                etat4 = true
            }
            else {
                filier.style.border = '2px solid  blue'
                etat4 = false
            }
            if (etat1 == true || etat2 == true || etat3 == true || etat4 == true)
                etatgeneral = false
            else
                etatgeneral = true

            return etatgeneral

        }
        var radiobtn = document.getElementsByClassName('radiobtn')
        function btnr() {
            var etat = false;
            for (let i = 0; i < radiobtn.length; i++) {
                if (radiobtn[i].checked == true)
                    etat = true
            }
            return etat
        }
    </script>
</body>

</html>