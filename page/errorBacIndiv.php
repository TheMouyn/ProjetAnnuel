<!-- Groupe N°032 -  Orlane GUILLET, Maxime ONILLON, Aline REBOUT, Achil MICHEL-->
<?php
$titreOnglet = "Bactépédia - Bactérie introuvable";
$titrePage = "Bactérie introuvable";
require_once '../elements/header.php';
require_once '../elements/nav.php';
require_once '../function/miseEnPage.php';

?>
<div class="contenu" style="display:flex; justify-content: center; flex-wrap: wrap">
    <h3>
       <?php
       echo message('La bactérie recherchée est invisible ou inexistante', 'msg-error');
       ?>
    </h3>

    <div style="width: 100%; display:flex; justify-content: center">
        <img src="../style/img/lostColor.svg" alt="bonhomme perdu" style="width: 400px;">
    </div>
</div>

<?php
require_once '../elements/footer.php';
?>
