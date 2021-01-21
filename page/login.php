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
                <label for="mail">Votre mail : </label>
                <input style="height: 24px; margin: 5px 0px;" type="email" id="mail" placeholder="exemple@gmail.com">
                <br>
                <label for="mdp">Votre mot de passe : </label>
                <input style="height: 24px; margin: 5px 0px;" type="password" id="mdp" placeholder="mot de passe">
                <br>
                <button style="width: 350px; justify-items: center;" type="submit">Se connecter</button>

            </form>
        </div>

        <img src="../style/img/favicon.svg" alt="" style=" -webkit-transform: scaleX(-1); transform: scaleX(-1);">
    </div>


</div>

<?php
require_once '../elements/footer.php';
?>
