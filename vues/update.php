<!DOCTYPE html>
<html>
    <?php
        include_once("../dataAccessCRUD/formations.php");
        include_once("../dataAccessCRUD/identification.php")
    ?>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
    <h1><?php echo $_COOKIE["id"] ?></h1>

    <?php
        $connexion = connexion();
        if(chef()) $requete = "INSERT INTO participer (id_Salarie, id_Formation, statut) VALUES (:salarie, :formation,1)";
        else $requete = "INSERT INTO participer (id_Salarie, id_Formation, statut) VALUES (:salarie, :formation,)";
        $prepRequete = $connexion->prepare($requete);
        $prepRequete->bindValue(':formation',$_POST["idFormation"]);
        $prepRequete->bindValue(':salarie',$_COOKIE["id"]);
        $execRequete = $prepRequete->execute();

        $url = "../index.php";
        rediriger($url);
    ?>

</body>
</html>