<?php
require_once '../function/function.php';
require_once '../function/miseEnPage.php';
session_start();
if (isset($_POST['mail'])){
    $mailUser = $_POST['mail'];

    $infoUser = userExiste($mailUser);
    if ($infoUser !== null){
        $successMsg = "Un mail vient de vous être envoyé afin de réinitialiser votre mot de passe (voir pop-up)";
        $_SESSION['idNewPassword'] = $infoUser[0]['id_user'];
        echo openNewTab('mailNewPassword.php');

    } else {
        $errorMsg = "Cette adresse mail est reliée à aucun compte";
    }





}
session_write_close();

$titreOnglet = "Bactépédia - Changer son mot de passe";
$titrePage = "Réinitialiser son mot de passe";
require_once '../elements/header.php';
require_once '../elements/nav.php';

?>
    <div class="contenu">
        <div style="display:flex; justify-content: space-around">
            <img src="../style/img/favicon.svg" alt="" style="width: 25%;">

            <div style="display:flex;justify-content: center; margin: 50px 0px; width: 350px;">
                <form action="" method="POST">
                    <?php
                    // Affiche un message d'erreur si il est défini
                    if (isset($errorMsg)) {
                        echo message($errorMsg, "msg-error");
                    }
                    if (isset($successMsg)){
                        echo message($successMsg, "msg-success");
                    }
                    ?>
                    <input class="login-item" type="email" name="mail" placeholder="Adresse email" required>
                    <button class="login-item" type="submit">Réinitialiser son mot de passe</button>
                </form>
            </div>

            <img src="../style/img/favicon.svg" alt=""
                 style=" -webkit-transform: scaleX(-1); transform: scaleX(-1); width: 25%;">
        </div>


    </div>

<?php
require_once '../elements/footer.php';
?>