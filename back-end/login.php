<?php
include('db.php');
session_start();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // get user and password
    $user = $_POST["matricule"];
    $password = $_POST["password"];
    

    // Validate Form Data  
    $user = htmlspecialchars($user);
    $user = trim($user);
    $user = stripslashes($user);
    $_SESSION['CEF'] = $user;

    $password = htmlspecialchars($password);
    $password = trim($password);
    $password = stripslashes($password);


    // feching the data 
    $sql = "SELECT * FROM  compte  WHERE user = ? and password = ?";
    $pdo_statement = $conn->prepare($sql);
    $pdo_statement->bindParam(1, $user);
    $pdo_statement->bindParam(2, $password);
    $pdo_statement->execute();
    $result = $pdo_statement->fetch();


     // redrection to main pages 
     if (empty($result)) {
        header('location:./../login.html');
    } else {
        if ($result['compteType'] == 'stagire') {
            header('location:./../responsable.html');
        } elseif ($result['compteType'] == 'directrice') {
            header('location:./accueil-directrice.php');
        }
        // anzidoha fach yt9ado les page t surveillance general
        //elseif ($result['compteType'] == 'sg') {
        //     header('location:./../accueil-sg.html');
        // }
    }
}

// created by Rguibi Marouane  and Idrissi Mohammed 