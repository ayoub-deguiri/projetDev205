<?php
// requier db and class :
include_once('../inc/db.php');
include_once('XLSXReader.php');


// geting data and file
$file = $_FILES['file']['tmp_name'];
$table = $_POST['table'];
$xlsx = new XLSXReader($file);
$sheetNames = $xlsx->getSheetNames();
foreach ($sheetNames as $sheetName) {
    $sheet = $xlsx->getSheet($sheetName);
    $data = $sheet->getData();
    insterinto($data, $table);
}


// Module Function
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


// Main Function 
function insterinto($data, $table)
{
    global $conn;
    array_shift($data);
    pprint($data);
    if ($table == "Module") {
        foreach ($data as $arr) {
            insertModule($arr);
        }
        header('location:../ImporterModules.php?msg=Operation Terminer Avec Success');

    }
    if ($table == "Formateur") {
        foreach ($data as $arr) {
            insertFormateur($arr);
        }
        header('location:../ImporterFormateur.php?msg=Operation Terminer Avec Success');

    }
    if ($table == "Stagiare") {
        foreach ($data as $arr) {
            insertFormateur($arr);
        }
        header('location:../ImporterFormateur.php?msg=Operation Terminer Avec Success');

    }


}