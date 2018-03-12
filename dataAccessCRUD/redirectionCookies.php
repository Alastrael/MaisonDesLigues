<?php
     if(!isset($_COOKIE["moncookie"]))
     {
         $url = "authent.php";
         redirection($url);
         exit();
     }
?>