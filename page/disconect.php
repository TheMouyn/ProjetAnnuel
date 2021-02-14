<?php

if (isset($_SESSION['idUser'])){
    // suppression de session propre
    $_SESSION = [];
    session_destroy();
    unset($_SESSION);
} else {
    header('location:accueil.php');
}


$titreOnglet = "Bactépédia - Déconnexion";
$titrePage = "Page d'Accueil - Déconnexion";
require_once '../elements/header.php';
require_once '../elements/nav.php';
require_once '../function/function.php';
require_once '../function/miseEnPage.php';

?>
<div class="contenu">

   <?php
   echo message("Vous avez été bien déconnecté", "msg-success");
   ?>
    <p>Vous pouvez retourner à l'accueil grâce au bouton sur la gauche</p>

</div>

<?php
require_once '../elements/footer.php';
?>
