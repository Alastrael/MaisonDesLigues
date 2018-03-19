<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="assets/css/authent.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/forAll.css">
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="https://use.fontawesome.com/b8a3d61bd6.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="assets/js/bootstrap.min.js" ></script>
    <script src="assets/js/erreurDeConnexion.js"></script>
    <?php
        //Destruction of the cookie "moncooki" which has the id of the identified person.
        setcookie("moncookie","",time()-3600);
        //Path of the php file that has access to the database.
        include_once("dataAccessCRUD/identification.php");
    ?>
    <title>Portail d'accès</title>
</head>
<body>
    <?php
        //Header of the connexion page.
        include_once("vues/connexion_header.php");
    ?>
    <div class="container" style="margin-top:5%">
        <div class="row justifiy-content-center">
            <div class="card bg-light border-info mb-3 pad " style="border-width: thin; width: 30%;">
                <div class = "card-header text-center" style="background-color: rgb(70, 71, 71) !important; color:white;">
                    <h4>Authentification</h4>
                </div>
                <div class="card-body text-center">
                <!-- Formulaire ayant pour but de renseigner l'identifiant et le mot de passe d'un utilisateur. Il contient également un bouton pour envoyer les données. -->
                <form class="justifiy-content-center" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" style="margin-bot:-4%;">
                <!--
                    <table class="justifiy-content-center">
                        <tr>
                            <td>Identifiant<input type="text" class="form-control" name="identifiant" placeholder="Votre identifiant..." maxlength="100"></td>
                        </tr>
                        <tr>
                            <td>Mot de passe<input type="password" class="form-control" name="motdepasse" placeholder="Votre mot de passe..." maxlength="100"></td>
                        </tr>

                    </table>
                !-->
                    <div>
                        <input type="text" class="form-control" name="identifiant" placeholder="Votre identifiant..." maxlength="100">
                    </div class="form-group">
                    <div class="form-group" style="margin-top:5%">
                        <input type="password" class="form-control" name="motdepasse" placeholder="Votre mot de passe..." maxlength="100">
                    </div>


                    <input type="submit" class="btn btn-warning" style="margin-top:10%" name="boutonConnexion" value=" Connexion "/>
                </form>
                </div>
            </div>

            <?php
                //Processus de vérification permettant la connexion
                if (isset($_POST['boutonConnexion'])) {
                    $id = $_POST['identifiant'];
                    $mdp =  md5($_POST['motdepasse']);
                    if(identifi($id, $mdp)) {
                        $identifiant = recupID($id,$mdp);
                        setcookie("moncookie",$id);
                        setcookie("nomPage","authent");
                        setcookie("id",$identifiant['id_Salarie']);
                        $url = "index.php";
                        redirection($url);
                        exit();
                    }
                    else echo '<script>erreurConnexion()</script>';
                    //Si le mot de passe ou l'identifiant rentré est mauvais.                       
                } 
            ?>
        </div>
    </div>
</body>
</html>