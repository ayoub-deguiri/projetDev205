<?php
include "db.php";
$userid = $_POST['userid'];
$sql = "SELECT * FROM stagiaire WHERE CEF= ?";
$pdo_statement = $conn->prepare($sql);
$pdo_statement->bindParam(1, $userid);
$pdo_statement->execute();
$stagaire = $pdo_statement->fetch(PDO::FETCH_ASSOC);
$nom = $stagaire['nomStagiaire'];
$prenom = $stagaire['prenomStagiaire'];

// nbr abs
$sql = "SELECT COUNT(idAbsence) as nbrAbs FROM `absence` WHERE type = 'absence' and CEF = ?";
$pdo_statement = $conn->prepare($sql);
$pdo_statement->bindParam(1, $userid);
$pdo_statement->execute();
$nomberabs = $pdo_statement->fetch(PDO::FETCH_ASSOC);
$nbrAbs = $nomberabs["nbrAbs"];
// nbr reatred
$sql = "SELECT COUNT(idAbsence) as nbrRetard FROM `absence` WHERE type = 'retard' and CEF = ?";
$pdo_statement = $conn->prepare($sql);
$pdo_statement->bindParam(1, $userid);
$pdo_statement->execute();
$nomberRetard = $pdo_statement->fetch(PDO::FETCH_ASSOC);
$nbrRetard = $nomberRetard["nbrRetard"];

// les Absence
$sql = "SELECT dateAbsence,heureDebutAbsence,heureFinAbsence,moduleAbsence,formateurAbsence FROM `absence` WHERE type = 'absence' and CEF = ?";
$pdo_statement = $conn->prepare($sql);
$pdo_statement->bindParam(1, $userid);
$pdo_statement->execute();
$absence = $pdo_statement->fetchALL(PDO::FETCH_ASSOC);

// les Retared
$sql = "SELECT dateAbsence,heureDebutAbsence,heureFinAbsence,moduleAbsence,formateurAbsence FROM `absence` WHERE type = 'retard' and CEF = ?";
$pdo_statement = $conn->prepare($sql);
$pdo_statement->bindParam(1, $userid);
$pdo_statement->execute();
$retard = $pdo_statement->fetchALL(PDO::FETCH_ASSOC);


?>
<table border='0' width='100%'>
    <tr>

        <td style="padding:20px;">
            <p>Name :
                <?php echo $nom; ?>
            </p>
            <p>Prénom :
                <?php echo $prenom; ?>
            </p>
            <p>Nomber d'absence :
                <?php echo $nbrAbs; ?>
            </p>
            <?php
            if (!empty($absence)) {
            ?>
            <ol>
                <?php
                foreach ($absence as $ab) {
                ?>
                <li>
                    La Date d'absence : <?= $ab['dateAbsence'] ?> &nbsp; &nbsp;
                        Du : <?= $ab['heureDebutAbsence'] ?> &nbsp; &nbsp;
                            A : <?= $ab['heureFinAbsence'] ?> &nbsp; &nbsp;
                                Module absente: <?= $ab['moduleAbsence'] ?> &nbsp; &nbsp;
                                    formateur: <?= $ab['formateurAbsence'] ?>
                </li>
                <br>
                <?php
                }
                ?>
            </ol>
            <?php
            }
            ?>
            <p>Nomber de Reatred :
                <?php echo $nbrRetard; ?>
            </p>
            <?php
            if (!empty($retard)) {
            ?>
            <ol>
                <?php
                foreach ($retard as $ret) {
                ?>
                <li>
                    La Date d'absence : <?= $ret['dateAbsence'] ?> &nbsp; &nbsp;
                        Du : <?= $ret['heureDebutAbsence'] ?> &nbsp; &nbsp;
                            A : <?= $ret['heureFinAbsence'] ?> &nbsp; &nbsp;
                                Module absente: <?= $ret['moduleAbsence'] ?> &nbsp; &nbsp;
                                    formateur: <?= $ret['formateurAbsence'] ?>
                </li>
                <br>
                <?php
                }
                ?>
            </ol>
            <?php
            }
            ?>
        </td>
    </tr>
</table>