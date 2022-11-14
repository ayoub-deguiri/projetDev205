<?php
include_once('db.php');
session_start();
if (empty($_SESSION) or $_SESSION['compteType'] != "serveillant") {
    header('location:./login.php');
}
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["CEF"])) {
        $CEF = $_POST["CEF"];
        $sql = ' CALL Delete_Stagiaire_From_Group(?)';
        $pdo_statement = $conn->prepare($sql);
        $pdo_statement->bindParam(1, $CEF);
        $pdo_statement->execute();

?>
<script>
    alert("Opération terminée avec succès")
    location.reload();
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