<?php
include_once('inc/db.php');
session_start();
if (empty($_SESSION) or $_SESSION['compteType'] !== "serveillant") {
    header('location:./login.php');
}
?>
<?php
$sql = "SELECT * from formateur ";
$pdo_statement = $conn->prepare($sql);
$pdo_statement->execute();
$formateur = $pdo_statement->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" media="screen" href="./styles/importerFormateur.css">
    <link rel="stylesheet" href="./styles/importerFormateur.css">
    <link rel="stylesheet" href="./styles/snackbar.css">
    <link rel="shortcut icon" href="./images/logoApp.png" type="image/x-icon">
    <title>Formateur</title>
    <script src="./scripts/jquery-3.6.1.min.js"></script>
    <script>
        $(document).ready(function () {
            const countrow = parseInt($('#trcount').val())
            // ajax for Delete Formateur
            for (i = 1; i <= countrow; i++) {
                $("#tr-" + i + " button").on("click", function () {
                    const matricule = $(this).val()
                    if (matricule) {
                        $.post({
                            url: './inc/DeleteFormateur.php ',
                            data: { matricule: matricule },
                            success: function (data) {
                                $("#success-delete").html(data)
                            }
                        });
                    }
                })
            }
        })
    </script>
</head>

<body>
    <header>
        <div class="logoOfppt">
            <img src="./images/Ofpptlogo.png" alt="logoOfppt" id="logoOfppt">
        </div>
        <div class="logoApp">
            <img src="./images/logoApp.png" alt="logo" class="logoApp">
        </div>
        <div class="déconnexion">
            <button type="button" id="Déconnexion"><a href="./logout.php">Déconnexion</a></button>
        </div>
    </header>
    <nav>
        <ul>
        <li>
            <a href="./creation.php"><button >Création</button></a>
        </li>
        <li>
            <a href="./ImporterModules.php"><button class="module">Module</button></a> 
        </li>
        <li>
            <a href="./Main-Formateur.php"><button class="Formateur">Formateur</button></a>
        </li>
        <li>  
            <a href="#"><button>Stagiaire</button> </a>
        </li>
        </ul>
    </nav>
    <main>
        <div class="selects">
            <ul>
                <li> <label for="">importer formateur</label></li>
                <li>
                    <div class="telecharger">
                        <a href="/examples/Formateur.csv" download='Formateur.csv'><img src="./images/upload-cloud.svg"
                                alt="" srcset="" id="icon-upload">
                            <input type="button" value="telecherger" id="telecherger"></a>
                    </div>
                <li>
                    <div class="validerImporter">
                        <input type="submit" value="valider" id="valider" onclick=" return vk()"> <input type="file"
                            name="" id="file">
                        <label for="file" id='buttonPhoto'>importer</label>
                    </div>
                </li>
                <li><span id="lbimport"></span></li>
            </ul>
        </div>
        <div class="listeFormateur">
            <?php
            if (empty($formateur)) {
                echo "<div class='first-msg'>" . "<span>&#8592;</span>" . " Veuillez sélectionner un groupe " . "</div>";
            } else {

            ?>
            <table>
                <tr>
                    <th>matricule</th>
                    <th>nom</th>
                    <th>prénom</th>
                    <th>supprimer</th>
                </tr>
                <?php
                $c = 1;
                foreach ($formateur as $row) {
                ?>
                <tr id="tr-<?= $c++ ?>">
                    <td>
                        <?= $row["Matricule"] ?>
                    </td>
                    <td>
                        <?= $row["nomFormateur"] ?>
                    </td>
                    <td>
                        <?= $row["prenomFormateur"] ?>
                    </td>
                    <td>
                        <button class="btn-click" value=<?= $row['Matricule'] ?>>
                            <img src="./images/trash-2.svg" id='trash' alt="">
                        </button>
                    </td>
                </tr>
                <?php
                }
            }
                ?>
                <input type="hidden" id="trcount" value="<?= $c ?>" />
            </table>
        </div>
    </main>
    <div class="ajoute">
        <a href="./AjouterFormateur.php"><img src="./images/plus-circle.svg" alt="">
            <p>Ajouter</p>
        </a>
    </div>
    <input type="hidden" id="success-delete"></input>
    <div id="snackbar">l'opération terminée avec succes..</div>
    <footer>
        <p>© Copyright | DevWFS205 |2022</p>
    </footer>
    <script>
        var file = document.getElementById('file')
        var lbimport = document.getElementById('lbimport')
        function vk() {
            var etat;
            if (file.value == '') {
                etat = false
                lbimport.innerHTML = "Veuillez vérifier votre fichier d'importation "
            }
            else {
                etat = true
            }
            return etat
        }
    </script>
</body>

</html>
