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
        annulerParticipation($_POST['identifiantParticipation']);
    ?>

</body>
</html>