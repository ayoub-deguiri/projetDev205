<?php
include('db.php');
session_start();
if (empty($_SESSION)) {
    header('location:./login.php');
}
?>
<!--html-->
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" media="screen" href="./../styles/Accueil_directrice.css">
</head>
<body>
<!--header-->
    <header>
            <div class="logoOfppt">
                <img src="./../images/Ofpptlogo.png"  alt="logoOfppt" id="logoOfppt">
            </div>
            <div class="logoApp">
                <img src="./../images/logoApp.png"  alt="logo" id="logoApp">
            </div>
            <div class="déconnexion">
			<button type="button" id="Déconnexion"><a href="./logout.php">Déconnexion</a></button>
          </div> 
    </header>
<!--body-->
	<div class="title">
  
  <h1 id="bienvenue">Bienvenue !</h1>

</div>
<div class="container">
  
<form action="./DirectriceAffich.php" method="POST" name="form1">
  <div class="row">
	  <div class="col-25">
		  <label for="année-scolaire">Année Scolaire :</label>
				<?php
             $sql = ("SELECT * FROM annee ");
$pdo_statement = $conn->prepare($sql);
$pdo_statement->execute();
$annee = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
?>
	  </div>
	<div class="col-75">
		  <select id="année-scolaire" id="année-scolaire" name="annee-Scolaire" required>
		  <option value="" selected>Select Annee scolaire</option>
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
	</div>
  </div>
  <div class="row">
		  <div class="col-25">
				<label for="année">Année :</label>
		  </div>
		  <div class="col-75">
				<select id="année" name="annee" required>
						<?php
$sql = ("SELECT * FROM anneeScolaire ");
$pdo_statement = $conn->prepare($sql);
$pdo_statement->execute();
$anneescolaire = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
?>
					<option value="">select year</option>
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
		  </div>
  </div>
  <div class="row">
		  <div class="col-25">
				<label for="filiére">Filiére  :</label>
				<?php
                    $sql = ("SELECT * FROM filiere ");
$pdo_statement = $conn->prepare($sql);
$pdo_statement->execute();
$filieres = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
?>
		  </div>
		  <div class="col-75">
				<select id="filiére" name="filiere" required>
				<option value="">Select filiere </option>
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
		  </div>
  </div>
  <div class="row">
	  <div class="col-25">
			<label for="groupe">Groupe :</label>
			<?php
                    $sql = ("SELECT * FROM groupe ");
$pdo_statement = $conn->prepare($sql);
$pdo_statement->execute();
$groupe = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
?>
	  </div>
	  <div class="col-75">
			<select id="groupe" name="groupe" required>
			<option value="">select Groupe</option>
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
	  </div>
</div>

  <div class="box-submit">
			<input type="submit" name="valider" value="Valider" id="valider">
  </div>  
</form>
</div>
<!--footer-->
  <footer>
	<p> © Copyright | DevWFS205 |2022 </p>
 </footer>
</body>
</html>
