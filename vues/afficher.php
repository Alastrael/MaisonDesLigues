<?php
    /**
     * Undocumented function
     *
     * @param [type] $valeur
     * @param [type] $page
     * @param [type] $dateFinale
     * @return void
     */
    function pageFormations($valeur,$page,$dateFinale){
        ?>
        <i class='fa fa-arrow-circle-down' aria-hidden='true'></i>
            </a> 
            <div class='collapse' id='<?php echo $valeur['id_Formation']?>'>
                <div class='card card-body'>
                    <div class='pdfButton'>
                        <form method="POST" action="pdf.php">
                            <button type="submit" value=
                            <?php echo $valeur['id_Formation'] ?>
                            name='bouttonPDF' class="btn btn-primary btn-danger redButton"><i class="fa fa-print"></i>
                            PDF</button>
                        </form>
                    </div>
                    <table class="table" name="tableauPDF">
                        <tbody>
                        <tr>
                            <th scope="row">Etat de la formation</th>
                            <td> <?php
                                if($page == "historique") echo "Déjà effectuée";
                                else {
                                    if($page == "offres") echo "Disponible";
                                    else if ($valeur['statut']=='2') echo "En attente de validation";
                                    else if($valeur['datedebut_Formation']<date("Y-m-d") && date("Y-m-d",
                                        $dateFinale)>date("Y-m-d"))echo "En cours";
                                    else if(date("Y-m-d",$dateFinale)<date("Y-m-d"))echo "A classer";
                                    else echo "Acceptée";
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Description de la formation</th>
                            <td><?php echo $valeur['contenu_Formation'] ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Début de la formation (Année - Mois - Jours)</th>
                            <td><?php echo $valeur['datedebut_Formation']?></td>
                        </tr>
                        <tr>
                            <th scope="row">Nombre d'heures</th>
                            <td><?php echo $valeur['nbrheures_Formation']?></td>
                        </tr>
                        <tr>
                            <th scope="row">Nombre de jours de formation</th>
                            <td><?php echo $valeur['nbrJour_Formation']?></td>
                        </tr>
                        <tr>
                            <th scope="row">Lieu de formation</th>
                            <td><?php echo $valeur['lieu_Formation']?></td>
                        </tr>
                        <tr>
                            <th scope="row">Prérequis pour la formation</th>
                            <td><?php echo $valeur['prerequis_Formation']?></td>
                        </tr>
                        <tr>
                            <th scope="row">Prestataire pour la formation</th>
                            <td><?php echo $valeur['prestataire_Formation']?></td>
                        </tr>
                        </tbody>
                    </table>
        <?php
        return true;
    }//close the function pageFormations.

    /**
     * This function display formations which has a link with the current-user (a link symbolize by 1 or 2).
     */
    function affichageFormations(){
        include_once("dataAccessCRUD/idFormation.php");
        $data= nomFormation($_COOKIE["moncookie"]);
        $page = "formations";
        foreach ($data as $valeur) 
        {
            $dateFinale = $valeur['datedebut_Formation'];
            $dateFinale = strtotime(date("Y-m-d", strtotime($dateFinale)) . " +".$valeur['nbrJour_Formation']." day");
                echo "
                <a class='list-group-item list-group-item-action text-center aCollapse' data-toggle='collapse' href='#"
                .$valeur['id_Formation']."' style='background-color: "
                .(($valeur['statut']=='2') ? 'rgba(152, 153, 154, 0.3)':'').";' aria-expanded='false' aria-controls='collapseExample'>
                ";
                echo "Formation : ".$valeur['nom_Formation'];
                if($valeur['statut']=='2') echo "=> en attente de validation";
                pageFormations($valeur,$page,$dateFinale);
                echo "
                    <form class='aCollapse' action='vues/annulerParticipation.php' method='POST' id='coucou' onsubmit='javascript:return messageParticipationDenied(".$valeur['nom_Formation'].
                    ")'>
                        <div>
                            <input type='hidden' value='".$valeur['id_Formation']."' name='identifiantParticipation'>
                        </div>
                    ";
                    ?>
                    <?php
                        if($valeur['datedebut_Formation']>=date("Y-m-d")) echo "
                        <div>
                            <input class='btn btn-primary formButtonCollapse'
                             onclick='messageParticipationDenied(".$valeur['nom_Formation'].
                            ")' type='submit' name='submit' value='Annuler la participation'>
                        </div>";
                        else if(date("Y-m-d",$dateFinale)<date("Y-m-d")) echo "
                        <div>
                            <input class='btn btn-primary formButtonCollapse'
                            name='submit' type='submit' value='Classer cette formation'>
                        </div>";
                    ?>
                                
                            </form>
                        </div>
                    </div>
            <?php
        }//end foreach.
    }//end of the function affichageFormations.

    /**
     * This function display all the formations in the database, except those which has a statut link to
     * the current-user or the current-date > limit date.
     */
    function offresFormations(){
        $data = formationsAll();
        $page = "offres";
        $passage = false;
        foreach ($data as $valeur) {
            if (verificationStatut($valeur['id_Formation'],$_COOKIE['id'])) {
                $dateFinale = $valeur['datedebut_Formation'];
                $dateFinale = strtotime(date("Y-m-d", strtotime($dateFinale)) . " +"
                .$valeur['nbrJour_Formation']." day");
                
                if($valeur['datedebut_Formation']>=date("Y-m-d")) {
                    echo 
                    "
                    <a class='list-group-item list-group-item-action text-center' data-toggle='collapse' href='#"
                    .$valeur['id_Formation']."' style='margin-top:1%;' aria-expanded='false'
                    aria-controls='collapseExample'>
                    ";
                    echo "Formation : ".$valeur['nom_Formation'];
                    $passage = pageFormations($valeur,$page,$dateFinale);              
                    ?>
                    
                        <form action="vues/update.php" method="POST" id="form<?php echo $valeur['id_Formation'];?>">
                            <div>
                                <input type="hidden" name="idFormation" value="<?php echo $valeur['id_Formation'];?>">
                            </div>
                            <div>
                                <input class="btn btn-primary formButtonCollapse" type="submit" value="S'inscrire à cette formation">
                            </div> 
                        </form>
                    </div>
                </div>
                <?php
                }
            }
        }//ferme le foreach
        if(!$passage){
            echo "<h1 class='text-center'>Aucune offre disponible.</h1>";
        }
    }//close the function OffresFormations.
    
    /**
     * This function display formations that has the limit-date < current-date.
     */
    function historiqueDesFormations(){
        $page = "historique";
        $data = formationsAll();
        foreach ($data as $value) 
        {
            $dateFinale = $value['datedebut_Formation'];
            $dateFinale = strtotime(date("Y-m-d", strtotime($dateFinale)) . " +".$value['nbrJour_Formation']." day");
            $formationsFinies = formationsFinie($_COOKIE["id"],date("Y-m-d",$dateFinale));
        }//ferme le foreach
        foreach ($formationsFinies as $valeur) {
            echo 
            "
            <a class='list-group-item list-group-item-action text-center' data-toggle='collapse' href='#"
            .$valeur['id_Formation']."' style='margin-top:1%;' aria-expanded='false' aria-controls='collapseExample'>
            ";
            
            echo "Formation : ".$valeur['nom_Formation'];
            pageFormations($valeur,$page,$dateFinale);
            echo "
                </div>
            </div>            
            ";
        }
    }//close the function historiqueDesFormations

    /**
     * This function allows chief to manage there teams. They can accept or refuse
     * the demand of formations.
     */
    function equipeAffichage(){
        $data = equipier($_COOKIE["id"]);
        $page = "equipe";
        foreach ($data as $valeur) {
            $formations = formationsEnAttente($valeur['id_Salarie']);
            echo 
            "
            <a class='list-group-item list-group-item-action text-center' data-toggle='collapse' href='#"
            .$valeur['id_Salarie']."' style='margin-top:1%;' aria-expanded='false' aria-controls='collapseExample'>
            ";
            echo $valeur['nom_Salarie']; 
            ?>
            <i class='fa fa-arrow-circle-down' aria-hidden='true'></i>
            </a>
            <div class='collapse' id='<?php echo $valeur['id_Salarie']?>'>
                <div class='card card-body espace'> 
                    <div class='espace'>
                        <p>
                            <?php echo $valeur['nom_Salarie'] ?> suit les formations suivantes : <br>
                            <?php 
                                $message = "";
                                $formationsEnAttente = formationsSuivies($valeur['id_Salarie']);
                                foreach ($formationsEnAttente as $valeur) {
                                    echo "- ".$valeur['nom_Formation']."<br>";
                                }
                                if(count($formationsEnAttente)==0) {
                                    echo "Aucune.";
                                }
                                if(count($formations)>=1)$message = "fait";
                            ?>
                        </p>
                    </div>
                    <?php if($message != ""){ echo"
                    <form action='vues/_updateCHEF.php' method='POST' id='".$valeur['id_Salarie']."'>
                        <div class='form-group'>
                            <label for='exampleFormControlSelect1'>Selectionnez la formation que vous voulez gérer : </label>
                            <div>
                                <select class='form-control' name='identifiantFormation' style='width:30%;'>";
                                    foreach ($formations as $formation) {
                                        echo "<option style='margin-right:-10%;' value='".$formation['id_Formation']."'>".$formation['nom_Formation']."</option>";
                                    }
                                    echo "     
                                </select>
                                </div>
                                <div>
                                <select class='form-control' name='decision' style='width:30%;'>
                                    <option value='accepter'>Accepter la demande</option>;  
                                    <option value='refuser'>Refuser la demande</option>; 
                                </select>
                            </div>
                        </div>
                        <input type='hidden' value='".$valeur['id_Salarie']."' name='identifiantSalarie'>
                        <input class='btn btn-primary' style='background-color:rgba(44, 156, 164, 0.8);' type='submit' value='Valider'>
                    </form> 
                    ";}?>                                
                </div>
            </div>
        <?php
        }
    }//close the function equipeAffichage.

?>