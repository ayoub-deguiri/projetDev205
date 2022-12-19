<?php
include_once('inc/db.php');
session_start();
if (empty($_SESSION) or $_SESSION['compteType'] !== "superAdmin") {
    header('location:./login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" media="screen" href="./styles/modifier.css">
    <link rel="stylesheet" href="./styles/Importer_stagiaire.css">
    <link rel="shortcut icon" href="./images/logoApp.png" type="image/x-icon">
    <title>Stagiaire</title>
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
                <a href="./creation.php"><button>Création</button></a>
            </li>
            <li>
                <a href="./ImporterModule.php"><button>Module</button></a>
            </li>
            <li>
                <a href="./ImporterFormateur.php"><button>Formateur</button></a>
            </li>
            <li>
                <a href="#"><button class="stagiare">Stagiaire</button> </a>
            </li>
        </ul>
    </nav>
    <form action="" method="post">
    </form>
    <main>
        <form method="POST" action="./libs/Main.php" enctype="multipart/form-data">
            <div class="container">
                <table>
                    <tr>
                        <td>Année scolaire:</td>
                        <td>
                            <select name="annee-Scolaire" id="année-scolaire" required>
                                <option value="">annee-Scolaire</option>
                                <option value="1">test</option>
                            </select>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="selects">
                <ul>
                    <li>
                        <div class="telecharger"> <img src="./images/upload-cloud.svg" alt="" srcset=""
                                id="icon-upload">
                            <a href="./CSV_Files_Examples/Stagiaire.xlsx" download="Stagiaire.xlsx"><input type="button"
                                    value="Télécharger" id="telecherger"></a>
                        </div>
                    </li>

                    <li>
                        <div class="validerImporter">
                            <input type="hidden" name="table" value="Stagiaire">
                            <input type="submit" name="Submit" value="Valider" id="valider" onclick=" return vk()">
                            <input type="file" name="file" id="file">
                            <label for="file" id='buttonPhoto'>Importer</label>
                        </div><span id="lbimport"></span>

                    </li>

                </ul>
        </form>
        </div>
    </main>
    <footer>
        <p>© Copyright | DevWFS205 |2022</p>
    </footer>
    <script src="./scripts/ImporterStagiaire.js"></script>
</body>

</html>