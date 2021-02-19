<?php
require_once '../function/function.php';
require_once '../function/miseEnPage.php';

if(!empty($_POST)) {
    $mailUser = $_POST['mail'] ?? null;
    $passwordUser = $_POST['password'] ?? null;

    // mail existe dans la bdd : revois null ou le tableau avec les informations
   $infoUser = userExiste($mailUser);

   if ($infoUser == null) {
      $errorMsg = "Ce compte n'existe pas";
   } else {
       if (password_verify($passwordUser, $infoUser[0]['password_user'])){
           // début de session
          if($infoUser[0]['emailValide_user'] == 1) {
             session_start();
             $_SESSION['idUser'] = $infoUser[0]['id_user'];
             $_SESSION['estAdmin'] = $infoUser[0]['estProfessionnel_user'];
             $_SESSION['photo'] = $infoUser[0]['lienInternePhoto_user'];
             $_SESSION['nom'] = $infoUser[0]['nom_user'];
             $_SESSION['prenom'] = $infoUser[0]['prenom_user'];
             header('location:accueil.php');
          } else {
              $errorMsg = "Votre email n'a pas été validée, veuillez le valider puis vous connecter";
          }
       } else {
           $errorMsg = "Mot de passe faux";
       }
   }

}
$titreOnglet = "Bactépédia - Se connecter";
$titrePage = "Se connecter";
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
               if(isset($errorMsg)){
                  echo message($errorMsg, "msg-error");
               }
               ?>
                <input class="login-item" type="email" name="mail" placeholder="Adresse email" required <?php if (isset($mailUser)){echo "value=\"$mailUser\"";} ?>>
                <input class="login-item" type="password" name="password" placeholder="Mot de passe" required>
                <button class="login-item" type="submit">Se connecter</button>
                <p style="width: 100%; text-align: center; text-decoration: blue"><a href="signin.php">Se créer un compte</a></p>
            </form>
        </div>

        <img src="../style/img/favicon.svg" alt="" style=" -webkit-transform: scaleX(-1); transform: scaleX(-1); width: 25%;">
    </div>


</div>

<?php
require_once '../elements/footer.php';
?>
