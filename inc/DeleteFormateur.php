<?php
include_once('db.php');
session_start();
if (empty($_SESSION) or $_SESSION['compteType'] != "superAdmin") {
    header('location:./login.php');
}
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["matricule"])) {
        $matricule = $_POST["matricule"];
        $sql = 'DELETE FROM formateur WHERE formateur.Matricule = ?';
        $pdo_statement = $conn->prepare($sql);
        $pdo_statement->bindParam(1, $matricule);
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
    alert("L'opération n'a pas réussi")
    location.reload();
</script>;
<?php
    }
} else {
    header('location:./login.php');
}
?>