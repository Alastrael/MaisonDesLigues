<?php

    include_once("dataAccessCRUD/formations.php");
    //cette fonction identifie si le mot de passe et le login
    //rentré par un utilisateur existe dans la base de donnée
    function identifi($nom, $mdp)
    {
        //connection à la base de donnée
        $connexion = connexion();

        //requête qui vérifie le nombre de lignes contenant l'id et le mdp rentrés dans l'appel de la fonction
        $requete = "select count(*) as nombre from salarie where nom_Salarie = :nom and mdp_Salarie = :mdp";

        //préparation de la requête préparée, remplacement des :id et :mdp par les valeurs
        //rentrées dans l'appel de la fonction avec le BindValue
        $resultat = $connexion->prepare($requete);
        $resultat->BindValue(':nom',$nom);
        $resultat->BindValue(':mdp',$mdp);

        $execResultat = $resultat->execute();

        $tabResultat = $resultat->fetch();

        //variable pour vérifier si oui ou non les données rentrées existent
        $access = false;

        if($tabResultat[0]==1)
        {
            $access = true;
           
        }
        else $access = false;

        //retourne la réponse vrai si existe et false sinon
        return $access;

    }
    //fin de fonction identifi

    function recupID($nom, $mdp){
        $dbh = connexion();
        $requete = "select id_Salarie from salarie where mdp_Salarie = :mdp and nom_Salarie = :nom";
        $resultat = $dbh->prepare($requete);
        $resultat->BindValue(':nom', $nom);
        $resultat->BindValue(':mdp', $mdp);
        $tabResultat = $resultat->execute();
        $tabResultat = $resultat->fetch();

        return $tabResultat;
    }

    /**
     * Cette fonction a pour but de rediriger l'utilisateur vers une autre page
     *
     * @param [string] $cible
     * @return void
     */
    function redirection($cible) {
        
        header('Location:'.$cible, false);

    }
    //fin de fonction de redirection




    function chef()
    {
        $connexion = connexion();

        $requete = "select id_Salarie from equipe where id_Salarie = :id";

        $resultat = $connexion->prepare($requete);
        $resultat->BindValue(':id',$_COOKIE["id"]);

        $execResultat = $resultat->execute();

        $tabResultat = $resultat->fetch();

        return $tabResultat;

    }

?>