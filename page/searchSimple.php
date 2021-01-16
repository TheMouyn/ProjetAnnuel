<?php
$titreOnglet = "Bactépédia - Recherche";
$titrePage = "Faire une recherche";
require_once '../elements/header.php';
require_once '../elements/nav.php';
?>
    <div class="contenu">

        <div class="titreform">
            <a href="searchSimple.php"  class="titreindividuel"><span class="sousmenu active">Recherche simple</span></a>
            <a href="searchAvancee.php" class="titreindividuel"><span class="sousmenu">Recherche avancée</span></a>
        </div>


        <form action="" method="" class="formulaire">
            <input style="display: block; width: 80%;" type="text" placeholder="Rechercher par nom de genre ou d'espèce">
            <button style="display: block; margin-left: 5px;" type="submit"><img style="height: 20px" src="../style/img/search.svg" alt=""></button>
        </form>







    </div>
<?php
require_once '../elements/footer.php';
?>