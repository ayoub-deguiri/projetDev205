<?php
$servername = "localhost";
$username="root";
$password="root";
$databaseN = "ProjectBase_WFS205";

try{
    $pdo_conn = new PDO("mysql:host=$servername;dbname=$databaseN",$username,$password);
   
    $pdo_conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    // echo "Wash a moussaoui ";
    
}catch(PDOException $e){
    echo "Connection Failed  : " . $e->getMessage();

}

?>

