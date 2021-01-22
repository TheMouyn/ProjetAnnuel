<?php
$titreOnglet = "Bactépédia - Se connecter";
$titrePage = "Se connecter";
require_once '../elements/header.php';
require_once '../elements/nav.php';

?>
<div class="contenu">
    <div style="display:flex; justify-content: center">
        <img src="../style/img/favicon.svg" alt="">

        <!--TODO: Faire le script d'ouverture de session avec stockage des données dans session-->
        <div style="display:flex;justify-content: center; margin: 50px;">
            <form action="POST" method="script-login.php">
                <input class="login-item" type="email" placeholder="Adresse email">
                <br>
                <input class="login-item" type="password" placeholder="Mot de passe">
                <br>
                <button class="login-item" type="submit">Se connecter</button>

            </form>
        </div>

        <img src="../style/img/favicon.svg" alt="" style=" -webkit-transform: scaleX(-1); transform: scaleX(-1);">
    </div>


</div>

<?php
require_once '../elements/footer.php';
?>
