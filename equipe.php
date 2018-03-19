<!DOCTYPE html>

<?php
    require_once("dataAccessCRUD/formations.php");
    require_once("vues/afficher.php");
    require_once("dataAccessCRUD/identification.php");
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" type="text/css" href="assets/css/accueil.css">
    <link rel="stylesheet" type="text/css" href="assets/css/pageFormations.css">
    <link rel="stylesheet" type="text/css" href="assets/css/forAll.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

    <script src="https://use.fontawesome.com/b8a3d61bd6.js"></script>

    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/deconnexion.js"></script>
    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="assets/js/bootstrap.min.js" ></script>

    <title>Equipe</title>
</head>
<body>


    <?php
        $_COOKIE["nomPage"] = "equipe";
        include_once("dataAccessCRUD/redirectionCookies.php");
        include_once("vues/header.php");
    ?>
    <div>
    <?php
        include_once("vues/landing_equipe.php");
    ?>
    </div>
</body>
</html>