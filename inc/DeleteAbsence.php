<?php
include_once('db.php');
session_start();
if (empty($_SESSION) or $_SESSION['compteType'] != "serveillant") {
    header('location:./login.php');
}
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["idAbsence"])) {
        $idAbsence = $_POST["idAbsence"];
        $sql = 'DELETE FROM absence WHERE idAbsence = ?';
        $pdo_statement = $conn->prepare($sql);
        $pdo_statement->bindParam(1, $idAbsence);
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