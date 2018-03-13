<?php    
//pense bete : creer un bouton qui permettrait de pouvoir valider la formation, il se mettrait disabled tant que la date + durée de la formation est inférieure à la current date
    function pageFormations($valeur,$page,$dateFinale){
        //$dateFinale = date_create($valeur['datedebut_Formation']);
        //$dateFinale = strtotime(date("Y-m-d", strtotime($dateFinale)) . " +".$valeur['NbrJour_formation']." day");
        //date_add($dateFinale,date_interval_create_from_date_string($valeur['nbrJour_Formation']));
        ?>
        <i class='fa fa-arrow-circle-down fa-spin' aria-hidden='true'></i>
            </a> 
            <div class='collapse' id='<?php echo $valeur['id_Formation']?>'>
                <div class='card card-body'>
                    <table class="table" name="tableauPDF">
                        <tbody>
                        <tr>
                            <th scope="row">Etat de la formation</th>
                            <td> <?php
                                if($page == "historique") echo "Déjà effectuée";
                                else {
                                    if($page == "offres") echo "Disponible";
                                    else if ($valeur['statut']=='2') echo "En attente de validation";
                                    else if($valeur['datedebut_Formation']<date("Y-m-d") && date("Y-m-d",$dateFinale)>date("Y-m-d"))echo "En cours";
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
                        </tbody>
                    </table>
                    <div style='height: 50px;'>
                    <form method="POST" action="pdf.php">
                        <button type="submit" value=
                        <?php echo $valeur['id_Formation'] ?> 
                        style="background-color: rgba(223, 67, 56, 0.9);"
                         name='bouttonPDF' class="btn btn-primary btn-danger"><i class="fa fa-print"></i>
                          PDF</button>
                    </form>
                    
            
        <?php
    }//ferme la fonction pageFormations

    function nomDeFormation(){
        include_once("dataAccessCRUD/idFormation.php");

        $data= nomFormation($_COOKIE["moncookie"]);
        $page = "formations";

        foreach ($data as $valeur) 
        {
            $dateFinale = $valeur['datedebut_Formation'];
            $dateFinale = strtotime(date("Y-m-d", strtotime($dateFinale)) . " +".$valeur['nbrJour_Formation']." day");
            
                echo "
                <a class='list-group-item list-group-item-action text-center' data-toggle='collapse' href='#"
                .$valeur['id_Formation']."' style='background-color: "
                .(($valeur['statut']=='2') ? 'rgba(152, 153, 154, 0.3)':'').";margin-top:1%;' aria-expanded='false' aria-controls='collapseExample'>
                ";
            
                echo $valeur['nom_Formation'];
                if($valeur['statut']=='2') echo "=> en attente de validation";

                pageFormations($valeur,$page,$dateFinale);
                echo "
                            <form style='position:relative; left:70px; bottom:54px; width:90%;' action='vues/annulerParticipation.php' method='POST' id='".$valeur['id_Salarie']."'>
                                <div>
                                    <input type='hidden' value='".$valeur['id_Formation']."' name='identifiantParticipation'>
                                </div>";
                    ?>
                    <?php
                        if($valeur['datedebut_Formation']>=date("Y-m-d")) echo "
                        <div>
                            <input class='btn btn-primary' style='background-color: rgba(44, 156, 164, 0.8); color:white; position:relative; left:595px;'
                             onclick='alert('Annulation de la ".$valeur['nom_Formation'].
                            "')' type='submit' name='submit' value='Annuler la participation'>
                        </div>";
                        else if(date("Y-m-d",$dateFinale)<date("Y-m-d")) echo "
                        <div>
                            <input class='btn btn-primary' style='background-color: rgba(44, 156, 164, 0.8); color:white;position:relative; left:650px;' name='submit' type='submit' value='Classer cette formation'>
                        </div>";
                    ?>
                                
                            </form>
                        </div>
                    </div>
                </div>   
            <?php
        }//ferme le foreach
    }//ferme la fonction nomDeFormations

    function OffresFormations(){
        $data = offreFormationDispo($_COOKIE["moncookie"]);
        $page = "offres";
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
                    echo $valeur['nom_Formation'];
                    pageFormations($valeur,$page,$dateFinale);
              
                    ?>
                        <form style="position:relative; left:70px; bottom:54px;" action="vues/update.php" method="POST" id="form<?php echo $valeur['id_Formation'];?>">
                            <div>
                                <input type="hidden" name="idFormation" value="<?php echo $valeur['id_Formation'];?>">
                            </div>
                            <div>
                                <input class="btn" style="background-color: rgba(44, 156, 164, 0.8); color:white; position:relative; left:575px;" type="submit" value="S'inscrire à cette formation">
                            </div> 
                        </form>                                    
                        </div>
                    </div>
                </div>
                <?php
                }
            }
                        
        }//ferme le foreach
        if(count($data)==0 || $data == null){
            echo "<h1 class='text-center'>Aucune offre disponible.</h1>";
        }
    }//ferme la fonction OffresFormations
    
    function historiqueDesFormations(){
        $page = "historique";
        $data = offreFormationDispo();
        foreach ($data as $valeur) 
        {
            $dateFinale = $valeur['datedebut_Formation'];
            $dateFinale = strtotime(date("Y-m-d", strtotime($dateFinale)) . " +".$valeur['nbrJour_Formation']." day");
            if(date("Y-m-d",$dateFinale)<date("Y-m-d")) {
                echo 
                "
                <a class='list-group-item list-group-item-action text-center' data-toggle='collapse' href='#"
                .$valeur['id_Formation']."' style='margin-top:1%;' aria-expanded='false' aria-controls='collapseExample'>
                ";
                
                echo $valeur['nom_Formation'];
                pageFormations($valeur,$page,$dateFinale);
                echo "
                        </div>
                    </div>
                </div>            
                ";
            }
        }//ferme le foreach      
    }//ferme la fonction historiqueDesFormations

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
                            <?php echo $valeur['nom_Salarie'] ?> a demandé de suivre les formations suivantes : <br>
                            <?php 
                                $message = "";
                                foreach ($formations as $valeur) {
                                    if(count($formations)>=1){
                                        echo "- ".$valeur['nom_Formation']."<br>";
                                        $message = "fait";
                                    } 
                                }
                                if($message == "") echo "Aucune.";
                            ?>
                        </p>
                    </div>
                    <?php if($message != ""){ echo"
                    <form action='vues/_updateCHEF.php' method='POST' id='".$valeur['id_Salarie']."'>
                        <div class='form-group'>
                            <label for='exampleFormControlSelect1'>Selectionnez la formation que vous voulez gérer : </label>
                            <div style='display:inline;'>
                                <select class='form-control' name='identifiantFormation' style='width:30%;'>";
                                    foreach ($formations as $formation) {
                                        echo "<option style='margin-right:-10%;' value='".$formation['id_Formation']."'>".$formation['nom_Formation']."</option>";
                                    }
                                    echo "     
                                </select>                          
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
    }//ferme la fonction equipeAffichage

?>