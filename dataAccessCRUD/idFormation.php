<?php

    function idFormations($id) {

        include_once("formations.php");
        
        $connexion = connexion();
        
        $requete = "select statut from participer where id_Formation= :id and id_Salarie= :nom";
        $PrepRequete = $connexion->prepare($requete);
        $PrepRequete->bindValue(':id',$id);
        $PrepRequete->bindValue(':nom',$_COOKIE['moncookie']);
        
        $execPrepReq = $PrepRequete->execute();
        
        echo $execPrepReq;
    }
    
?>

