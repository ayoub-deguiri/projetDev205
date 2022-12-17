<?php
include_once('db.php');
session_start();
// if (empty($_SESSION) or $_SESSION['compteType'] == "stagiaire") {
//     header('location:./login.php');
// }
?>
<?php
if (isset($_GET['annescolID']) && !empty($_GET['annescolID'])) {
    $annescolID = $_GET['annescolID'];
    $sql = ("SELECT * FROM annee where idAnneeScolaire = ?");
    $pdo_statement = $conn->prepare($sql);
    $pdo_statement->bindParam(1, $annescolID);
    $pdo_statement->execute();
    $result1 = $pdo_statement->fetchAll();
    echo '<option disabled  selected >Année</option>';
    foreach ($result1 as $row) {
?>
<option value="<?= $row['idAnnee'] ?>">
    <?= $row['nomAnnee'] ?>
</option>
<?php
    }
}
if (isset($_GET['anneeID']) && !empty($_GET['anneeID'])) {
    $anneeID = $_GET['anneeID'];
    $sql = ("SELECT * FROM filiere where idAnnee = ?");
    $pdo_statement = $conn->prepare($sql);
    $pdo_statement->bindParam(1, $anneeID);
    $pdo_statement->execute();
    $result2 = $pdo_statement->fetchAll();
    echo '<option disabled  selected >Filiére</option>';
    foreach ($result2 as $row) {
?>
<option value="<?= $row['idFiliere'] ?>">
    <?= $row['nomFiliere'] ?>
</option>
<?php
    }
}
if (isset($_GET['filiereID']) && !empty($_GET['filiereID'])) {
    $filiereID = $_GET['filiereID'];
    $sql = ("SELECT * FROM groupe where idFiliere = ?");
    $pdo_statement = $conn->prepare($sql);
    $pdo_statement->bindParam(1, $filiereID);
    $pdo_statement->execute();
    $result3 = $pdo_statement->fetchAll();
    echo '<option disabled  selected >Group</option>';
    foreach ($result3 as $row) {
?>
<option value="<?= $row['idGroupe'] ?>">
    <?= $row['nomGroupe'] ?>
</option>
<?php
    }
}
?>