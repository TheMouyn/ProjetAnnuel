<?php
$titreOnglet = "Bactépédia - Bactérie introuvable";
$titrePage = "Page d'Accueil - Bactérie introuvable";
require_once '../elements/header.php';
require_once '../elements/nav.php';
require_once '../function/miseEnPage.php';

?>
<div class="contenu" style="display:flex; justify-content: center; flex-wrap: wrap">
    <h3>
       <?php
       echo message('Le milieu recherché est inexistant', 'msg-error');
       ?>
    </h3>

    <div style="width: 100%; display:flex; justify-content: center">
        <img src="../style/img/lostColor.svg" alt="bonhomme perdu" style="width: 400px;">
    </div>
</div>

<?php
require_once '../elements/footer.php';
?>
