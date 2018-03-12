<!-- Début du haut de page !-->
<div id="header" class="container-fluid center">
    <div class="row">
        <div style="margin-left:1%;">
            <img src="assets\img\m2l.png" style="max-width: 85%;height: auto;" alt="Not found">
        </div>
        <div style="color:white;position: absolute;right:0;top:0">
            <div style="position:absolute;right:0;margin-top:5%;margin-right:5%;">
                <button type="button" style="background-color: rgba(223, 67, 56, 0.7);"  class="btn btn-danger" onclick="deco()">Déconnexion</button>
            </div>
            <div style="margin-top:30%; margin-right:5%">
                <p>    
                    <?php
                        echo "Session de ".nomSalarie($_COOKIE["moncookie"]);
                    ?>
                </p>
            </div> 
        </div>
    </div>
</div>
<!-- Fin du haut de page !-->