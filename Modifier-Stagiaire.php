<?php
include('inc/db.php');
session_start();
if (empty($_SESSION) or $_SESSION['compteType'] !== "serveillant") {
    header('location:./login.php');
}
?>
<!--html-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" media="screen" href="./styles/modifier.css">
    <link rel="shortcut icon" href="./images/logoApp.png" type="image/x-icon">
    <title>modifier</title>
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
                <a href="#"><button><i class="fa fa-home" aria-hidden="true"></i>ACCUEIL</button></a>
            </li>
            <li>
                <a href="#"><button><i class="fa fa-pencil-square" aria-hidden="true"></i>MODIFIER</button></a>
            </li>
            <li>
                <a href="#"><button><i class="fa fa-calendar-times-o" aria-hidden="true"></i>ABSENCE</button></a>
                <ul>
                    <li><a href="#"><button>Affichage</button></a></li>
                    <li><a href="#"><button>Saisir</button></a></li>
                </ul>
            </li>
            <li>
                <a href="#"><button><i class="fa fa-calendar" aria-hidden="true"></i>NOTES</button> </a>
            </li>
            <li>
                <a href="#"><button><i class="fa fa-plus-circle" aria-hidden="true"></i>AJOUTER</button></a>
            </li>
        </ul>
    </nav>
    <form action="action.php" method="post">
        <main>

            <div class="selects">
                <ul>
                    <li> <label for="">année</label></li>
                    <li><select name="annee" id="annee">
                            <option value="rien" selected> choisr l'année</option>
                            <option value="">1</option>
                        </select>
                    </li>
                    <li> <label for="anneescolaire">année scolaire</label></li>
                    <li><select name="anneescolaire" id="anneescolaire">
                            <option value="rien" selected>choisr l'année scolaire</option>
                            <option value="">1</option>
                        </select>
                    </li>

                    <li> <label for="filier">filière</label></li>
                    <li><select name="filier" id="filier">
                            <option value="rien" selected> choisir filière</option>
                            <option value="">1</option>
                        </select>
                    </li>
                    <li> <label for="">groupe</label></li>

                    <li><select name="groupe" id="groupe">
                            <option value="rien" selected>choisir le groupe</option>
                            <option value="">1</option>

                        </select>
                    </li>
                    <li><input type="submit" value="valider" id="valider" onclick=" return checkdelects()"> </li>
                </ul>
    </form>
    </div>

    <div class="listeEtudiants">
        <form action="test.php" method="post">
            <table>
                <caption>nom group </caption>
                <tr>

                    <th>cEF</th>
                    <th>nom</th>
                    <th>prénom</th>
                    <th>détails</th>
                    <th>responsable</th>
                    <th>supprimer</th>

                </tr>
                <tr>
                    <td>12345678901</td>
                    <td>mohamed achragf</td>
                    <td>ait hmadobihi</td>
                    <td><input type="button" value="cliquer" id="details" onclick="modalfn()"></td>
                    <td> <input type="radio" name="responsable" id="responsable" class="radiobtn"> </td>
                    <td><a href="#"> <img src="./images/trash.svg" id='trash' alt=""></a> </td>
                </tr>
                <tr>
                    <td>12345678901</td>
                    <td>mohamed achragf</td>
                    <td>ait hmadobihi</td>
                    <td><input type="button" value="cliquer" id="details" onclick="modalfn()"></td>
                    <td> <input type="radio" name="responsable" id="responsable" class="radiobtn"> </td>
                    <td><a href="#"> <img src="./images/trash.svg" id='trash' alt=""></a> </td>
                </tr>
                <tr>
                    <td>12345678901</td>
                    <td>mohamed achragf</td>
                    <td>ait hmadobihi</td>
                    <td><input type="button" value="cliquer" id="details" onclick="modalfn()"></td>
                    <td> <input type="radio" name="responsable" id="responsable" class="radiobtn"> </td>
                    <td><a href="#"> <img src="./images/trash.svg" id='trash' alt=""></a> </td>
                </tr>
                <tr>
                    <td>12345678901</td>
                    <td>mohamed achragf</td>
                    <td>ait hmadobihi</td>
                    <td><input type="button" value="cliquer" id="details" onclick="modalfn()"></td>
                    <td> <input type="radio" name="responsable" id="responsable" class="radiobtn"> </td>
                    <td><a href="#"> <img src="./images/trash.svg" id='trash' alt=""></a> </td>
                </tr>
                <tr>
                    <td>12345678901</td>
                    <td>mohamed achragf</td>
                    <td>ait hmadobihi</td>
                    <td><input type="button" value="cliquer" id="details" onclick="modalfn()"></td>
                    <td> <input type="radio" name="responsable" id="responsable" class="radiobtn"> </td>
                    <td><a href="#"> <img src="./images/trash.svg" id='trash' alt=""></a> </td>
                </tr>
                <tr>
                    <td>12345678901</td>
                    <td>mohamed achragf</td>
                    <td>ait hmadobihi</td>
                    <td><input type="button" value="cliquer" id="details" onclick="modalfn()"></td>
                    <td> <input type="radio" name="responsable" id="responsable" class="radiobtn"> </td>
                    <td><a href="#"> <img src="./images/trash.svg" id='trash' alt=""></a> </td>
                </tr>
                <tr>
                    <td>12345678901</td>
                    <td>mohamed achragf</td>
                    <td>ait hmadobihi</td>
                    <td><input type="button" value="cliquer" id="details" onclick="modalfn()"></td>
                    <td> <input type="radio" name="responsable" id="responsable" class="radiobtn"> </td>
                    <td><a href="#"> <img src="./images/trash.svg" id='trash' alt=""></a> </td>
                </tr>
                <tr>
                    <td>12345678901</td>
                    <td>mohamed achragf</td>
                    <td>ait hmadobihi</td>
                    <td><input type="button" value="cliquer" id="details" onclick="modalfn()"></td>
                    <td> <input type="radio" name="responsable" id="responsable" class="radiobtn"> </td>
                    <td><a href="#"> <img src="./images/trash.svg" id='trash' alt=""></a> </td>
                </tr>
                <tr>
                    <td>12345678901</td>
                    <td>mohamed achragf</td>
                    <td>ait hmadobihi</td>
                    <td><input type="button" value="cliquer" id="details" onclick="modalfn()"></td>
                    <td> <input type="radio" name="responsable" id="responsable" class="radiobtn"> </td>
                    <td><a href="#"> <img src="./images/trash.svg" id='trash' alt=""></a> </td>
                </tr>


            </table>
    </div>


    </main>
    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <p>Some text in the Modal..</p>
        </div>

    </div>
    <div class="ajoute-valider">
        <div class="ajoute">
            <a href="#"><img src="./images/plus-circle.svg" alt="">
                <p>Ajouter</p>
            </a>

        </div>
        <div class="valider">
            <input type="submit" value="valider" id="valider-responsable" onclick="return btnr()">
        </div>
        </form>
    </div>

    <footer>
        <p>© Copyright | DevWFS205 |2022</p>
    </footer>



    <script>

        /*                  check select form     */
        var groupe = document.getElementById('groupe')
        var annee = document.getElementById('annee')
        var anneescolaire = document.getElementById('anneescolaire')
        var filier = document.getElementById('filier')

        function checkdelects() {
            var etat1, etat2, etat3, etat4
            if (groupe.value == 'rien') {
                groupe.style.border = '2px solid red'
                etat1 = true
            }
            else {
                groupe.style.border = '2px solid  blue'
                etat2 = false
            }

            if (annee.value == 'rien') {
                annee.style.border = '2px solid red'
                etat2 = true
            }
            else {
                annee.style.border = '2px solid  blue'
                etat2 = false
            }

            if (anneescolaire.value == 'rien') {
                anneescolaire.style.border = '2px solid red'
                etat3 = true
            }
            else {
                anneescolaire.style.border = '2px solid  blue'
                etat3 = false
            }
            if (filier.value == 'rien') {
                filier.style.border = '2px solid red'
                etat4 = true
            }
            else {
                filier.style.border = '2px solid  blue'
                etat4 = false
            }
            if (etat1 == true || etat2 == true || etat3 == true || etat4 == true)
                etatgeneral = false
            else
                etatgeneral = true

            return etatgeneral

        }


        var radiobtn = document.getElementsByClassName('radiobtn')
        function btnr() {
            var etat = false;
            for (let i = 0; i < radiobtn.length; i++) {


                if (radiobtn[i].checked == true)
                    etat = true
            }
            return etat
        }


        /* modal box */
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the button that opens the modal


        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on the button, open the modal
        function modalfn() {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function () {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>

</html>