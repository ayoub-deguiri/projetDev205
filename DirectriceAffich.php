<?php
include_once('inc/db.php');
session_start();
if (empty($_SESSION) or $_SESSION['compteType'] != "directrice") {
    header('location:./login.php');
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["valider"])) {
        $_SESSION["anneeScolaire"] = $_POST["annee-Scolaire"];
        $_SESSION["annee"] = $_POST["annee"];
        $_SESSION["filiere"] = $_POST["filiere"];
        $_SESSION["groupe"] = $_POST["groupe"];
    }
}
$sql = "SELECT CEF ,nomStagiaire,prenomStagiaire from stagiaire where idGroupe in 
(select idGroupe from groupe where idGroupe= ? and idFiliere in ( select idFiliere from filiere where 
idFiliere=? and idAnnee in 
(select idAnnee from annee where idAnnee=? and idAnneeScolaire in 
(select idAnneeScolaire from anneescolaire where idAnneeScolaire=?)
)))";
$pdo_statement = $conn->prepare($sql);
$pdo_statement->bindParam(1, $_SESSION["groupe"]);
$pdo_statement->bindParam(2, $_SESSION["filiere"]);
$pdo_statement->bindParam(3, $_SESSION["annee"]);
$pdo_statement->bindParam(4, $_SESSION["anneeScolaire"]);
$pdo_statement->execute();
$result1 = $pdo_statement->fetchAll();
if (empty($result1)) {
    header('location:./accueil-directrice.php');
}

?>
<!-- --------------------------------------------- -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" media="screen" href="./styles/Affichage_directrice.css">
   
    <link rel="shortcut icon" href="./images/logoApp.png" type="image/x-icon">
    <title>Directrice </title>
</head>

<body style="background-color:#D8E6EA">
    <div id="HomePage">
        <div id="container">
            <!--*********************************************************************************-->
            <header>
                <div class="logo-OFPPT">
                    <img src="./images/Ofpptlogo.png" height="100px" width="100px" alt="ErreurlogoOFPPT">
                </div>
                <div class="logo-APP">
                    <img src="./images/logoApp.png" height="100px" width="140px" alt="ErreurlogoOFPPT">
                </div>
                <div class="déconnexion">
                    <button type="button" id="Déconnexion"><a href="logout.php">Déconnexion</a></button>
                </div>
            </header>
            <!--*********************************************************************************-->
            <main>
                <div>
                    <h2> </h2>
                </div>
                <table style="background-color:#ffffff">
                    <tr>
                        <th>CEF</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Nombre <br>absence</th>
                        <th>Nombre <br> retard</th>
                        <th>Note </th>
                    </tr>
                    <?php
                    foreach ($result1 as $row) {
                        echo "<tr>
                        <td>" . $row['CEF'] . "</td><td>" . $row['nomStagiaire'] . "</td><td>" . $row['prenomStagiaire'] . "</td>";
                        // count absence
                        $sql = 'SELECT count(idAbsence) as NombreAbsence from absence where CEF = ? and type="absence"';
                        $pdo_statement = $conn->prepare($sql);
                        $pdo_statement->bindParam(1, $row['CEF']);
                        $pdo_statement->execute();
                        $result4 = $pdo_statement->fetch();
                        echo "<td>" . $result4["NombreAbsence"] . "</td>";

                        // count retard
                        $sql = 'SELECT count(idAbsence) as NombreRetard from absence where CEF = ? and type="retard"';
                        $pdo_statement = $conn->prepare($sql);
                        $pdo_statement->bindParam(1, $row['CEF']);
                        $pdo_statement->execute();
                        $result5 = $pdo_statement->fetch();
                        echo "<td>" . $result5["NombreRetard"] . "</td>";

                        // Note
                        $sql = 'SELECT Note from note where CEF = ?';
                        $pdo_statement = $conn->prepare($sql);
                        $pdo_statement->bindParam(1, $row['CEF']);
                        $pdo_statement->execute();
                        $result6 = $pdo_statement->fetch();
                        if (empty($result6)) {
                            echo "<td>Le stagiaire n'a aucun note </td>";
                        } else {
                            echo "<td>" . $result6["Note"] . "</td>";
                        }
                    }
                    ;
                    ?>
                </table>
            </main>
            <!--*********************************************************************************-->
            <footer>
                <p> © Copyright | DevWFS205 |2022 </p>
            </footer>
        </div>
    </div>
</body>

</html>
