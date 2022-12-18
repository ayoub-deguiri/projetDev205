<?php
include_once('../inc/db.php');
include_once('XLSXReader.php');
include_once('../inc/pprint.php');

$file = $_FILES['file']['tmp_name'];
$table = $_POST['table'];
$xlsx = new XLSXReader($file);
$sheetNames = $xlsx->getSheetNames();
foreach ($sheetNames as $sheetName) {
    $sheet = $xlsx->getSheet($sheetName);
    $data = $sheet->getData();
    insterinto($data, $table);
}

// fonction pour les Module
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



// fonction  insertion
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


}