<?php
include_once('db.php');
// jestufier
// fetch all "stagiare" id's
$sql = "SELECT CEF FROM stagiaire";
$pdo_statement = $conn->prepare($sql);
$pdo_statement->execute();
$result = $pdo_statement->fetchALL();
foreach ($result as $cef) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['sent']) && isset($_POST['check-btn-' . $cef[0]]) && !empty($_POST['justif-' . $cef[0]])) {
            $sql = "INSERT INTO `justifierabsence`(`idAbsence`, `Justifie_motif`) VALUES (?,?)";
            $pdo_statement = $conn->prepare($sql);
            $pdo_statement->bindParam(1, $_POST['idAbs-' . $cef[0]]);
            $pdo_statement->bindParam(2, $_POST['justif-' . $cef[0]]);
            $pdo_statement->execute();
            header('location:../Accueil-serveillant.php');
        } else {
            header('location:../Absence_par_date.php');
        }
    }
}