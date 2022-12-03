<?php
include_once('inc/db.php');
session_start();
if (empty($_SESSION) or $_SESSION['compteType'] !== "serveillant") {
    header('location:./login.php');
}
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["AjaxValider"])) {

    $_SESSION["anneeScolaire"] = $_GET["annee-Scolaire"];
    $_SESSION["annee"] = $_GET["annee"];
    $_SESSION["filiere"] = $_GET["filiere"];
    $_SESSION["groupe"] = $_GET["groupe"];

    // get all Stagiaire 
    $sql = "SELECT CEF ,nomStagiaire,prenomStagiaire from stagiaire where idGroupe = ?";
    $pdo_statement = $conn->prepare($sql);
    $pdo_statement->bindParam(1, $_SESSION["groupe"]);
    $pdo_statement->execute();
    $Stagiaires = $pdo_statement->fetchAll();
    // get group name
    $sql = "SELECT nomGroupe from groupe where idGroupe = ?";
    $pdo_statement = $conn->prepare($sql);
    $pdo_statement->bindParam(1, $_SESSION["groupe"]);
    $pdo_statement->execute();
    $group = $pdo_statement->fetch();
    $_SESSION["nomGroupe"] = $group['nomGroupe'];
    // get Respo
    $respo = "";
    $sql = "SELECT user FROM compte where compteType ='stagiaire'";
    $pdo_statement = $conn->prepare($sql);
    $pdo_statement->execute();
    $users = $pdo_statement->fetchAll(PDO::FETCH_COLUMN);
}
?>
<!--html-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/Modifier-Stagiaire.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="./images/logoApp.png" type="image/x-icon">
    <title>Modifier-Stagiaire</title>
    <script src="./scripts/jquery-3.6.1.min.js"></script>
    <script>
        $(document).ready(function () {
            // Ajax for Modal
            $('.details').click(function (event) {
                let userid = $(this).data('id');
                $.get({
                    url: './inc/AjaxModal.php',
                    type: 'GET',
                    data: { userid: userid },
                    success: function (response) {
                        $('.modal-body').html(response);
                    }
                })
                $('#myModal').show();
            });
            $('.close').click(function () {
                $('#myModal').hide();
            })
            // Ajax for select
            $('#année-scolaire').on('change', function () {
                var annescolID = $(this).val();
                if (annescolID) {
                    $.get(
                        './inc/AjaxSelect.php',
                        { annescolID: annescolID },
                        function (data) {
                            $('#année').html(data);
                        }
                    );
                }
            })
            $('#année').on('change', function () {
                var anneeID = $(this).val();
                if (anneeID) {
                    $.get(
                        './inc/AjaxSelect.php',
                        { anneeID: anneeID },
                        function (data) {
                            $('#filiére').html(data);
                        }
                    );
                }
            })
            $('#filiére').on('change', function () {
                var filiereID = $(this).val();
                if (filiereID) {
                    $.get(
                        './inc/AjaxSelect.php',
                        { filiereID: filiereID },
                        function (data) {
                            $('#groupe').html(data);
                        }
                    );
                }
            })
            $("#valider").click(function (ev) {
                if ($('#groupe').val() === null) {
                    ev.preventDefault()
                    alert("Choisissez s'il vous plaît  un groupe")
                }
            })
            //  update responsable
            $(".respo").on('change', function () {
                // add new one
                if ($(this).is(':checked')) {
                    const CEF = $(this).val()
                    if (CEF) {
                        $.get({
                            url: './inc/AddRespo.php',
                            data: { CEF: CEF },
                            success: function (data) {
                                $("#result").html(data)
                            }
                        });
                    }
                    // remove exists one
                } else {
                    const CEF = $(this).val()
                    if (CEF) {
                        $.get({
                            url: './inc/RemoveRespo.php',
                            data: { CEF: CEF },
                            success: function (data) {
                                $("#result").html(data)
                            }
                        });
                    }
                }
            })

            // ajax for Delete Stagiaire
            $(".switcher").on('change', function () {
                if ($(this).is(':checked')) {
                    const CEF = $(this).val()
                    if (CEF) {
                        $.get({
                            url: './inc/DeleteStagiaire.php',
                            data: { CEF: CEF },
                            success: function (data) {
                                $("#success-delete").html(data)
                            }
                        });
                    }
                }
            })
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
        <div class="navbar-pop" onclick="modalfn()">
        <div></div>
        <div></div>
        <div></div>
    </div>
    </header>
    <nav>
    <ul>
      <li>
        <a href="./Accueil-serveillant.php"><button><i class="fa fa-home" aria-hidden="true"></i>ACCUEIL</button></a>
      </li>
      <li>
        <a href="./Modifier-Stagiaire.php" ><button class="MODIFIER"><i class="fa fa-pencil-square"
              aria-hidden="true"></i>MODIFIER</button></a>
      </li>
      <li>
        <a href=""><button><i class="fa fa-calendar-times-o" aria-hidden="true"></i>ABSENCE</button></a>
        <ul>
          <li><a href="./Affichage-surveillant.php"><button>Affichage</button></a></li>
          <li><a href="./SasireAbsence-surveillant.php"><button>Saisir</button></a></li>
        </ul>
      </li>
      <li>
        <a href="./note.php"><button><i class="fa fa-calendar" aria-hidden="true"></i>NOTES</button> </a>
      </li>
      <li>
        <a href="./Deperdition.php"><button><i class="fa fa-plus-circle" aria-hidden="true"></i>deperdition</button></a>
      </li>
      <li>
        <a href="./Absence_Justifier.php"><button><i  aria-hidden="true"></i>Justifier</button></a>
      </li>
    </ul>
  </nav>
    <!-- Ajax select -->
    <form action="" method="GET">
        <main>
            <div class="selects">
                <ul>
                    <li> <label for="année-scolaire">année scolaire</label></li>
                    <?php
                    $sql = ("SELECT * FROM anneeScolaire ");
                    $pdo_statement = $conn->prepare($sql);
                    $pdo_statement->execute();
                    $anneeScolaire = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                    <li><select name="annee-Scolaire" id="année-scolaire">
                            <option value="" disabled selected>Année Scolaire</option>
                            <?php
                            if (isset($anneeScolaire)) {
                                foreach ($anneeScolaire as $row) {
                            ?>
                            <option value="<?= $row['idAnneeScolaire'] ?>">
                                <?= $row['nomAnneeScolaire'] ?>
                            </option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </li>
                    <li> <label for="année">année</label></li>
                    <li>
                        <select id="année" name="annee" required></select>
                    </li>
                    <li> <label for="filier" id='filiérelb'>filière</label></li>
                    <li>
                        <select id="filiére" name="filiere" required></select>
                    </li>
                    <li> <label for="">groupe</label></li>
                    <li>
                        <select id="groupe" name="groupe" required></select>
                    </li>
                    <li><input type="submit" name="AjaxValider" value="valider" id="valider"> </li>
                </ul>
            </div>
    </form>
    </div>
    <!-- Main Table -->
    <div class="listeEtudiants">
        <form id='table-form'>
            <?php
            if (empty($Stagiaires)) {
                echo "<div class='first-msg'>" . "<span>&#8592;</span>" . " Veuillez sélectionner un groupe " . "</div>";
            } else {
            ?>
            <table>
                <caption>Group :
                    <?= $group['nomGroupe'] ?>
                </caption>
                <tr>
                    <th>cEF</th>
                    <th>nom</th>
                    <th>prénom</th>
                    <th>détails</th>
                    <th>responsable</th>
                    <th>supprimer</th>
                </tr>
                <?php
                $c = 1;
                foreach ($Stagiaires as $row) {
                ?>
                <tr id="tr-<?= $c++ ?>">
                    <td>
                        <?= $row["CEF"] ?>
                    </td>
                    <td>
                        <?= $row['nomStagiaire'] ?>

                    </td>
                    <td>
                        <?= $row['prenomStagiaire'] ?>
                    </td>
                    <td>
                        <input type="button" value="Info" data-id='<?php echo $row['CEF']; ?>' class="details" />
                    </td>
                    <td>
                        <?php
                    if (in_array($row['CEF'], $users)) {
                        ?>
                        <label class="switch">
                            <input class="respo" type="checkbox" value="<?= $row['CEF'] ?>" checked />
                            <span class="slider round"></span>
                        </label>
                        </label>
                        <?php
                    } else {
                        ?>
                        <label class="switch">
                            <input class="respo" type="checkbox" value="<?= $row['CEF'] ?>" />
                            <span class="slider round"></span>
                        </label>
                        </label>
                        <?php
                    }
                        ?>
                    </td>
                    <td>
                        <label class="switch">
                            <input class="switcher" type="checkbox" value="<?= $row['CEF'] ?>" />
                            <span class="slider round"></span>
                        </label>
                        </label>
                    </td>
                </tr>
                <?php
                }
                ?>
                <input type="hidden" id="trcount" value="<?= $c ?>" />
            </table>
            <div class="ajoute-valider">
                <div class="ajoute">
                    <a href="./ajouter.php?idgrp=<?= $_SESSION["groupe"] ?>"><img
                            src="./images/plus-circle.svg" alt="">
                        <p>Ajouter</p>
                    </a>
                </div>

            </div>
            <?php
            }

            ?>
            <!-- Main Table -->
            </main>
    </div>
    <div id="mynav" class="navpop">
        <div class="modalnav-content">
            <span class="closenav">&times;</span>
            
                <div class="body-nav">
                    <ol>
                        <li>
                            <a href=""><button ><i class="fa fa-home" aria-hidden="true"></i> Accueil</button></a>
                        </li>
                        <li>
                            <a href="#"><button><i class="fa fa-pencil-square" aria-hidden="true"></i> Modifier</button></a> 
                        </li>
                        <li>
                        <button onclick="showUl()"><i class="fa fa-calendar-times-o" aria-hidden="true"></i>  Absence</button>
                            <ol id="olshow">
                                <li><a href=""><button>Affichage</button></a></li>
                                <li><a href=""><button>Saisir</button></a></li>
                            </ol>
                        </li>
                        <li>  
                            <a href=""><button><i class="fa fa-calendar" aria-hidden="true"></i> Notes</button> </a>
                        </li>
                        <li>  
                            <a href="#"><button ><i class="fa fa-plus-circle" aria-hidden="true"></i>Ajouter</button></a>
                        </li>
                    </ol>
                    <div class="btnlougout">
                        <button type="button" id="btnlougout">
                        <a href="./logout.php"><img src="./images/log-out.svg" alt=""></a>
                        </button>
                    </div>
                </div>
                
                
         </div>
    
    </div>
    <div id="myModal" class="modal" role="dialog">

        <!-- Modal content -->
        <div class="modal-content">
            <div><span class="close">&times;</span></div>
            <div class="modal-header">
                <h4 class="modal-title">l'historique du stagiaire :</h4>
            </div>
            <div class="modal-body">
            </div>
        </div>
    </div>
    </form>
    </div>
    <input type="hidden" id="result"></input>
    <input type="hidden" id="success-delete"></input>
    <footer>
        <p>© Copyright | DevWFS205 |2022</p>
    </footer>
<script>
     /* nav bar  box */
                // Get the nav bar pop
                var nav = document.getElementById("mynav");

                // Get the button that opens the modal
                

                // Get the <span> element that closes the modal
                var span = document.getElementsByClassName("closenav")[0];

                // When the user clicks on the button, open the modal
                function modalfn() {
                  nav.style.display = "block";
                }

                // When the user clicks on <span> (x), close the modal
                span.onclick = function() {
                  nav.style.display = "none";
                var ol = document.getElementById('olshow')
                  ol.style.display='none'
                  
                }

                // When the user clicks anywhere outside of the modal, close it
                window.onclick = function(event) {
                if (event.target == nav) {
                  nav.style.display = "none";
                }
                }

                function showUl()
                {
                  var ol = document.getElementById('olshow')
                  ol.style.display='block'
                  ol.style.marginLeft ='40px';
                  

                  
                }
</script>
</body>

</html>
