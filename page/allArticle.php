<?php
$titreOnglet = "Bactépédia - Articles";
$titrePage = "Page d'Accueil - Tous les articles";
require_once '../elements/header.php';
require_once '../elements/nav.php';
require_once '../function/function.php';
require_once '../function/miseEnPage.php';

?>
<div class="contenu">
   <?php
   foreach (articleDESCall()as $article) {
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

</div>

<?php
require_once '../elements/footer.php';
?>
