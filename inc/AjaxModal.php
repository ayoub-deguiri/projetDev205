<?php
include_once("db.php");
session_start();
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
$sql = "SELECT dateAbsence,heureDebutAbsence,heureFinAbsence,moduleAbsence,matricule,justifier FROM `absence` WHERE type = 'absence' and CEF = ?";
$pdo_statement = $conn->prepare($sql);
$pdo_statement->bindParam(1, $userid);
$pdo_statement->execute();
$absence = $pdo_statement->fetchALL(PDO::FETCH_ASSOC);


// les Retared
$sql = "SELECT dateAbsence,heureDebutAbsence,heureFinAbsence,moduleAbsence,matricule,justifier FROM `absence` WHERE type = 'retard' and CEF = ?";
$pdo_statement = $conn->prepare($sql);
$pdo_statement->bindParam(1, $userid);
$pdo_statement->execute();
$retard = $pdo_statement->fetchALL(PDO::FETCH_ASSOC);


?>

<div class="fullname">
    <?php echo $nom; ?>
    <?php echo $prenom; ?>
</div>
<div class="separators"></div>
<!-- Les Absence -->
<div class="main">
    <div class="title">Les Absence : </div>
    <?php
    if (!empty($absence)) {
    ?>
    <div class="list">
        <ol>
            <?php
        foreach ($absence as $ab) {
            ?>
            <li>
                <span>La Date d'absence</span> : <?= $ab['dateAbsence'] ?><br>
                    <span>Du</span> : <?= $ab['heureDebutAbsence'] ?>
                        <span> A </span>: <?= $ab['heureFinAbsence'] ?><br>
                            <span> Module absente </span>: <?= $ab['moduleAbsence'] ?><br>
                                <span> formateur </span>:
                                <?php
            //fetch formateur
            $sql = "SELECT concat(nomFormateur,'  ',prenomFormateur) as fullName from formateur where Matricule=?";
            $pdo_statement = $conn->prepare($sql);
            $pdo_statement->bindParam(1, $ab["matricule"]);
            $pdo_statement->execute();
            $Formateur = $pdo_statement->fetch();
            echo $Formateur[0] ?><br>
                                <span>etat </span>:
                                <?php
            if ($ab['justifier'] == "oui") {
                echo "justifier";
            } else if ($ab['justifier'] == 'no') {
                echo " non justifier";
            }
                                ?>
            </li>

            <?php
        }
            ?>
        </ol>
        <?php
    } else {
        echo "<span class='empty-msg'>Aucune absence</span>";
    }
        ?>
    </div>
</div>
<!-- separators -->
<div class="separators"></div>
<!-- Les Retared  -->
<div class="main">
    <div class="title">Les Retared :</div>
    <?php
    if (!empty($retard)) {
    ?>
    <div class="list">

        <ol>
            <?php
        foreach ($retard as $rt) {
            ?>
            <li>
                <span>La Date du reatred</span> : <?= $rt['dateAbsence'] ?><br>
                    <span> Du</span> : <?= $rt['heureDebutAbsence'] ?>
                        <span> A </span>: <?= $rt['heureFinAbsence'] ?><br>
                            <span> Module retarder</span>: <?= $rt['moduleAbsence'] ?><br>
                                <span>formateur</span>:
                                <?php
            //fetch formateur
            $sql = "SELECT concat(nomFormateur,'  ',prenomFormateur) as fullName from formateur where Matricule=?";
            $pdo_statement = $conn->prepare($sql);
            $pdo_statement->bindParam(1, $rt["matricule"]);
            $pdo_statement->execute();
            $Formateur = $pdo_statement->fetch();
            echo $Formateur[0] ?><br>
                                <span>etat </span>:
                                <?php
            if ($ab['justifier'] == "oui") {
                echo "justifier";
            } else if ($ab['justifier'] == 'no') {
                echo " non justifier";
            }
                                ?>
            </li>
            <?php
        }
            ?>
        </ol>
        <?php
    } else {
        echo "<span class='empty-msg'>Aucune reatred</span>";
    }
        ?>
    </div>
</div>
<!-- separators -->
<div class="separators"></div>
<!-- Justifier button -->
<?php
if (!empty($absence) || !empty($retard)) {

    echo '<div class="btn-div"><a href="./Affichage-surveillant.php?annee-Scolaire=' . $_SESSION["anneeScolaire"] . '&annee=' . $_SESSION["annee"] . '&filiere=' . $_SESSION["filiere"] . '&groupe=' . $_SESSION["groupe"] . '&AjaxValider=valider"><button class="justifier-btn">Justifier</button></a></div>';
}
?>