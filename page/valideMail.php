<!-- Groupe N°032 -  Orlane GUILLET, Maxime ONILLON, Aline REBOUT, Achil MICHEL-->
<?php
require_once '../function/function.php';
require_once '../function/miseEnPage.php';

if (isset($_GET['idUser'])){
    $idUser = $_GET['idUser'];
    switchValideMail($idUser);
    $msg = 'Votre email a bien été validée ! Vous pouvez maintenant <a href="login.php">vous connecter</a> !';

} else{
    header('Location:accueil.php');
    die();
}


$titreOnglet = "Bactépédia - Valider votre adresse mail";
$titrePage = "Valider votre adresse mail";
require_once '../elements/header.php';
require_once '../elements/nav.php';

?>
<div class="contenu">

    <?php
    if (isset($msg)){
        echo message($msg, 'msg-success');
    }
    ?>




</div>

<?php
require_once '../elements/footer.php';
?>