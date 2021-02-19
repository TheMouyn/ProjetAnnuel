<?php
$titreOnglet = "Bactépédia - Ajout justificatif";
$titrePage = "Ajout du justificatif professionnel";
require_once '../elements/header.php';
require_once '../elements/nav.php';
require_once '../function/function.php';

//TODO: création du formulaire pour ajouter un justificatif
?>
<div class="contenu">
    <div style="display:flex; justify-content: space-around">
        <img src="../style/img/favicon.svg" alt="" style="width: 25%;">

        <div style="display:flex;justify-content: center; margin: 50px 0px; width: 350px;">
            <form action="" method="POST" enctype="multipart/form-data">
               <?php
               // Affiche un message d'erreur si il est défini
               if(isset($errorMsg)){
                  echo message($errorMsg, "msg-error");
               }
               ?>
                <label style="margin: 0 7px" for="fichier">Ajouter un justificatif (.pdf uniquement) :</label>
                <input class="form-item" type="file" name="fichier" id="fichier" required>
                <button class="login-item" type="submit">Envoyer le justificatif</button>
            </form>
        </div>

        <img src="../style/img/favicon.svg" alt="" style=" -webkit-transform: scaleX(-1); transform: scaleX(-1); width: 25%;">
    </div>


</div>

<?php
require_once '../elements/footer.php';
?>
