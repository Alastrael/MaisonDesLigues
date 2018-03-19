<?php
        include_once("barreNavigation.php");
    ?>
        <!-- Début du tableau des formations !-->
        <div id="landing" class="col-md-auto " style="width:100%;">
            <div id="formations" class="col-md-auto d-flex justify-content-center">
                <div class="list-group justifiy-content-between centered" style="width: 70%;">
                    <?php      
                        affichageFormations();
                    ?>
                </div>
            </div>
        </div>
 <!-- fin container!-->