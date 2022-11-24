<?php
include_once('db.php');
session_start();
if (empty($_SESSION) or $_SESSION['compteType'] != "serveillant") {
    header('location:./login.php');
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && !empty($_GET['CEF'])) {
    $cef = $_GET['CEF'];
    $comptetype = 'stagiaire';
    $sql = 'INSERT INTO  compte VALUES (?,?,?)';
    $pdo_statement = $conn->prepare($sql);
    $pdo_statement->bindParam(1, $cef);
    $pdo_statement->bindParam(2, $cef);
    $pdo_statement->bindParam(3, $comptetype);
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
    header('location:./Accueil-serveillant.php');
}