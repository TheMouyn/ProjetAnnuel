<?php
require_once '../function/miseEnPage.php';
require_once '../function/function.php';

$bacBDD = uneBacterie($_SERVER['QUERY_STRING']);

if (!isset($bacBDD[0])){
    header('Location:errorBacIndiv.php');
    die();
}

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
   'photo' => $bacBDD[0]['LienInterneImage_bacterie'],
   'visible' => $bacBDD[0]['visible_bacterie']
];

if($bacterie['visible'] == 0){
   header('Location:errorBacIndiv.php');
   die();
}


$nomBac = $bacterie['genre'] . ' ' . $bacterie['espece'];

$titreOnglet = "Bactépédia - $nomBac";
$titrePage = "$nomBac";
require_once '../elements/header.php';
require_once '../elements/nav.php';

?>
<div class="contenu">
    <img class="imgIndiv" src="../<?= $bacterie['photo'] ?>" alt="Photo microscope de la bactérie">

    <p>Nom genre : <?= $bacterie['genre'] ?></p>
    <p>Nom espèce : <?= $bacterie['espece'] ?></p>
   <?php
   if ($bacterie['serotype'] !== null){
       echo "<p>Sérotype : {$bacterie['serotype']}</p>";
   }
   ?>

    <p>Température optimale de culture : <?= $bacterie['forme'] ?></p>

    <p>Gram : <span style="<?php if ($bacterie['gram'] === 'Positif'){echo 'color: darkviolet;';}elseif($bacterie['gram'] === 'Negatif'){echo 'color: deeppink;';} ?>"><?= $bacterie['gram']?> </span></p>

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
   // permet d'afficher les symptômes provoquées si il y en a
   $symptomes = symptomePourUneBacterie($bacterie['id']);
   if (isset($symptomes[0])) :
      $listeSymptome = [];
      foreach ($symptomes as $symptome){
         $listeSymptome[] = $symptome['nom_symptome'];
      }
      ?>

       <p>
           Cette bactérie peut provoquer ces symptômes :
          <?php
          echo strtolower(implode(', ', $listeSymptome));
          ?>
       </p>
   <?php
   endif;
   ?>


   <?php
   // permet d'afficher les zones corps atteintes si il y en a
   $zones = zoneCorpsPourUneBacterie($bacterie['id']);
   if (isset($zones[0])) :
      $listeZone = [];
      foreach ($zones as $zone){
         $listeZone[] = $zone['nom_zoneCorps'];
      }
      ?>

       <p>
           Cette bactérie atteindre les zones du corps suivante :
          <?php
          echo strtolower(implode(', ', $listeZone));
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


   <?php
   // permet d'afficher les résistance de la bactérie si il y en a
   $resistances = resistancePourUneBacterie($bacterie['id']);
   if (isset($resistances[0])) :
      $listeResistance = [];
      foreach ($resistances as $resistance){
         $listeResistance[] = $resistance['nom_antibiotique'];
      }
      ?>

       <p>
           Cette bactérie on des résistances connus pour les antibiotiques suivant :
          <?php
          echo strtolower(implode(', ', $listeResistance));
          ?>
       </p>
   <?php
   endif;
   ?>

    <br>

   <?php
   // permet d'afficher les articles où la bactéries est citée si il y en a
   $articles = articlePourUneBacterie($bacterie['id']);
   if (isset($articles[0])) :
      echo "<p>Liste des articles où la bactérie est citée : </p>";

      foreach ($articles as $article) {
         $date = enDate($article['datePublication_article']);
         echo <<<HTML
        <div>
            <h4> {$article['titre_article']} </h4>
            <em> {$article['auteur_article']}  | Publié le $date</em>
            <p> {$article['extrait_article']} </p>
            <a href=" {$article['LienSource_article']}" target="_blank" style="color: blue;"> {$article['LienSource_article']} </a>
        </div>
        <br>
        <hr>

HTML;
      }
   endif;
   ?>


</div>
<?php
require_once '../elements/footer.php';
?>
