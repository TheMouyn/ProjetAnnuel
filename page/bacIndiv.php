<?php
require_once '../function/miseEnPage.php';
require_once '../function/function.php';

$bacBDD = uneBacterie($_GET['idBac']);

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

session_start();

if (isset($_GET['switchFavoris'], $_SESSION['idUser'])) {
    if ($_GET['switchFavoris'] == 1) {
        //si switchFavoris = 1 -> la bactérie est dans la liste de favoris, il faut donc la retirer
        supprFavoris($_SESSION['idUser'], $bacterie['id']);
        header("Location:bacIndiv.php?idBac={$bacterie['id']}");
        die();
    } else {
        //si switchFavoris = 0 -> la bactérie n'est pas dans la liste de favoris, il faut donc l'ajouter
        addFavoris($_SESSION['idUser'], $bacterie['id']);
        header("Location:bacIndiv.php?idBac={$bacterie['id']}");
        die();

    }
}

if (isset($_GET['addSupprASavoir'], $_SESSION['idUser'])) {
    if ($_GET['addSupprASavoir'] == 0){
        // il faut ajouter dans la table des a savoir la bactérie
        addASavoir($_SESSION['idUser'], $bacterie['id']);
        header("Location:bacIndiv.php?idBac={$bacterie['id']}");
        die();
    } elseif ($_GET['addSupprASavoir'] == 1){
        supprASavoir($_SESSION['idUser'], $bacterie['id']);
        header("Location:bacIndiv.php?idBac={$bacterie['id']}");
        die();
    }
}

if (isset($_GET['switchASavoir'], $_SESSION['idUser'])) {
    if (($_GET['switchASavoir'] == 1) OR ($_GET['switchASavoir'] == 2)){
        // si la bactérie est connu switchASavoir = 2 -> alors il faut inverser le boolean
        // si la bactérie n'est pas connu switchASavoir = 1 -> alors il faut inverser le boolean
        switchASavoir($_SESSION['idUser'], $bacterie['id']);
        header("Location:bacIndiv.php?idBac={$bacterie['id']}");
        die();
    }


}
session_write_close();


$nomBac = $bacterie['genre'] . ' ' . $bacterie['espece'] . ' ' . $bacterie['serotype'];

$titreOnglet = "Bactépédia - $nomBac";
$titrePage = "$nomBac";
require_once '../elements/header.php';
require_once '../elements/nav.php';
session_start();
?>
<div class="contenu">
    <div style="float: right; margin-bottom: 20px; display:flex;">
        <?php
        // les bouton d'action si on est connecté
        if (isset($_SESSION['idUser'])){
            // si l'utilisateur n'est pas admin -> favoris (jaune/blanc), asavoir(rouge/blanc)
            $estFav = estFavoris($_SESSION['idUser'], $bacterie['id']);
            if ($estFav){
                $imageFavoris = '<img src="../style/img/favorisJaune.svg" alt="étoile jaune" class="boutonBacIndiv">';
            } else {
                $imageFavoris = '<img src="../style/img/favoris.svg" alt="étoile vide" class="boutonBacIndiv">';
            }
            echo "<a href=\"bacIndiv.php?idBac={$bacterie['id']}&switchFavoris=$estFav\">$imageFavoris</a> ";

            // coeurPlus puis coeurDelete + coeur rouge/blanc
            $estASavoir = estASavoir($_SESSION['idUser'], $bacterie['id']);

            if ($estASavoir == 0){
                // pour ajouter dans la table
                echo "<a href=\"bacIndiv.php?idBac={$bacterie['id']}&addSupprASavoir=0\"><img src='../style/img/coeurPlus.svg' alt='logo coeur plus' class=\"boutonBacIndiv\"></a>";
            } elseif ($estASavoir == 1) {
                // pour supprimer dans la table et modifier le boolean connu
                echo "<a href=\"bacIndiv.php?idBac={$bacterie['id']}&addSupprASavoir=1\"><img src='../style/img/coeurDelete.svg' alt='logo coeur poubelle' class=\"boutonBacIndiv\"></a>";
                echo "<a href=\"bacIndiv.php?idBac={$bacterie['id']}&switchASavoir=$estASavoir\"><img src='../style/img/coeurVide.svg' alt='logo coeur' class=\"boutonBacIndiv\"></a>";
            } elseif ($estASavoir == 2) {
                // pour supprimer dans la table et modifier le boolean connu
                echo "<a href=\"bacIndiv.php?idBac={$bacterie['id']}&addSupprASavoir=1\"><img src='../style/img/coeurDelete.svg' alt='logo coeur poubelle' class=\"boutonBacIndiv\"></a>";
                echo "<a href=\"bacIndiv.php?idBac={$bacterie['id']}&switchASavoir=$estASavoir\"><img src='../style/img/coeurRouge.svg' alt='logo coeur rouge' class=\"boutonBacIndiv\"></a>";
            }

            if ($_SESSION['estAdmin'] == 1){
                // affiche un lien crayon vers l'édition de bactérie
                echo "<a href=\"\"><img src='../style/img/crayon.svg' alt='logo crayon' style=\"width: 50px; margin: 0px 10px;\"></a>";
            }
        }
        ?>
    </div>
    <div style="clear: both;"></div>


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
                   $lien = 'milieuIndiv.php' . '?' . $milieu['id_milieu'];
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
