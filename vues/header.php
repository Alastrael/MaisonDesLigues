<!-- Début du haut de page !-->
<div id="header" class="container-fluid center">
    <div class="row col-md-auto">
        <div class="col-md-3">
            <img src="assets\img\m2l.png" style="margin-left:1%; max-width: 100%;height: auto;" alt="Not found">
        </div>
        <div class="col-md-7">
            <h1>
                <?php echo $_COOKIE["nomPage"]; ?>
            </h1>
        </div>
        <div class="row col-md-2" style="color:white;">
            <div style="margin-top:5%;margin-right:5%;">
                <button type="button" style="background-color: rgba(223, 67, 56, 0.7);" 
                class="btn btn-danger" onclick="deco()">Déconnexion</button>
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