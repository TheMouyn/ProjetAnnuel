<?php
// TODO : Vérification de la visibilité de la bactérie
// TODO: Ajout des différentes relation direct : milieu, article, maladie, symptôme, zone corps, résistance,
require_once '../function/miseEnPage.php';
require_once '../function/function.php';

$bacBDD = uneBacterie($_SERVER['QUERY_STRING']);

$bacterie = [
   'id' => $bacBDD[0]['id_bacterie'],
   'genre' => $bacBDD[0]['genre_bacterie'],
   'espece' => $bacBDD[0]['espece_bacterie'],
   'serotype' => $bacBDD[0]['serovar_bacterie'],
   'gram' => $bacBDD[0]['gram_bacterie'],
   'forme' => $bacBDD[0]['nom_forme'],
   'nbConsultation' => $bacBDD[0]['nbConsultation_bacterie'],
   'nbModification' => $bacBDD[0]['nbModification_bacterie'],
   'nbRecherche' => $bacBDD[0]['nbRecherche_bacterie'],
   'dateDerniereModif' => enDateHeure($bacBDD[0]['dateModif_bacterie']),
   'temperature' => $bacBDD[0]['temperatureOptimale_bacterie'],
   'prophylaxie' => $bacBDD[0]['prophylaxie_bacterie'],
   'photo' => $bacBDD[0]['LienInterneImage_bacterie']
];


$nomBac = $bacterie['genre'] . ' ' . $bacterie['espece'];

$titreOnglet = "Bactépédia - $nomBac";
$titrePage = "$nomBac";
require_once '../elements/header.php';
require_once '../elements/nav.php';

?>
<div class="contenu">
    <img class="imgBacIndiv" src="../<?= $bacterie['photo'] ?>" alt="Photo microscope escherichia coli">

    <p>Nom genre : <?= $bacterie['genre'] ?></p>
    <p>Nom espèce : <?= $bacterie['espece'] ?></p>
   <?php
   if ($bacterie['serotype'] !== null){
       echo "<p>Sérotype : {$bacterie['serotype']}</p>";
   }
   ?>

    <p>Température optimale de culture : <?= $bacterie['forme'] ?></p>

    <p>Gram : <span style="<?php if ($bacterie['gram'] === 'Positif'){echo 'color: darkviolet;';}else{echo 'color: deeppink;';} ?>"><?= $bacterie['gram']?> </span></p>

    <p>Température optimale de culture : <?= $bacterie['temperature'] ?> °C</p>

    <p>Nombre de consultation : <?= $bacterie['nbConsultation'] ?> </p>

    <p>Nombre de modification : <?= $bacterie['nbModification'] ?> </p>
    <p>Date de dernière modification : <?= $bacterie['dateDerniereModif'] ?> </p>

    <p>Nombre de recherche : <?= $bacterie['nbRecherche'] ?> </p>

   <?php
   if ($bacterie['prophylaxie'] !== null){
      echo "<p>Prophylaxie : <br> {$bacterie['prophylaxie']} </p>";
   }
   ?>


   <?php
   // permet d'afficher les maladies provoquées si il y en a
   $maladies = maladiePourUneBacterie($bacterie['id']);
   if (isset($maladies[0])) :
      $listeMaladie = [];
      foreach ($maladies as $maladie){
          $listeMaladie[] = $maladie['nom_maladie'];
      }
   ?>

   <p>
       Cette bactérie peut provoquer :
      <?php
      echo strtolower(implode(', ', $listeMaladie));
      ?>
   </p>
   <?php
    endif;
    ?>



    <?php
    // permet d'afficher les milieux de culture uniquement si il y en a
    $milieux = milieuPourUneBacterie($bacterie['id']);
    if (isset($milieux[0])) :
    ?>
        <div>
            <p>Milieux sur lesquels cette bactérie pousse :</p>
            <ul>
               <?php
               foreach($milieux as $milieu){
                   $lien = '../milieuIndiv' . '?' . $milieu['id_milieu'];
                   echo "<li><a href='$lien'>{$milieu['nature_milieu']}</a></li>";
               }
               ?>
            </ul>
        </div>
   <?php
   endif;
   ?>


    <pre>
       <?php
       echo var_dump(maladiePourUneBacterie($bacterie['id']));
       ?>
    </pre>


</div>
<?php
require_once '../elements/footer.php';
?>
