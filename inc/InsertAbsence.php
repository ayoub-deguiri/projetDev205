<?php
include_once('db.php');
session_start();
if (empty($_SESSION) or $_SESSION['compteType'] != "stagiaire") {
    header('location:./../login.php');
}
?>
<?php
$idgrp = $_SESSION['idgrp'];
// fetch all "stagiare" id's
$sql = "SELECT CEF FROM stagiaire WHERE idGroupe = $idgrp";
$pdo_statement = $conn->prepare($sql);
$pdo_statement->execute();
$result = $pdo_statement->fetchALL();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["valider"])) {
        // get data
        $date = $_POST['date'];
        $module = $_POST['module'];
        $formateur = $_POST['formateur'];
        foreach ($result as $cef) {
            $error = 1;
            $type = "";
            if (!empty($_POST['absence-' . $cef[0]])) {
                $type = 'absence';
                $error = 0;
            }
            if (!empty($_POST['retard-' . $cef[0]])) {
                $type = 'retard';
                $error = 0;
            }
            if ($error == 0) {
                // select for get id of annee + filire + anneescolaire
                $sql1 = "SELECT a.idAnnee , f.idFiliere, ann.idAnneeScolaire FROM annee a, filiere f, anneescolaire ann, groupe g ,stagiaire s WHERE s.idGroupe = g.idGroupe and g.idFiliere = f.idFiliere and f.idAnnee = a.idAnnee and ann.idAnneeScolaire = a.idAnneeScolaire AND s.CEF = $cef[0]";
                $pdo_statement = $conn->prepare($sql1);
                $pdo_statement->execute();
                $vars = $pdo_statement->fetch(PDO::FETCH_ASSOC);

                //variables
                $idfilire = $vars['idFiliere'];
                $idannee = $vars['idAnnee'];
                $idscolaire = $vars['idAnneeScolaire'];
                $timeDebut = $_POST['debut-' . $cef[0]];
                $timeFin = $_POST['Fin-' . $cef[0]];

                // insert int absence table
                $sql = "INSERT INTO absence (dateAbsence,heureDebutAbsence,heureFinAbsence,moduleAbsence,matricule,type,idAnnee,idFiliere,idGroupe,idAnneeScolaire,CEF)
                    VALUES (?,?,?,?,?,?,?,?,?,?,?)";
                $pdo_statement = $conn->prepare($sql);
                $pdo_statement->bindParam(1, $date);
                $pdo_statement->bindParam(2, $timeDebut);
                $pdo_statement->bindParam(3, $timeFin);
                $pdo_statement->bindParam(4, $module);
                $pdo_statement->bindParam(5, $formateur);
                $pdo_statement->bindParam(6, $type);
                $pdo_statement->bindParam(7, $idannee);
                $pdo_statement->bindParam(8, $idfilire);
                $pdo_statement->bindParam(9, $idgrp);
                $pdo_statement->bindParam(10, $idscolaire);
                $pdo_statement->bindParam(11, $cef[0]);
                $pdo_statement->execute();
                header('location:./../responsable.php');
            }
        }


    }
} else {
    header('location:./../responsable.php?errormsg="veuillez vérifier les informations saisies"');
}
?>