<?php
ini_set('display_errors', '1');
include('inc/db.php');
session_start();
if (empty($_SESSION) or $_SESSION['compteType'] == "directrice") {
    header('location:./login.php');
}

?>
<?php
$user = $_SESSION['CEF'];

$sql = "SELECT * FROM stagiaire WHERE CEF = $user";
$pdo_statement = $conn->prepare($sql);
$pdo_statement->execute();
$result = $pdo_statement->fetch();
$idgrp = $result['groupe_idGroupe'];


$sql2 = "SELECT * FROM stagiaire WHERE groupe_idGroupe =$idgrp";
$pdo_statement = $conn->prepare($sql2);
$pdo_statement->execute();
$resultfinale = $pdo_statement->fetchALL();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>responsable 🥼</title>
    <link rel="shortcut icon" type="image/png" href="./images/icon.png" />
    <link rel="icon" type="image/x-icon" href="./images/logoApp.png">
    <link rel="stylesheet" href="./styles/styleResponsable.css">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logoOfppt">
                <img src="./images/Ofpptlogo.png" alt="logoOfppt" id="logoOfppt">
            </div>
            <div class="logoApp">
                <img src="./images/logoApp.png" alt='logo' id="logoApp">
            </div >
            <div class="buttonDeconexion"><a href="logout.php"> <button>Déconnexion</button></a>
            </div>
        </div>
        <section>
            <h1>espace responsable  <?=$result['nomStagiaire']." ".$result['prenomStagiaire'];?></h1>
            <h1>Testing</h1>
            <?php
    $errormsg = "" ;
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['errormsg'])) {
        $errormsg = $_GET ["errormsg"] ;
    }
}
?>
            <h2 style="text-align: center;color : red;"><?php echo $errormsg;?></h2>
            <div class="responsable">
            <form action="./inc/InsertAbsence.php" method="POST" id='formrespo' enctype="multipart/form-data">
            <div class="listeEtudiants">
                <div>
                       Date  : <input required  placeholder="La Date" name="date" class="textbox-n" type="text" onfocus="(this.type='date')" id="date" >
                </div>
                <div>
                      Formateur : <input required type="text" name="formateur" id="formateur"  placeholder="Le Formateur" >
                </div>
                <div> 
                     Module : <input  required type="text" name="module" id="module" placeholder="Le Module" >
                </div>
            </div>
          
                <table>
                    <tr>
                        <th>nom</th>
                        <th>prénom</th>
                        <th>absence</th>
                        <th>retard</th>
                        <th>heure debut</th>
                        <th>heure fin</th>
                    </tr>
                    <?php
                    if (!empty($resultfinale)) {
                        $c =1;
                        foreach ($resultfinale as $row) {
                            $id = $row['CEF'];
                            $_SESSION['idgrp'] =$row['groupe_idGroupe']
                            ?>
                     <tr id="tr-<?=$c++?>">
                        <td><?= $row['nomStagiaire']?></td>
                        <td><?= $row['prenomStagiaire']?></td>

                        <td><input type="checkbox" name="absence-<?=$id?>" id="btnAb"  value="absence" /></td>
                        <td><input type="checkbox" name="retard-<?=$id?>" id="btnRet" value="retard"/></td>
                        <td><input type="time" class="debut" name="debut-<?=$id?>" min="8:30" max="18:30" ></td>
                        <td> <input type="time" class="fin" name="Fin-<?=$id?>" min="8:30" max="18:30"></td>
                    </tr>
                           
                     <?php

                        }
                    }
?> 
                <input type="hidden" id="trcount" value="<?=$c?>"/>     
                </table>
                
            </div>
            <div class="buttonVlaiderPhoto">
                <div class="buttonPhoto">
                <input type="file" name="file" id="buttonPhoto" >
            </div>
                <input type="submit" value="valider" name="valider" id="buttonValider" required>
            </div>
        </form>
        </section>
        <script >
            $( document ).ready(function() {
            const countrow = parseInt($('#trcount').val())
                
                $('#buttonValider').click(function(e){
                   console.log('clicked!!')
                    e.preventDefault()
                    let countDubt =0
                    let countFin =0
                    let checkboxLength2 = $("input:checkbox:checked").length
                    let errorgenral = 1
                    let breaker = false
                    for(i=1;i<=countrow;i++){
                    if(breaker){
                        break
                    }
                        let checkboxLength = $("#tr-"+i +" input:checkbox:checked").length
                        if(checkboxLength == 1){  
                            $("#tr-"+i+" input[type=time]").each(function(){
                                let debut = 0
                                let fin  = 0
                                if($(this).hasClass("debut")){
                                    if($(this).val() != ''){
                                        debut = 1
                                        console.log("debut changed")
                                    }
                                }
                                if($(this).hasClass("fin")){
                                    if($(this).val() != ''){
                                        fin = 1
                                        console.log(typeof($(this).val()))
                                    }
                                }
                               
                                if(debut !==1 && fin !==1){
                                    $('#tr-'+i).css({"color": "red", 
                                                    });
                                    console.log("can style "+i)
                                    errorgenral = 1
                                    breaker  = true 
                                    return false
                                }else{
                                    errorgenral = 0
                                }
                            })
                                                        
                        }
                        
                       
                    }
                    if(errorgenral == 0){
                        $('#formrespo').submit()
                    }else{
                        alert('wa ktb ya wld l9heba lwi9ita yn3el rabk')
                    }
                })
                
});
        </script>
        <footer>
                <p>        © Copyright | DevWFS205 |2022 </p>
        </footer>
    </div>
</body>
</html>







