<?php
session_start();
if (empty($_SESSION) or $_SESSION['compteType'] !== "superAdmin") {
    header('location:./login.php');
}
// requier db and class :
include_once('../inc/db.php');
include_once('XLSXReader.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_FILES) && !empty($_POST)) {


    // geting Post data
    $file = $_FILES['file']['tmp_name'];
    $table = $_POST['table'];
    $anneeScolaire = "";
    if (!empty($_POST["annee-Scolaire"])) {
        $anneeScolaire = $_POST["annee-Scolaire"];
    }

    function insertModule($row)
    {
        global $conn;
        // featch the id based on name;
        $sql = "SELECT idFiliere FROM filiere WHERE  nomFiliere = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $row[1]);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_COLUMN);
        $row[1] = $result;
        // check if Module allready exist
        $check = "SELECT * FROM module WHERE nomModule = ? and idFiliere = ?";
        $pdo_statement = $conn->prepare($check);
        $pdo_statement->bindParam(1, $row[0]);
        $pdo_statement->bindParam(2, $row[1]);
        $pdo_statement->execute();
        $checkresult = $pdo_statement->fetch();
        if (empty($checkresult)) {
            // convert to array to str 
            $value = "'" . implode("','", $row) . "'";
            // insert int table
            $sql = "INSERT INTO module(`nomModule`,`idFiliere`) VALUES (" . $value . ")";
            $pdo_statement = $conn->prepare($sql);
            $pdo_statement->execute();

        }

    }


    // Formateur Function
    function insertFormateur($row)
    {
        global $conn;
        // check if Formateur allready exist
        $check = "SELECT * FROM formateur WHERE Matricule = ?";
        $pdo_statement = $conn->prepare($check);
        $pdo_statement->bindParam(1, $row[0]);
        $pdo_statement->execute();
        $checkresult = $pdo_statement->fetch();
        if (empty($checkresult)) {
            // convert to array to str 
            $value = "'" . implode("','", $row) . "'";
            // insert int table
            $sql = "INSERT INTO formateur(`Matricule`,`nomFormateur`,`prenomFormateur`) VALUES (" . $value . ")";
            $pdo_statement = $conn->prepare($sql);
            $pdo_statement->execute();
        }

    }

    // Stagiaire Function
    function insertStagiaire($row)
    {
        global $conn;
        global $anneeScolaire;
        if (!empty($anneeScolaire)) {

            // check if Stagiaire allready exist
            $check = "SELECT * FROM stagiaire WHERE CEF = ?";
            $pdo_statement = $conn->prepare($check);
            $pdo_statement->bindParam(1, $row[0]);
            $pdo_statement->execute();
            $checkresult = $pdo_statement->fetch();
            if (empty($checkresult)) {
                // Get Annee id 
                $sql = "SELECT idAnnee FROM annee WHERE  nomAnnee = ? and idAnneeScolaire = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(1, $row[3]);
                $stmt->bindParam(2, $anneeScolaire);
                $stmt->execute();
                $anneeID = $stmt->fetch(PDO::FETCH_COLUMN);
                if ($anneeID) {
                    // Get filiere id 
                    $sql = "SELECT idFiliere FROM filiere WHERE  nomFiliere = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(1, $row[4]);
                    $stmt->execute();
                    $filierID = $stmt->fetch(PDO::FETCH_COLUMN);
                    if ($filierID) {
                        ;

                        // check if group exists if it does not create it
                        $checkGrp = getIdGrp($row[5], $filierID);
                        if (!$checkGrp) {
                            $sql = "INSERT INTO `groupe`(`nomGroupe`,`idFiliere`) VALUES (?,?)";
                            $stmt = $conn->prepare($sql);
                            $stmt->bindParam(1, $row[5]);
                            $stmt->bindParam(2, $filierID);
                            $stmt->execute();
                        }


                        // insert Stagiaire 
                        $idgrp = getIdGrp($row[5], $filierID);
                        $sql = "INSERT INTO `stagiaire`(`CEF`, `nomStagiaire`, `prenomStagiaire`, `idGroupe`) VALUES (?,?,?,?)";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(1, $row[0]);
                        $stmt->bindParam(2, $row[1]);
                        $stmt->bindParam(3, $row[2]);
                        $stmt->bindParam(4, $idgrp);
                        $stmt->execute();
                    }

                }
            }
        }
    }



    // Main Function 
    function insterinto($data, $table)
    {
        global $conn;
        array_shift($data);
        pprint($data);
        echo "<hr>";
        $funcName = "insert" . "$table";
        foreach ($data as $arr) {
            $funcName($arr);
        }
        header("location:../Importer" . $table . ".php?msg=Operation Terminer Avec Success");
    }

    // geting data from the xlxs file
    $xlsx = new XLSXReader($file);
    $sheetNames = $xlsx->getSheetNames();
    foreach ($sheetNames as $sheetName) {
        $sheet = $xlsx->getSheet($sheetName);
        $data = $sheet->getData();
        insterinto($data, $table);
    }


    // repetitve sql query ;
    function getIdGrp($name, $idfilier)
    {
        global $conn;
        $sql = "SELECT idGroupe FROM groupe WHERE nomGroupe = ? and idFiliere = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $idfilier);
        $stmt->execute();
        $idgrp = $stmt->fetch(PDO::FETCH_COLUMN);
        return $idgrp;
    }



    // Module Function





} else {
    header('location:../login.php');
}