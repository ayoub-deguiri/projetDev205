<?php
include_once('db.php');
session_start();
if (empty($_SESSION) or $_SESSION['compteType'] != "serveillant") {
    header('location:./login.php');
}
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (!empty($_GET["date"])) {
        $date = $_GET["date"];
        $absence = 'absence';
        $sql = 'SELECT Get_CountAbs_Date(?,?) AS nbr';
        $pdo_statement = $conn->prepare($sql);
        $pdo_statement->bindParam(1, $date);
        $pdo_statement->bindParam(2, $absence);
        $pdo_statement->execute();
        $nbrAbs = $pdo_statement->fetch();
        // nbrRet CureDate
        $retard = 'retard';
        $sql = 'SELECT Get_CountAbs_Date(?,?) AS nbr';
        $pdo_statement = $conn->prepare($sql);
        $pdo_statement->bindParam(1, $date);
        $pdo_statement->bindParam(2, $retard);
        $pdo_statement->execute();
        $nbrRet = $pdo_statement->fetch();
        $json = array('abs' => $nbrAbs[0], 'ret' => $nbrRet[0]);
        $json_data = json_encode($json);
        echo $json_data;
    }

} else {
    echo "<script>
        alert('access denied');
        window.location.href='./Affichage-surveillant.html';
        </script>";
}
?>