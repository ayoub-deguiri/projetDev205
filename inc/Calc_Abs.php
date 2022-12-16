<?php
include_once('db.php');
function Calc_Note($cef)
{
    global $conn;

    // calc Abs 
    $sql = "select Duree from absence where CEF = ? ";
    $pdo_statement = $conn->prepare($sql);
    $pdo_statement->bindParam(1, $cef);
    $pdo_statement->execute();
    $abs = $pdo_statement->fetchAll(PDO::FETCH_OBJ);
    $sum = 0;
    foreach ($abs as $ab => $value) {
        $sum += $value->Duree;
    }
    $Nombre_Absence = floor(($sum / 60) / 4);


    // calc Ret
    $sql = "select Count(*) as total from absence where CEF = ? and type = 'retard';";
    $pdo_statement = $conn->prepare($sql);
    $pdo_statement->bindParam(1, $cef);
    $pdo_statement->execute();
    $ret = $pdo_statement->fetch();
    $Nombre_Retard = floor($ret[0] / 4);

    // Poins à deduire	
    $points = ($Nombre_Absence + $Nombre_Retard);
    // Sanctions
    switch ($points) {
        case '0':
            $msg = "accune Sanctions";
            break;
        case '1':
            $msg = "1ére Mise en gargde";
            break;
        case '2':
            $msg = "2ére Mise en gargde";
            break;
        case '3':
            $msg = "1re avertissement";
            break;
        case '4':
            $msg = "2re avertissement";
            break;
        case '5':
            $msg = "Blâme";
            break;
        case '6':
            $msg = "Exclusion de 2 jours";
            break;
        case '7':
            $msg = "Exclusion temporaire ou définitive a l'appreciation du Conseil de Discipline";
            break;
        case '8':
            $msg = "Exclusion temporaire ou définitive a l'appreciation du Conseil de Discipline";
            break;
        case '9':
            $msg = "Exclusion temporaire ou définitive a l'appreciation du Conseil de Discipline";
            break;
        case '10':
            $msg = "Exclusion temporaire ou définitive a l'appreciation du Conseil de Discipline";
            break;
        default:
            $msg = "Exclusion Definitive";
            break;
    }
    // Note/15	
    $note15 = 15 - $points;

    // note general 
    $sql = "SELECT * FROM `note` where CEF = ?";
    $pdo_statement = $conn->prepare($sql);
    $pdo_statement->bindParam(1, $cef);
    $pdo_statement->execute();
    $res = $pdo_statement->fetch();
    if (empty($res)) {
        $sql = "INSERT INTO `note` VALUES (?,?)";
        $pdo_statement = $conn->prepare($sql);
        $pdo_statement->bindParam(1, $cef);
        $pdo_statement->bindParam(2, $note15);
        $pdo_statement->execute();
    }


    $data["Nombre_Absence"] = $Nombre_Absence;
    $data["Nombre_Retard"] = $Nombre_Retard;
    $data["points"] = $points;
    $data["msg"] = $msg;
    $data["note15"] = $note15;

    return $data;
}
?>