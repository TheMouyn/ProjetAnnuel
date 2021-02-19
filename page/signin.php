<?php
require_once '../function/function.php';
require_once '../function/miseEnPage.php';


// on récupère les informations du formulaire
$prenomUser = $_POST['prenom'] ?? null;
$nomUser = $_POST['nom'] ?? null;
$ddnUser = $_POST['ddn'] ?? null;
$mailUser = $_POST['mail'] ?? null;
$passwordUser = $_POST['password'] ?? null;
$passwordConfirmUser = $_POST['confirmPassword'] ?? null;
$typeEtudeUser = $_POST['typeEtude'] ?? null;
$estProfessionnelUser = $_POST['professionnel'] ?? null;

if ($estProfessionnelUser == 'oui'){
    $estProfessionnelUser = 1;
} elseif ($estProfessionnelUser == 'non') {
    $estProfessionnelUser = 0;
}


if (isset($prenomUser, $nomUser, $ddnUser, $passwordUser, $passwordConfirmUser, $typeEtudeUser, $estProfessionnelUser)) {
   // Ici, toutes nos variables sont définies

   // on vérifie si les deux mdp sont les mêmes
   if ($passwordUser !== $passwordConfirmUser) {
      $errorMsg = 'Le mot de passe et la confirmation ne sont pas les mêmes';
   } elseif (userExiste($mailUser) !== null) {
      // On vérifie si l'adresse mail est déjà dans la bdd, on affiche un message d'erreur si vrai
      $errorMsg = 'Cette adresse mail est déjà associée à un compte, veuillez <a href="login.php">vous connecter</a>';
   } else {

      // redirection si est professionnel après insertion en bdd
      // TODO: génération du mail pour la vérification (cf mail Dominique GENIET)

      // ajout en base de donnée
      $bdd = connect();
      $ajout = $bdd->prepare('INSERT INTO bcp__user(nom_user, prenom_user, ddn_user, email_user, password_user, estProfessionnel_user, nom_typeEtude, emailValide_user) VALUES (:nom, :prenom, :ddn, :email, :mdp, :estPro, :typeEtude, 0);');
      $ajout->execute([
         'nom' => strtoupper($nomUser),
         'prenom' => ucfirst(strtolower($prenomUser)),
         'ddn' => $ddnUser,
         'email' => $mailUser,
         'mdp' => password_hash($passwordUser, PASSWORD_DEFAULT, ['cost' => 12]),
         'estPro' => $estProfessionnelUser,
         'typeEtude' => $typeEtudeUser
      ]);
      $successMsg = 'Votre compte à bien été créé, un mail vous a été envoyé pour valider votre compte';

      if ($estProfessionnelUser == 1){
          header('Location:ajoutJustificatif.php');
      }
    }
}


$titreOnglet = "Bactépédia - Créer un compte";
$titrePage = "Créer un compte";
require_once '../elements/header.php';
require_once '../elements/nav.php';
require_once '../function/miseEnPage.php';

?>
<div class="contenu">
    <div style="display:flex; justify-content: space-around;">
        <img src="../style/img/favicon.svg" alt="" style="width: 25%;">

        <div style="display:flex;justify-content: center; margin: 50px 0; width: 350px;">
            <form action="" method="POST">
               <?php
               // Affiche un message d'erreur si il est défini
               if (isset($errorMsg)) {
                  echo message($errorMsg, "msg-error");
               } elseif (isset($successMsg)){
                   echo message($successMsg, 'msg-success');
               }
               ?>

                <input class="login-item" type="text" name="prenom" placeholder="Prénom" required>

                <input class="login-item" type="text" name="nom" placeholder="Nom de famille" required>

                <div style="width: 100%; display:flex; align-items: center">
                    <label style="width: 50%; text-align: center;" for="ddn">Date de naissance : </label>
                    <input style="display: block; width: 50%;" name="ddn" type="date" id="ddn" required>
                </div>

                <input class="login-item" type="email" name="mail" placeholder="Adresse email" required>

                <input class="login-item" type="password" name="password" placeholder="Mot de passe" required>

                <input class="login-item" type="password" name="confirmPassword" placeholder="Confirmer le mot de passe"
                       required>

                <div style="width: 100%; display:flex; justify-content: center; margin: 15px 0;">
                    <label for="typeEtude" style="margin-right: 10px;">Vos études :</label>
                    <select name="typeEtude" id="typeEtude" required>
                        <option value="" selected disabled hidden>Non sélectionné</option>
                       <?php
                       foreach (typesEtude() as $type) {
                          echo "<option value=\"$type\">$type</option>";
                       }
                       ?>
                    </select>
                </div>

                <div style="text-align: center; margin: 7px 0;">
                    <p style="padding: 0; margin: 0;">Êtes-vous un professionnel ?</p>
                    <div style="display:flex; justify-content: space-around; margin: 7px 0;">
                        <div>
                            <input type="radio" name="professionnel" value="oui" id="oui" required>
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

        <img src="../style/img/favicon.svg" alt=""
             style=" -webkit-transform: scaleX(-1); transform: scaleX(-1); width: 25%;">
    </div>


</div>

<?php
require_once '../elements/footer.php';
?>
