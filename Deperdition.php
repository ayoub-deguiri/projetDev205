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
        $sql = "SELECT CEF ,nomStagiaire,prenomStagiaire from deleted_stagiaire where idGroupe = ?";
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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" media="screen" href="./styles/snackbar.css.">
    <link rel="stylesheet" media="screen" href="./styles/DeperditionCss.css">
    <link rel="shortcut icon" href="./images/logoApp.png" type="image/x-icon">
    <script src="./scripts/jquery-3.6.1.min.js"></script>


    <title>Document</title>
    <script>
        $(document).ready(function() {
            $('.details').click(function (event) {
                let userid = $(this).data('id');
                $.get({
                    url: './inc/AjaxModal.php',
                    type: 'GET',
                    data: { userid: userid },
                    success: function (response) {
                        $('.modal-body').html(response);
                    }
                })
                $('#myModal').show();
            });
            $('.close').click(function () {
                $('#myModal').hide();
            })
            // Ajax for select
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

            $(".DeperditionCHECK").on('change', function () {
                if ($(this).is(':checked')) {
                    const CEF = $(this).val()
                    if (CEF) {
                        $.get({
                            url: './inc/deleteStagiaire_deper.php',
                            data: { CEF: CEF },
                            success: function (data) {
                                $("#success-delete").html(data)
                            }
                        });
                    }
                }
            })
            
        })
    </script>

</head>

<body>
    <!--header-->
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
    <!--Fin-header-->
    <!--nav-bar-->
    <nav>
        <ul>
            <li>
                <a href="./Accueil-serveillant.php"><button><i class="fa fa-home" aria-hidden="true"></i>ACCUEIL</button></a>
            </li>
            <li>
                <a href="./Modifier-Stagiaire.php"><button><i class="fa fa-pencil-square" aria-hidden="true"></i>MODIFIER</button></a>
            </li>
            <li>
                <a href=""><button><i class="fa fa-calendar-times-o" aria-hidden="true"></i>ABSENCE</button></a>
                <ul>
                    <li><a href="./Affichage-surveillant.php"><button>Affichage</button></a></li>
                    <li><a href="./SasireAbsence-surveillant.php"><button>Saisir</button></a></li>
                </ul>
            </li>
            <li>
                <a href="./note.html"><button><i class="fa fa-calendar" aria-hidden="true"></i>NOTES</button> </a>
            </li>
            <li>
                <a href="#"><button><i class="fa fa-plus-circle" aria-hidden="true"></i>Deperdition</button></a>
            </li>
            <li>
                <a href="#"><button><i aria-hidden="true"></i>Justifier</button></a>
            </li>
        </ul>
    </nav>
    <!--fin-navbar-->
    <!--filtrer-tableau-->
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
    <!--Fin-filtrer-tableau-->
    <!--Filtrer-tableau-->
    <div class="title">
        <h1 id="bienvenue">
            <?php if (isset($_SESSION["nomGroupe"])) {
                echo 'Liste ' . $_SESSION["nomGroupe"];
            }  ?>
        </h1>
    </div>
    <!--fin-filtrer-tableau-->
    <!--tableau-->
    <div>

        <main>
            <div>

                <?php

                if (empty($Stagiaires)) {
                    echo "<div class='first-msg'>" . "<span>&uarr;</span>" . " Veuillez sélectionner un groupe " . "</div>";
                } else {
                ?>
                    <table>
                        <tr>
                            <th>CEF</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Groupe</th>
                            <th>Details</th>
                            <th>Supprimer</th>

                        </tr>
                        <?php
                        $c = 1;
                        foreach ($Stagiaires as $row) {
                            $id = $row['CEF'];
                        ?>
                            <tr id="tr-<?= $c++ ?>">
                                <td><?= $row['CEF'] ?></td>
                                <td><?= $row['prenomStagiaire'] ?></td>
                                <td><?= $row['nomStagiaire'] ?></td>
                                <td><?= $_SESSION["nomGroupe"] ?></td>
                                <td><input type="button" id="btn1" onclick="modalfn()" class='details' value="Cliquer"></td>

                                <td> <label class="switch">
                                        <input value="<?= $row['CEF'] ?>" class="DeperditionCHECK" type="checkbox">
                                        <span class="slider round"></span>
                                    </label></td>
                            </tr>
                        <?php
                        }
                        ?>

                    </table>
                <?php
                }
                ?>
               
            </div>
        </main>

        <div id="myModal" class="modal" role="dialog">

            <!-- Modal content -->
            <div class="modal-content">
                <div><span class="close">&times;</span></div>
                <div class="modal-header">
                    <h4 class="modal-title">l'historique du stagiaire :</h4>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>

    </div>
    </div>
    <!--fin-tableau-->
    <div id="snackbar">l'opération terminée avec succes..</div>
    <input type="hidden" id="result"></input>
    <input type="hidden" id="success-delete"></input>

    <!--footer-->
    <footer>
        <p>© Copyright | DevWFS205 |2022</p>
    </footer>
    <!--fin-->
    <script>
        // Get the modal
        var modal = document.getElementById("myModal");



        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on the button, open the modal
        function modalfn() {
            modal.style.display = "block";

        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
    <script>
        function myFunction() {

            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'message',
                showConfirmButton: false,
                timer: 3000
            })
        }
    </script>
</body>

</html>