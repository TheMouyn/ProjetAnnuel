<?php
$titreOnglet = "Bactépédia - Se connecter";
$titrePage = "Se connecter";
require_once '../elements/header.php';
require_once '../elements/nav.php';

?>
<div class="contenu">
    <div style="display:flex; justify-content: space-around">
        <img src="../style/img/favicon.svg" alt="">

        <!--TODO: Faire le script d'ouverture de session avec stockage des données dans session-->
        <div style="display:flex;justify-content: center; margin: 50px 0px; width: 350px;">
            <form action="POST" method="script-login.php">
                <input class="login-item" type="email" placeholder="Adresse email">
                <input class="login-item" type="password" placeholder="Mot de passe">
                <button class="login-item" type="submit">Se connecter</button>
                <p style="width: 100%; text-align: center; text-decoration: blue"><a href="signin.php">Se créer un compte</a></p>
            </form>
        </div>

        <img src="../style/img/favicon.svg" alt="" style=" -webkit-transform: scaleX(-1); transform: scaleX(-1);">
    </div>


</div>

<?php
require_once '../elements/footer.php';
?>
