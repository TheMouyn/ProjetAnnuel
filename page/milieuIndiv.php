<?php
require_once '../function/miseEnPage.php';
require_once '../function/function.php';

$milieuBDD = unMilieu($_SERVER['QUERY_STRING']);

if (!isset($milieuBDD[0])) {
   header('Location:errorMilieuIndiv.php');
   die();
}

$milieu = [
   'id' => $milieuBDD[0]['id_milieu'],
   'nature' => $milieuBDD[0]['nature_milieu'],
   'caracteristique' => [
      'empirique' => $milieuBDD[0]['empirique_milieu'],
      'synthetique' => $milieuBDD[0]['synthetique_milieu'],
      'semiSynthetique' => $milieuBDD[0]['semiSynthetique_milieu'],
      'ordinaire' => $milieuBDD[0]['ordinaire_milieu'],
      'enrichi' => $milieuBDD[0]['enrichi_milieu'],
      'oriantation' => $milieuBDD[0]['oriantation_milieu'],
      'isolement' => $milieuBDD[0]['isolement_milieu'],
      'identification' => $milieuBDD[0]['identification_milieu'],
      'enrichissement' => $milieuBDD[0]['enrichissement_milieu'],
      'conservation' => $milieuBDD[0]['conservation_milieu'],
   ],
   'composition' => $milieuBDD[0]['composition_milieu'],
   'utilisation' => $milieuBDD[0]['utilisation_milieu'],
   'lecture' => $milieuBDD[0]['lecture_milieu'],
   'lectureResultat' => $milieuBDD[0]['lectureResultat_milieu'],
   'cout' => $milieuBDD[0]['cout_milieu'],
   'etat' => $milieuBDD[0]['etat_milieu'],
   'photo' => $milieuBDD[0]['LienInterneImage_milieu'],

];


$titreOnglet = "Bactépédia - {$milieu['nature']} ";
$titrePage = "{$milieu['nature']}";
require_once '../elements/header.php';
require_once '../elements/nav.php';

?>
<div class="contenu">
    <img class="imgIndiv" src="../<?= $milieu['photo'] ?>" alt="Photo du milieu">

    <p>Nature du milieu : <?= $milieu['nature'] ?></p>

   <?php
   if ($milieu['composition'] !== null){
      echo "<p>Composition du milieu :  {$milieu['composition']}</p>";
   }
   ?>

    <?php
   if ($milieu['utilisation'] !== null){
      echo "<p>Utilisation du milieu : <br> {$milieu['utilisation']}</p>";
   }
   ?>

    <?php
   if ($milieu['lecture'] !== null){
      echo "<p>Lecture du milieu : <br> {$milieu['lecture']} </p>";
   }
   ?>



    <p>Caractéristique du milieu : </p>
    <table class="tableCarac">
        <thead>
        <tr>
            <td>Caractéristique</td>
            <td>Oui / Non</td>
        </tr>
        </thead>
        <tbody>
            <?php
            foreach ($milieu['caracteristique'] as $key => $value){
                $MPPkey = ucfirst($key);
                $MPPvalue = OuiNon($value);
                echo <<<HTML
                    <tr>
                    <td>$MPPkey</td>
                    <td>$MPPvalue</td>
                    </tr>
HTML;
            }
            ?>

        </tbody>
    </table>


   <?php
   if ($milieu['cout'] !== null){
      echo "    <p>Cout du milieu : {$milieu['cout']} €</p>";
   }
   ?>

    <p>Etat physique du milieu : <?= $milieu['etat'] ?></p>

   <?php
   // permet d'afficher les bactéries qui pousse sur ce milieu de culture si i y en a
   $bacteries = bacteriePourUnMilieu($milieu['id']);
   if (isset($bacteries[0])) :
      ?>
       <div>
           <p>Les bactéries suivante pousse sur ce milieu : </p>
           <ul>
              <?php
              foreach($bacteries as $bacterie){
                 $lien = 'bacIndiv.php?idBac=' . $bacterie['id_bacterie'];
                 echo "<li><a href='$lien'>{$bacterie['genre_bacterie']} {$bacterie['espece_bacterie']} {$bacterie['serovar_bacterie']}</a></li>";
              }
              ?>
           </ul>
       </div>
   <?php
   endif;
   ?>


   <?php
   // TODO: Lecture résultats
   ?>



    <!--    <pre>-->
<!--       --><?php
//       echo var_dump($milieuBDD);
//       ?>
<!--    </pre>-->


</div>
<?php
require_once '../elements/footer.php';
?>
