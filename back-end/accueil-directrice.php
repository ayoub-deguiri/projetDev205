<?php
include('db.php');
session_start();
if (empty($_SESSION)) {
    header('location:./login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="./styles/STYLEDIRECTRICE.css" />
	<title>Directrice</title>
	<style>
		h1 {
			font-size: 40px;
			font-weight: 600;
			color: lightseagreen;
			font-family: cursive;
		}
		/* label{
			color: lightseagreen;
			font-family: cursive;
		} */
	</style>
</head>

<body>
	<!--header-->
	<div class="container">
		<div class="header">
			<div class="logoOfppt">
				<img src="images/Ofpptlogo.png" alt="logoOfppt" id="logoOfppt">
			</div>
			<div class="logoApp">
				<img src="images/logo.jpeg" alt="logo" id="logoApp">
			</div>
			<a href="./logout.php"><div class="buttonDeconexion"><button>Déconnexion</button></div></a>

		</div>
	</div>
	<!--flitre-->

	<h1 id="bienvenue">Bienvenue!</h1>

	<form action="./DirectriceAffich.php" method="Post" name="form1">
		<table>
			<tr>
				<th>
					<label for="lblannee-scolaire" style="margin-left: -39px">
						Année Scolaire:</label>
					<?php
                    $sql = ("SELECT * FROM annee ");
$pdo_statement = $conn->prepare($sql);
$pdo_statement->execute();
$annee = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
?>

					<select id="annee-Scolaire" name="annee-Scolaire" style="margin-left: 24px" required>
						<option value="rien" selected>Select Annee scolaire</option>
						<?php
    if (isset($annee)) {
        foreach ($annee as $row) {
            ?>
								<option value="<?= $row['nomAnnee'] ?>"><?= $row['nomAnnee'] ?></option>

						<?php
        }
    }
?>

					</select>
					<!-- <input type="hidden" name="" id="inputHidden"> -->
				</th>



				<th colspan="2">
					<label for="lblannee"> Année:</label>
					<select id="annee" name="annee" required>
						<?php
$sql = ("SELECT * FROM anneeScolaire ");
$pdo_statement = $conn->prepare($sql);
$pdo_statement->execute();
$anneescolaire = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
?>
						<option value="rien">select year</option>
						<?php
if (isset($anneescolaire)) {
    foreach ($anneescolaire as $row) {
        ?>
								<option value="<?= $row['nomAnneeScolaire'] ?>"><?= $row['nomAnneeScolaire'] ?></option>

						<?php
    }
}
?>
					</select>
				</th>


				<th colspan="2">
					<label for="lblfiliére"> Filiére:</label>
					<?php
                    $sql = ("SELECT * FROM filiere ");
$pdo_statement = $conn->prepare($sql);
$pdo_statement->execute();
$filieres = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
?>
					<select id="filiere" name="filiere" required>
						<option value="rien">Select filiere </option>
						<?php
    if (isset($filieres)) {
        foreach ($filieres as $row) {
            ?>
								<option value="<?= $row['nomFiliere'] ?>"><?= $row['nomFiliere'] ?></option>

						<?php
        }
    }
?>
					</select>
				</th>


				<th colspan="2">
					<label for="lblgroupe" style="margin-left: -39px"> Groupe:</label>
					<?php
                    $sql = ("SELECT * FROM groupe ");
$pdo_statement = $conn->prepare($sql);
$pdo_statement->execute();
$groupe = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
?>
					<select id="groupe" name="groupe" required>
						<option value="rien">select Groupe</option>
						<?php
    if (isset($groupe)) {
        foreach ($groupe as $row) {
            ?>
								<option value="<?= $row['nomGroupe'] ?>"><?= $row['nomGroupe'] ?></option>

						<?php
        }
    }
?>
					</select>
				</th>

				<th colspan="2">
					<input type="submit" id="valider" name="valider" value="Valider" />
				</th>
			</tr>

		</table>
		<form>


			<!--footer-->
			<footer>
				<h3>© Copyright | DevWFS205 |2022</h3>
			</footer>

</body>

</html>
