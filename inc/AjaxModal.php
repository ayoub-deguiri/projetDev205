<?php
include_once("db.php");
$userid = $_GET['userid'];
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
$sql = "SELECT dateAbsence,heureDebutAbsence,heureFinAbsence,moduleAbsence,matricule FROM `absence` WHERE type = 'absence' and CEF = ?";
$pdo_statement = $conn->prepare($sql);
$pdo_statement->bindParam(1, $userid);
$pdo_statement->execute();
$absence = $pdo_statement->fetchALL(PDO::FETCH_ASSOC);

// les Retared
$sql = "SELECT dateAbsence,heureDebutAbsence,heureFinAbsence,moduleAbsence,matricule FROM `absence` WHERE type = 'retard' and CEF = ?";
$pdo_statement = $conn->prepare($sql);
$pdo_statement->bindParam(1, $userid);
$pdo_statement->execute();
$retard = $pdo_statement->fetchALL(PDO::FETCH_ASSOC);


?>
<table class='userInfo'>
    <tr>
        <th>nom : </th>
        <td>
            <?php echo $nom; ?>
        </td>
    </tr>
    <tr>
        <th>Prénom</th>
        <td>
            <?php echo $prenom; ?>
        </td>
    </tr>
    <tr>
        <th>Nomber d'absence :</th>
        <td>
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
                    La Date d'absence : <?= $ab['dateAbsence'] ?> &nbsp; &nbsp; <br>
                        Du : <?= $ab['heureDebutAbsence'] ?> &nbsp; &nbsp;
                            A : <?= $ab['heureFinAbsence'] ?> &nbsp; &nbsp; <br>
                                Module absente: <?= $ab['moduleAbsence'] ?> &nbsp; &nbsp; <br>
                                    formateur: <?= $ab['matricule'] ?>
                </li>
                <?php
                }
                ?>
            </ol>
            <?php
            }
            ?>
        </td>
    </tr>
    <tr>
        <th>Nomber de Retards : </td>
        <td>
            <p>
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
                                    formateur: <?= $ret['matricule'] ?>
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