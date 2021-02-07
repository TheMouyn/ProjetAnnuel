<?php
$titreOnglet = "Bactépédia - Créer un compte";
$titrePage = "Créer un compte";
require_once '../elements/header.php';
require_once '../elements/nav.php';
require_once '../function/miseEnPage.php';

?>
<div class="contenu">
    <div style="display:flex; justify-content: space-around;">
        <img src="../style/img/favicon.svg" alt="" style="width: 25%;">

        <!--TODO: Faire le script de création de compte, génération mail-->
        <div style="display:flex;justify-content: center; margin: 50px 0; width: 350px;">
            <form action="" method="POST">
                <input class="login-item" type="text" name="prenom" placeholder="Prénom" required>

                <input class="login-item" type="text" name="nom" placeholder="Nom de famille" required>

                <div style="width: 100%; display:flex; align-items: center">
                    <label style="width: 50%; text-align: center;" for="ddn">Date de naissance : </label>
                    <input style="display: block; width: 50%;" name="ddn" type="date" id="ddn" required>
                </div>

                <input class="login-item" type="email" name="mail" placeholder="Adresse email" required>

                <input class="login-item" type="password" name="password" placeholder="Mot de passe" required>

                <input class="login-item" type="password" name="confirmPassword" placeholder="Confirmer le mot de passe" required>

                <div style="width: 100%; display:flex; justify-content: center; flex-wrap: wrap;">
                    <label style="width: 100%; text-align: center" for="photoUser">Photo utilisateur (.jepg, .jpg, .png) :</label>
                    <input style="display: block; width: 100%;" name="photo" class="login-item" type="file" id="photoUser">
                </div>

                <div style="text-align: center; margin: 7px 0;">
                <p style="padding: 0; margin: 0;">Êtes-vous un professionnel ?</p>
                    <div style="display:flex; justify-content: space-around; margin: 7px 0;">
                        <div>
                            <input type="radio" name="professionnel" value="oui" id="oui">
                            <label for="oui">Oui</label>
                        </div>
                        <div>
                            <input type="radio" name="professionnel" value="non" id="non">
                            <label for="non">Non</label>
                        </div>
                    </div>
                </div>

                <button class="login-item" type="submit">Se créer un compte</button>

            </form>
        </div>

        <img src="../style/img/favicon.svg" alt="" style=" -webkit-transform: scaleX(-1); transform: scaleX(-1); width: 25%;">
    </div>


</div>

<?php
require_once '../elements/footer.php';
?>
