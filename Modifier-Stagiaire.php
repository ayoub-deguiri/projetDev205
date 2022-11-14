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
        $sql = "SELECT nomGroupe from groupe where idGroupe = ?";
        $pdo_statement = $conn->prepare($sql);
        $pdo_statement->bindParam(1, $_SESSION["groupe"]);
        $pdo_statement->execute();
        $group = $pdo_statement->fetch();
        $_SESSION["nomGroupe"] = $group['nomGroupe'];
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
    <link rel="stylesheet" media="screen" href="./styles/Modifier-Stagiaire.css">
    <link rel="shortcut icon" href="./images/logoApp.png" type="image/x-icon">
    <title>Modifier-Stagiaire</title>
    <script src="./scripts/jquery-3.6.1.min.js"></script>
    <script>
        $(document).ready(function () {
            // Ajax for Modal
            $('.details').click(function (event) {
                let userid = $(this).data('id');
                $.get({
                    url: './inc/AjaxModal.php',
                    type: 'post',
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
            // count var
            const countrow = parseInt($('#trcount').val())
            // ajax for update Respo
            for (i = 1; i <= countrow; i++) {
                $("#tr-" + i + " input[type=radio]").on("click", function () {
                    let newRespo = $(this).val()
                    let oldRespo = $("#oldResponsable").val()
                    if (newRespo != "") {
                        $.post({
                            url: './inc/UpdateRespo.php',
                            data: { newRespo: newRespo, oldRespo: oldRespo },
                            success: function (data) {
                                $("#success-update").html(data)
                            }
                        });
                    }
                })
            }
            // ajax for Delete Stagiaire
            for (i = 1; i <= countrow; i++) {
                $("#tr-" + i + " button").on("click", function (ev) {
                    ev.preventDefault()
                    const CEF = $(this).val()
                    if (CEF) {
                        $.post({
                            url: './inc/DeleteStagiaire.php',
                            data: { CEF: CEF },
                            success: function (data) {
                                $("#success-delete").html(data)
                            }
                        });
                    }
                })
            }
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
                <a href=""><button><i class="fa fa-pencil-square" aria-hidden="true"></i>MODIFIER</button></a>
            </li>
            <li>
                <a href="#"><button><i class="fa fa-calendar-times-o" aria-hidden="true"></i>ABSENCE</button></a>
                <ul>
                    <li><a href="./Affichage-surveillant.html"><button>Affichage</button></a></li>
                    <li><a href="./saisir.html"><button>Saisir</button></a></li>
                </ul>
            </li>
            <li>
                <a href="./note.html"><button><i class="fa fa-calendar" aria-hidden="true"></i>NOTES</button> </a>
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
    <!-- Main Table -->
    <div class="listeEtudiants">
        <form id='table-form'>
            <?php
            if (empty($Stagiaires)) {
                echo "<div class='first-msg'>" . "<span>&#8592;</span>" . " Veuillez sélectionner un groupe " . "</div>";
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
                        <?= $row['nomStagiaire'] ?>

                    </td>
                    <td>
                        <?= $row['prenomStagiaire'] ?>
                    </td>
                    <td>
                        <input type="button" value="Info" data-id='<?php echo $row['CEF']; ?>' class="details" />
                    </td>
                    <td>
                        <?php
                    if ($row['CEF'] == $respo) {
                        ?>
                        <input type="radio" name="respo" value="<?= $row['CEF'] ?>" id="oldResponsable" checked
                            class="radiobtn">
                        <?php
                    } else {
                        ?>
                        <input type="radio" name="respo" value="<?= $row['CEF'] ?>" id="responsable" class="radiobtn">
                        <?php
                    }
                        ?>
                    </td>
                    <td>
                        <button class="btn-click" value="<?= $row['CEF'] ?>"><img src="./images/trash-2.svg" id='trash'
                                alt="Delete"></button>
                    </td>
                </tr>
                <?php
                }
            }
                ?>
                <input type="hidden" id="trcount" value="<?= $c ?>" />
            </table>
    </div>
    </main>
    </div>
    <div id="myModal" class="modal" role="dialog">

        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <div class="modal-header">
                <h4 class="modal-title">User Info</h4>
            </div>
            <div class="modal-body">
            </div>
        </div>
    </div>
    <div class="ajoute-valider">
        <div class="ajoute">
            <a href="./ajouterStagiaire.php?idgrp=<?= $_SESSION["groupe"] ?>"><img src="./images/plus-circle.svg"
                    alt="">
                <p>Ajouter</p>
            </a>
        </div>
        </form>
    </div>
    <input type="hidden" id="success-update"></input>
    <input type="hidden" id="success-delete"></input>
    <footer>
        <p>© Copyright | DevWFS205 |2022</p>
    </footer>
</body>

</html>