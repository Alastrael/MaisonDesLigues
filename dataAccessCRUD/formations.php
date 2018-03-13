<?php

    /**
     * Cette fonction a pour but de se connecter à notre base de donnée bdd_m2l
     *
     * @return PDO
     */
        function connexion(){

        $host = "localhost";
        $dbname = "bdd-m2l";
        $user = "root";
        $mdp = "";

        $pdo=new PDO('mysql:host='.$host.';dbname='.$dbname,$user,$mdp, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'))
            or die ("Problème de connexion à la base de donnée");

        //retourne une connection à la base de donnée
        return $pdo;
    }
    //fin fonction connexion

    /**
     * Cette fonction a pour but de renvoyer toutes les informations des formations ordonnées par les id
     *
     * @param [string] $id
     * @return void
     */

    function pdfFormations($id){
        $pdo = connexion();
        
        $requete = "select * from formation where id_Formation = :id";
        
        $prepReq = $pdo->prepare($requete);
        $prepReq->BindValue(':id',$id);
        
        $execPrepReq = $prepReq->execute();
        
        $data = $prepReq->fetchAll();
        
        return $data;
    }
    
    function nomFormation($nom){

        $pdo = connexion();

        $requete = "select * from salarie natural join participer natural join 
        formation where (statut=1 or statut=2) and salarie.nom_Salarie = :nom";

        $prepReq = $pdo->prepare($requete);
        $prepReq->BindValue(':nom',$nom);

        $execPrepReq = $prepReq->execute();

        $data = $prepReq->fetchAll();

        return $data;
    }
    //fin de la fonction nomFormation

    /**
     * Cette fonction a pour but de rechercher une formation avec son id
     *
     * @param [string] $id
     * @return void
     */
    function offreFormationDispo(){
        $dbh = connexion();
        $requete = "select * from formation";
        
        $prepReq = $dbh->prepare($requete);

        $execPrepReq = $prepReq->execute();
        
        $data = $prepReq->fetchAll();
        
        return $data;
    }
    //fin de la fonction des offres de formations disponible

    function formationsEnAttente($id){
        $dbh = connexion();
        $requete = "select * from salarie natural join participer natural join 
        formation where statut='2' and salarie.id_Salarie = :id";
        $prepReq = $dbh->prepare($requete);
        $prepReq->BindValue(':id',$id);

        $execPrepReq = $prepReq->execute();
        
        $data = $prepReq->fetchAll();
        
        return $data;
    }

    function formationsFinie($id,$dateFinale){
        $dbh = connexion();
        $requete = "select * from formation natural join participer where statut='5'
        and salarie.id_Salarie = :id";
        $prepReq = $dbh->prepare($requete);
        $prepReq->BindValue(':id',$id);

        $execPrepReq = $prepReq->execute();
        
        $data = $prepReq->fetchAll();
        
        return $data;
    }

    function equipier($id){
        $dbh = connexion();
        $requete = "select Id_Equipe from equipe where id_Salarie = :id";
        $prepReq = $dbh->prepare($requete);
        $prepReq->BindValue(':id',$id);
        $execPrepReq = $prepReq->execute();
        $data = $prepReq->fetch();

        $requete = "select * from salarie where Id_Equipe = :data and id_Salarie <> :id";
        $prepReq = $dbh-> prepare($requete);
        $prepReq->BindValue(':id',$id);
        $prepReq->BindValue(':data',$data[0]);
        $execPrepReq = $prepReq->execute();
        $data = $prepReq->fetchAll();
        
        return $data;
    }

    function verificationStatut($idFormation, $salarie){
        $connection = connexion();
        $requete = "select statut from participer natural join formation where formation.id_Formation = :id 
        and id_Salarie = :salarie and participer.id_Formation = :id";
        $prepReq = $connection->prepare($requete);
        $prepReq->BindValue(':id',$idFormation);
        $prepReq->BindValue(':salarie',$salarie);
        $execPrepReq = $prepReq->execute();
        $tab = $prepReq->fetch();
        if($tab[0] == "") return true; else return false;
    }

    /**
     * Cette fonction a pour but de renvoyer le nom du salarié
     *
     * @param [string] $id
     * @return void
     */
    function nomSalarie($nom) {
        $connection = connexion();
        $requete = "select nom_Salarie from salarie where nom_Salarie = :nom";
        $prepReq = $connection->prepare($requete);
        $prepReq->BindValue(':nom',$nom);
        $execPrepReq = $prepReq->execute();
        $tab = $prepReq->fetch();
        return $tab[0];
    }
    //fin fonction nomSalarie

    function rediriger($cible) {
        header('Location:'.$cible, false);
    }

    /**
     * Cette fonction a pour but de changer le statut d'une formation qui est en attente par accepté.
     *
     * @param $id,$nom
     * @return void
     */
    function updateChef($decision,$id,$nom){
        $connexion = connexion();
        if($decision == "accepter") $requete = "update participer set statut = '1' where participer.id_Salarie = :nom and participer.id_Formation = :id";
        else $requete = "update participer set statut = '0' where participer.id_Salarie = :nom and participer.id_Formation = :id";
        $prepRequete = $connexion->prepare($requete);
        $prepRequete->bindValue(':id',$id);
        $prepRequete->bindValue(':nom',$nom);
        $execRequete = $prepRequete->execute();
        $url = "../equipe.php";
        rediriger($url);
    }

    function annulerParticipation($formation){
        $connexion = connexion();
        $requete = "DELETE FROM participer WHERE participer.id_Salarie = :id AND participer.id_Formation = :formation";
        $prepRequete = $connexion->prepare($requete);
        $prepRequete->bindValue(':id',$_COOKIE["id"]);
        $prepRequete->bindValue(':formation',$formation);
        $execRequete = $prepRequete->execute();
        $url = "../index.php";
        rediriger($url);
    }

    function ancienneFormation($formation) {
        $connexion = connexion();
        $requete = "update participer set statut ='5' where participer.id_Salarie=:idSalarie and participer.id_Formation=:formation";
        $prepRequete = $connexion->prepare($requete);
        $prepRequete->bindValue(':idSalarie',$_COOKIE["id"]);
        $prepRequete->bindValue(':formation',$nom);
        $execRequete = $prepRequete->execute();
        $url = "./offres.php";
        rediriger($url);
    }

?>
