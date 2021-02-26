<?php
require_once '../function/function.php';
require_once '../function/miseEnPage.php';
session_start();
$mailUser = $_SESSION['mailCreaUser'] ?? null;

if (isset($_FILES['fichier'], $mailUser) and ($_FILES['fichier']['error'] == 0)) {
   $nomFichier = $_FILES['fichier']['name'];
   $typeFichier = $_FILES['fichier']['type'];

   // on vérifie l'extension du fichier
   $extension = pathinfo($nomFichier, PATHINFO_EXTENSION);
   if ($extension !== 'pdf') {
      $errorMsg = "Le fichier n'est pas un pdf";
   }

   // on vérifie le type MIME du fichier
   if ($typeFichier == 'application/pdf') {
      // on déplace le fichier dans le dossier des justificatif
      $infoUser = userExiste($mailUser);
      // on créer le nom de fichier en lien avec l'id user
      $nomFichier = 'Justificatif' . $infoUser[0]['id_user'] . '.pdf';

      // on vérifie si le fichier existe déjà
      if (file_exists('../upload/justificatif/' . $nomFichier)) {
         $errorMsg = "Le fichier existe déjà, veuillez contacter un administrateur";
      } else {
         move_uploaded_file($_FILES["fichier"]["tmp_name"], '../upload/justificatif/' . $nomFichier);
         $successMsg = "Votre justificatif à été enregistré, il sera traité dans les meilleurs délais. Veuillez valider votre compte grâce au mail que vous avez reçu (voir pop-up).";
          ajoutJustifBDD($mailUser, '/upload/justificatif/' . $nomFichier);
          echo openNewTab('mailValideMail.php');
      }
   } else {
      $errorMsg = "Le fichier n'est pas un pdf";
   }


}
session_write_close();

$titreOnglet = "Bactépédia - Ajout justificatif";
$titrePage = "Ajout du justificatif professionnel";
require_once '../elements/header.php';
require_once '../elements/nav.php';

?>
<div class="contenu">
    <div style="display:flex; justify-content: space-around">
        <img src="../style/img/favicon.svg" alt="" style="width: 25%;">

        <div style="display:flex;justify-content: center; margin: 50px 0px; width: 350px;">
            <form action="" method="POST" enctype="multipart/form-data">
               <?php
               // Affiche un message d'erreur si il est défini
               if (isset($errorMsg)) {
                  echo message($errorMsg, "msg-error");
               } elseif (isset($successMsg)) {
                  echo message($successMsg, 'msg-success');
               }
               ?>
                <label style="margin: 0 7px" for="fichier">Ajouter un justificatif (.pdf uniquement) :</label>
                <input class="form-item" type="file" name="fichier" id="fichier" required>
                <button class="login-item" type="submit">Envoyer le justificatif</button>
            </form>
        </div>

        <img src="../style/img/favicon.svg" alt=""
             style=" -webkit-transform: scaleX(-1); transform: scaleX(-1); width: 25%;">
    </div>


</div>

<?php
require_once '../elements/footer.php';
?>
