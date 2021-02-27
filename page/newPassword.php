<?php
require_once '../function/function.php';
require_once '../function/miseEnPage.php';

if (isset($_GET['idUser'])) {
    // Doit être optimisé pour la sécurité car id user en GET !
    $idUser = $_GET['idUser'];
    $passUser = $_POST['password'] ?? null;
    $confirmPassUser = $_POST['confirmPassword'] ?? null;

    if (isset($passUser, $confirmPassUser)){
        if ($passUser == $confirmPassUser){
            updatePassword(password_hash($passUser, PASSWORD_DEFAULT, ['cost'=>12]), $idUser);
            $successMsg = "Votre mot de passe a bien été mis à jour, vous pouvez dès à présent <a href=\"login.php\">vous connecter</a>";

        } else {
            $errorMsg = "Le mot de passe et la confirmation ne sont pas les mêmes";
        }

    }


} else {
    $errorMsg = "Le lien n'est pas conforme, veuillez contacter l'administrateur";
}


$titreOnglet = "Bactépédia - Changer son mot de passe";
$titrePage = "Changer son mot de passe";
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
                    <input class="login-item" type="password" name="password" placeholder="Nouveau mot de passe" required>
                    <input class="login-item" type="password" name="confirmPassword" placeholder="Confirmation de mot de passe"
                           required>
                    <button class="login-item" type="submit">Modifier mon mot de passe</button>
                </form>
            </div>

            <img src="../style/img/favicon.svg" alt=""
                 style=" -webkit-transform: scaleX(-1); transform: scaleX(-1); width: 25%;">
        </div>


    </div>

<?php
require_once '../elements/footer.php';
?>