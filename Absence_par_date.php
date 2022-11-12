<?php
include_once('./inc/db.php');
session_start();
if (empty($_SESSION) or $_SESSION['compteType'] !== "serveillant") {
    header('location:./login.php');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $type = "";
    $error = 1;
    if (isset($_POST['absence'])) {
        $type = 'absence';
        $error = 0;
    }
    if (isset($_POST['retard'])) {
        $type = 'retard';
        $error = 0;
    }

    if ($error == 0) {
        $dateAbsence = $_POST["date-sent"];
        $sql = "SELECT a.CEF ,s.nomStagiaire,s.prenomStagiaire,f.nomFormateur ,a.type,a.heureDebutAbsence
        ,a.heureFinAbsence,a.idAbsence,moduleAbsence,g.nomGroupe from absence a ,groupe g ,stagiaire s , 
        formateur f where s.CEF=a.CEF and a.matricule=f.matricule and a.idGroupe=g.idGroupe and a.dateAbsence=? and a.type=?";
        $pdo_statement = $conn->prepare($sql);
        $pdo_statement->bindParam(1, $dateAbsence);
        $pdo_statement->bindParam(2, $type);
        $pdo_statement->execute();
        $AbsencesAujourdhui = $pdo_statement->fetchAll();
    }
} else {
    header('location:./Accueil-serveillant.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" media="screen" href="./styles/Absence_par_date.css">
    <script src="./scripts/jquery-3.6.1.min.js"></script>
    <script>
        $(document).ready(function () {
            let errorgenral = 0
            const countrow = parseInt($('#trcount').val())
            $('#validee').click(function (ev) {
                for (i = 1; i <= countrow; i++) {
                    let checkboxLength = $("#tr-" + i + " input:checkbox:checked").length
                    if (checkboxLength == 1) {
                        if ($("#tr-" + i + " input[type=text]").val() == "") {
                            $('#tr-' + i).css({
                                "color": "red",
                            });
                            errorgenral = 1
                        } else {
                            errorgenral = 0
                            $('#tr-' + i).css({
                                "color": "green",
                            });
                        }
                    } else {
                        $('#tr-' + i).css({
                            "color": "black",
                        });
                    }
                }
                if (errorgenral == 0) {
                    alert("Enregistré avec succès")
                } else {
                    ev.preventDefault()
                    alert('vous avez oublié quelque chose, veuillez revérifier ce que vous avez saisi')
                }
            })
        });
    </script>
    <title>Absence Date</title>

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
                <a href="./modification.html"><button><i class="fa fa-pencil-square"
                            aria-hidden="true"></i>MODIFIER</button></a>
            </li>
            <li>
                <a href="#"><button><i class="fa fa-calendar-times-o" aria-hidden="true"></i>ABSENCE</button></a>
                <ul>
                    <li><a href=""><button>Affichage</button></a></li>
                    <li><a href=""><button>Saisir</button></a></li>
                </ul>
            </li>
            <li>
                <a href="./note.html"><button><i class="fa fa-calendar" aria-hidden="true"></i>NOTES</button> </a>
            </li>
            <li>
                <a href="./Ajouter.html"><button><i class="fa fa-plus-circle"
                            aria-hidden="true"></i>AJOUTER</button></a>
            </li>
        </ul>
    </nav>
    <h2 class="titre">Les absences de
        <?php echo $dateAbsence ?>
    </h2>
    <article>
        <main>
            <form method="POST" action="./inc/JestufierAbs.php">
                <?php
                if (empty($AbsencesAujourdhui)) {
                    if (isset($_POST['absence'])) {
                        echo "<div class='first-msg'>" . "Pas d'absentéisme de se jour Monsieur" . "<di>";
                    }
                    if (isset($_POST['retard'])) {
                        echo "<div class='first-msg'>" . " Aucun retard cette journée, Monsieur." . "<di>";
                    }
                } else {
                ?>
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
                    $c = 1;
                    foreach ($AbsencesAujourdhui as $row) {
                    ?>
                    <tr id="tr-<?= $c++ ?>">
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
                        <td><input type="checkbox" name="check-btn-<?= $row['CEF'] ?>" onclick="Enable(this)"
                                class="btn1">
                        </td>
                        <td><input class="commentaire" type="text" name="justif-<?= $row['CEF'] ?>" disabled></td>
                        <td><input type="hidden" name="idAbs-<?= $row['CEF'] ?>" value="<?= $row['idAbsence'] ?>"> </td>
                    </tr>
                    <?php
                    }
                }
                    ?>
                    <input type="hidden" id="trcount" value="<?= $c ?>" />
                </table>
        </main>
        <div class="valider">
            <input type="submit" value="valider" id="validee" name="sent">
        </div>
        </form>
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
    </article>
    <footer>
        <p>© Copyright | DevWFS205 |2022</p>
    </footer>
</body>

</html>