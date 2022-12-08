<?php
include_once('db.php');
session_start();
if (empty($_SESSION) or $_SESSION['compteType'] != "serveillant") {
    header('location:./login.php');
}
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["idabs"])) {
    $idabs = $_POST["idabs"];
    $sql = 'DELETE FROM justifierabsence WHERE idAbsence = ?';
    $pdo_statement = $conn->prepare($sql);
    $pdo_statement->bindParam(1, $idabs);
    $pdo_statement->execute();
?>
<script>
    // Get the snackbar DIV
    var x = document.getElementById("snackbar");
    // Add the "show" class to DIV
    x.className = "show";
    // After 3 seconds, remove the show class from DIV
    setTimeout(function () { x.className = x.className.replace("show", ""); location.reload(); }, 2000);
</script>
<?php

} else {
    header('location:./login.php');
}
?>