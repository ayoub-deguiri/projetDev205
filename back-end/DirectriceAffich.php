<?php
include('db.php');
session_start();
?>
<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if (isset($_POST['valider'])) {
		$_SESSION['anneeScolaire'] = $_POST['annee-Scolaire'];
		$_SESSION['annee'] = $_POST['annee'];
		$_SESSION['filiere'] = $_POST['filiere'];
		$_SESSION['groupe'] = $_POST['groupe'];
	}
}

echo($_SESSION['anneeScolaire']);
echo($_SESSION['annee']) ;
echo($_SESSION['filiere'] );
echo($_SESSION['groupe']) ;




?>
<?php
$anneesolaire2=$_SESSION['anneeScolaire'];
$annee2=$_SESSION['annee'];
$filiere2=$_SESSION['filiere'];
$groupe2=$_SESSION['groupe'];
$sql="SELECT s.CEF , s.nomStagiaire,s.prenomStagiaire ,COUNT(a.idAbsence) as NombreAbsence ,
n.note from stagiaire s ,note n , absence a ,annee an , anneescolaire ans ,filiere f ,groupe g where s.CEF=n.CEF and
s.CEF=a.CEF and ans.idAnneeScolaire=a.anneeScolaire_idAnneeScolaire and g.filiere_idFiliere=f.idFiliere and
an.idAnnee=a.annee_idAnnee and g.idGroupe=a.groupe_idGroupe and a.type='retard' and 
ans.idAnneeScolaire =?  and an.idAnnee =? and f.idFiliere = ? and g.idGroupe=? 
group by s.CEF";
$pdo_statement = $conn->prepare($sql);
$pdo_statement->bindParam(1,$anneescolaire2);
$pdo_statement->bindParam(2,$annee2);
$pdo_statement->bindParam(3,$filiere2);
$pdo_statement->bindParam(4,$groupe2);
$pdo_statement->execute();
$result1 =$pdo_statement->fetchAll(PDO::FETCH_ASSOC);	
var_dump($result1);

?>
<?php
$anneescolaire='1';
$annee='1';
$filiere='1';
$groupe='1';
$sql="SELECT s.CEF , s.nomStagiaire,s.prenomStagiaire ,COUNT(a.idAbsence) as NombreAbsence ,
n.note from stagiaire s ,note n , absence a ,annee an , anneescolaire ans ,filiere f ,groupe g where s.CEF=n.CEF and
s.CEF=a.CEF and ans.idAnneeScolaire=a.anneeScolaire_idAnneeScolaire and g.filiere_idFiliere=f.idFiliere and
an.idAnnee=a.annee_idAnnee and g.idGroupe=a.groupe_idGroupe and a.type='absence' and 
ans.idAnneeScolaire =?  and an.idAnnee =? and f.idFiliere = ? and g.idGroupe=? 
group by s.CEF" ;
$pdo_statement = $conn->prepare($sql);
$pdo_statement->bindParam(1,$anneescolaire);
$pdo_statement->bindParam(2,$annee);
$pdo_statement->bindParam(3,$filiere);
$pdo_statement->bindParam(4,$groupe);
$pdo_statement->execute();
$result2 =$pdo_statement->fetchAll(PDO::FETCH_ASSOC);
var_dump($result2);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css.css">
    <title>Document</title>
</head>
<body>
    <!--*********************************************************************************-->          
    <header>
                    <div class="Partie1">
                        <div class="logo-OFPPT">
                                <img src="images/logo-photochop.png" width="100p" height="100px" alt="logoOfppt" id="logoOfppt">
                        </div>
                        <div class="logoApp">
                                <img src="" alt="logo" id="logoApp">
                        </div>
                            
                        <button type="button" id="Déconnexion"><a href="login.html">Déconnexion</a></button>    
                   </div>
            </header>
 <!--*********************************************************************************-->
 <div class="Partie2">
    <table>
        <tr>
            <th>matricule</th>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Nombre Absence</th>
            <th>Nombre Retard</th>
            <th>Note</th>
        </tr>
        <?php
        if(!empty($result2)){
            foreach($result2 as $row){
                echo "<tr>
                <td>".$row['CEF']."</td><td>".$row['nomStagiaire']."</td><td>".$row['prenomStagiaire']."</td><td>".$row['NombreAbsence']."</td>
                <td>";
                foreach($result1 as $row2){
                    echo $row2['NombreRetard']."</td><td>".$row2['note']."</td>
                    </tr>";;
                }
                
            }
        }
        ?>
    </table>
    </div>
<!--*********************************************************************************-->
            <footer >
                <p> © Copyright | DevWFS205 |2022 </p> 
            </footer>
        </div>
</div>
</body>
</html>

