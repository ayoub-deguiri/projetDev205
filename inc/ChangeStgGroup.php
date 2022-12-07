<?php
include_once('db.php');
session_start();
if (empty($_SESSION) or $_SESSION['compteType'] != "serveillant") {
    header('location:./login.php');
}
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && !empty($_GET["cef"]) && !empty($_GET['grpid'])) {
    $cef = $_GET["cef"];
    $sql1 = 'SELECT CEF FROM stagiaire WHERE CEF = ?';
    $pdo_statement = $conn->prepare($sql1);
    $pdo_statement->bindParam(1, $cef);
    $pdo_statement->execute();
    $result = $pdo_statement->fetch();
    if (!empty($result)) {
        $grpid = $_GET["grpid"];
        $sql = 'UPDATE stagiaire SET idGroupe=(?) WHERE CEF =(?)';
        $pdo_statement = $conn->prepare($sql);
        $pdo_statement->bindParam(1, $grpid);
        $pdo_statement->bindParam(2, $cef);
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
    // Get the snackbar DIV
    var x = document.getElementById("snackbar");
    // Add the "show" class to DIV
    x.innerHTML = "le CEF est incorrecte"
    x.className = "showfailed";
    setTimeout(function () { x.className = x.className.replace("showfailed", "") }, 2000);
</script>;
<?php
    }
} else {
    header('location:../modifier-groupe.php');

}