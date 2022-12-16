<?php
include_once('db.php');
session_start();
if (empty($_SESSION) or $_SESSION['compteType'] != "serveillant") {
    header('location:./login.php');
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && !empty($_GET['cef']) && !empty($_GET['Comportement'])) {
    $cef = $_GET['cef'];
    $Comportement = $_GET['Comportement'];
    $sql = 'UPDATE `note` 
            SET note = note+? WHERE CEF = ?';
    $pdo_statement = $conn->prepare($sql);
    $pdo_statement->bindParam(1, $Comportement);
    $pdo_statement->bindParam(2, $cef);
    $pdo_statement->execute();
}