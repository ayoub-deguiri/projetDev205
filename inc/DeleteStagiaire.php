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
        $sql = ' CALL Delete_Stagiaire_From_Group(?)';
        $pdo_statement = $conn->prepare($sql);
        $pdo_statement->bindParam(1, $CEF);
        $pdo_statement->execute();
?>
<script>
    location.reload();
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