<?php
$titreOnglet = "Bactépédia - Créer un compte";
$titrePage = "Créer un compte";
require_once '../elements/header.php';
require_once '../elements/nav.php';

?>
<div class="contenu">
    <div style="display:flex; justify-content: space-around;">
        <img src="../style/img/favicon.svg" alt="" style="width: 25%;">

        <!--TODO: Faire le script de création de compte, génération mail-->
        <div style="display:flex;justify-content: center; margin: 50px 0px; width: 350px;">
            <form action="POST" method="script-login.php">
                <input class="login-item" type="text" placeholder="Prénom" autofocus>

                <input class="login-item" type="text" placeholder="Nom de famille">

                <div style="width: 100%; display:flex; align-items: center">
                    <label style="width: 50%; text-align: center;" for="ddn">Date de naissance : </label>
                    <input style="display: block; width: 50%;" type="date" id="ddn">
                </div>

                <input class="login-item" type="email" placeholder="Adresse email">

                <input class="login-item" type="password" placeholder="Mot de passe">

                <input class="login-item" type="password" placeholder="Confirmer le mot de passe">

                <div style="width: 100%; display:flex; align-items: center">
                    <label style="width: 50%; text-align: center;" for="photoUser">Photo utilisateur :</label>
                    <input style="display: block; width: 50%;" class="login-item" type="file" id="photoUser">
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
