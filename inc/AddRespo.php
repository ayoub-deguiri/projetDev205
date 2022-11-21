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
    location.reload();
</script>;
<?php
} else {
    header('location:./Accueil-serveillant.php');
}