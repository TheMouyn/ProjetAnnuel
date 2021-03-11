<?php /** @noinspection DuplicatedCode */
require_once '../function/function.php';
require_once '../function/miseEnPage.php';
session_start();


if (isset($_SESSION['idUser'])){
    $infoUser = userIdExiste($_SESSION['idUser']);

    // traitement de l'image
    if (isset($_FILES['photo']) and ($_FILES['photo']['error'] == 0)) {

        $nomFichier = $_FILES['photo']['name'];
        $typeFichier = $_FILES['photo']['type'];

        // on vérifie l'extension du fichier
        $extension = pathinfo($nomFichier, PATHINFO_EXTENSION);
        if ($extension !== 'jpg' AND $extension !== 'jpeg' AND $extension !== 'png') {
            $errorMsg = "Le fichier n'est pas dans une extension autorisé";
        }

        // on vérifie le type MIME du fichier
        if ($typeFichier == 'image/jpeg' OR $typeFichier == 'image/png' OR $typeFichier == 'image/jpeg') {
            // On supprime le fichier si il existe
            if($infoUser[0]['lienInternePhoto_user'] !== null){
                $lienFichier = "../" . $infoUser[0]['lienInternePhoto_user'];
                unlink($lienFichier);
            }
            // on déplace le fichier dans le dossier des photoUser
            // on créer le nom de fichier en lien avec l'id user
            $nomFichier = 'photoUser' . $infoUser[0]['id_user'] . '.' . $extension;

            move_uploaded_file($_FILES['photo']["tmp_name"], '../upload/photoUser/' . $nomFichier);
            $successMsg = "Votre photo sera mise à jour à votre prochaine connexion.";
            ajoutphotoProfilBDD($infoUser[0]['id_user'], 'upload/photoUser/' . $nomFichier);


        } else {
            $errorMsg = "L'encodage du fichier n'est pas bon";
        }


    }






} else {
    header('Location:login.php');
}

session_write_close();
$titreOnglet = "Bactépédia - Mon compte";
$titrePage = "Mon compte";
require_once '../elements/header.php';
require_once '../elements/nav.php';

?>
<div class="contenu">
    <?php
    // Affiche un message d'erreur si il est défini
    if (isset($errorMsg)) {
        echo message($errorMsg, "msg-error");
    } elseif (isset($successMsg)) {
        echo message($successMsg, 'msg-success');
    }
    ?>
<div style="display:flex;">
    <div style="display:flex; width: 50%; flex-wrap: wrap;">
        <p style="margin: 20px; text-decoration: underline;">Changer votre photo de profil : </p>
        <?php
        if ($infoUser[0]['lienInternePhoto_user'] !== null)
            echo "<img src=\"../{$infoUser[0]['lienInternePhoto_user']}\" alt=\"Photo utilisateur\" style='max-width: 200px'>";
        ?>
        <form action="" method="post" enctype="multipart/form-data" style="margin: 20px 0; text-align: center;">
            <fieldset>
                <legend> Ajouter une nouvelle photo au format .jpg, .jpeg, .png : </legend>
                <input type="file" name="photo">
                <input type="submit" value="Enregistrer">
            </fieldset>
        </form>
    </div>


    <div style="width: 50%;">
        <p>Réinitialiser votre mot de passe : <a href="askNewPassword.php">cliquer ici</a> </p>
    </div>
</div>



</div>

<?php
require_once '../elements/footer.php';
?>