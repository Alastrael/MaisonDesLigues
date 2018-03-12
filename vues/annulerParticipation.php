<!DOCTYPE html>
<html lang="en">

<?php
    include_once("../dataAccessCRUD/formations.php");
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>

    <?php
        $index = "../index.php";
        if($_POST["submit"] == "Annuler la participation")annulerParticipation($_POST['identifiantParticipation']);
        else if($_POST["submit"]=="Classer cette formation")ancienneFormation($_POST['identifiantParticipation']);
        else rediriger($index);
    ?>

</body>
</html>