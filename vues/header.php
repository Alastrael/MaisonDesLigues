<!-- Début du haut de page !-->
<div id="header" class="container-fluid center">
    <div class="row col-md-auto justify-content-center">
        <div class="col-md-3">
            <img src="assets\img\m2l.png" style="margin-left:1%; max-width: 100%;height: auto;" alt="Not found">
        </div>
        <div class="col-md-6 align-self-center">
                <h1 class="text-center">
                    <?php 
                        if($_COOKIE["nomPage"]=="index")echo "Vos Formations";
                        if($_COOKIE["nomPage"]=="offres")echo "Les offres de formations";
                        if($_COOKIE["nomPage"]=="historique")echo "Historique des formations";
                        if($_COOKIE["nomPage"]=="equipe")echo "Gestion de votre équipe";
                    ?>
                </h1>
        </div>
        <div class="row col-md-3" style="color:white;">
            <div style="margin-top:5%;margin-right:5%;">
                <button type="button" class="btn btn-primary btn-danger redButton" 
                onclick="deco()">Déconnexion</button>
            </div>
        </div>
        <div class="col-md-auto" style="color:white;text-align:center;">
            <p>    
                <?php
                    echo "Session de ".nomSalarie($_COOKIE["moncookie"]);
                ?>
            </p>
        </div> 
    </div>
</div>
<!-- Fin du haut de page !-->