<?php
include_once('db.php');
session_start();
if (empty($_SESSION) or $_SESSION['compteType'] != "serveillant") {
    header('location:./login.php');
}
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (!empty($_GET["CEF"])) {
        $CEF = $_GET["CEF"];
        $sql = "DELETE FROM deleted_stagiaire
        WHERE CEF = ? ;";
        $pdo_statement = $conn->prepare($sql);
        $pdo_statement->bindParam(1, $CEF);
        $pdo_statement->execute(); 
?>
<script>
    // Get the snackbar DIV
    var x = document.getElementById("snackbar");
    // Add the "show" class to DIV
    x.className = "show";
    // After 3 seconds, remove the show class from DIV
    setTimeout(function () { x.className = x.className.replace("show", ""); location.reload(); }, 2000);
</script>;
<?php

    } else {
?>
<script>
    location.reload();
</script>;
<?php
    }
} else {
    header('location:./Accueil-serveillant.php');
}
?>