<?php

include 'dataAccessCRUD/formations.php';
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
include_once("dataAccessCRUD/redirectionCookies.php");

$id=$_POST["bouttonPDF"];

$data = pdfFormations($id);

foreach ($data as $formation) {
    $variable = "<hr>
    <table class='table'>
    <tbody>
    
    <tr>
        <th scope='row'>Description de la formation</th>
        <td>".$formation['contenu_formation']."</td>
    </tr>
    <tr>
        <th scope='row'>Début de la formation</th>
        <td>".$formation['Date_formation']."</td>
    </tr>
    <tr>
        <th scope='row'>Nombre d'heures</th>
        <td>".$formation['Duree_formation']."</td>
    </tr>
    <tr>
        <th scope='row'>Nombre de jours de formation</th>
        <td>".$formation['NbrJour_formation']."</td>
    </tr>
    <tr>
        <th scope='row'>Lieu de formation</th>
        <td>".$formation['lieu_formation']."</td>
    </tr>
    <tr>
        <th scope='row'>Prérequis pour la formation</th>
        <td>".$formation['prerequis_formation']."</td>
    </tr>
    </tbody>
</table>
<hr>";

$nomFormation = $formation['nom_formation'];

}

$fuhrer = new Dompdf();
$fuhrer->loadHtml($variable);
$fuhrer->render();
$fuhrer->stream($nomFormation);

?>