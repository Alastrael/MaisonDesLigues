<!-- Début du menu -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Menu permettant de passer d'une page à l'autre -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link <?php if ($_COOKIE["nomPage"]=="index") echo "active"; ?>" href="index.php">Vos formations<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if ($_COOKIE["nomPage"]=="offres") echo "active"; ?>" href="offres.php">Offres de formation</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if ($_COOKIE["nomPage"]=="historique") echo "active"; ?>" href="historique_des_formations.php">Historique des formations</a>
                </li>
                <li class="nav-item">
                    <?php if(chef($_COOKIE["moncookie"]))echo "<a class='nav-item'><a class='nav-link ".(($_COOKIE['nomPage']=='equipe') ? 'active' : '')."' href='equipe.php'>Votre équipe</a>"?>
                </li>
            </ul>
        </div>
    </nav>
<!-- Fin du menu !-->
