<?php
$titreOnglet = "Bactépédia - Accueil";
$titrePage = "Page d'Accueil - Derniers articles";
require_once '../elements/header.php';
require_once '../elements/nav.php';
require_once '../function/function.php';
require_once '../function/miseEnPage.php';

?>
<div class="contenu">
   <?php
   foreach (articleDESC10()as $article) {
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
   ?>

   <?php
//    Ajout du bouton pour afficher tous les articles
   if(nbArtcile()>10){
       echo "<a href='allArticle.php' style='color: blue;'>Voir tous les articles </a>";
   }
   ?>
</div>

<?php
require_once '../elements/footer.php';
?>
