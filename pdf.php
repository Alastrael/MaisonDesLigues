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
                <td>".$formation['contenu_Formation']."</td>
            </tr>
            <tr>
                <th scope='row'>Début de la formation</th>
                <td>".$formation['datedebut_Formation']."</td>
            </tr>
            <tr>
                <th scope='row'>Nombre d'heures</th>
                <td>".$formation['nbrheures_Formation']."</td>
            </tr>
            <tr>
                <th scope='row'>Nombre de jours de formation</th>
                <td>".$formation['nbrJour_Formation']."</td>
            </tr>
            <tr>
                <th scope='row'>Lieu de formation</th>
                <td>".$formation['lieu_Formation']."</td>
            </tr>
            <tr>
                <th scope='row'>Prérequis pour la formation</th>
                <td>".$formation['prerequis_Formation']."</td>
            </tr>
            <tr>
                <th scope='row'>Prestataire pour la formation</th>
                <td>".$formation['prestataire_Formation']."</td>
            </tr>
            </tbody>
        </table>
        <hr>";
        $nomFormation = $formation['nom_Formation'];
    }
    $pdf = new Dompdf();
    $pdf->loadHtml($variable);
    $pdf->render();
    $pdf->stream($nomFormation);
?>