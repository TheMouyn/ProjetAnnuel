<?php
require_once '../function/function.php';
require_once '../function/miseEnPage.php';

session_start();
if (isset($_SESSION['idNewPassword'])) {
    $idUser = $_SESSION['idNewPassword'];
    $infoUser = userIdExiste($idUser);
    $user = [
        'id' => $infoUser[0]['id_user'],
        'nom' => $infoUser[0]['nom_user'],
        'prenom' => $infoUser[0]['prenom_user'],
    ];
    // Doit être optimisé pour la sécurité car id user en GET !
    $lien = "newPassword.php?idUser={$user['id']}";
} else {
    header('Location:accueil.php');
    die();
}

session_write_close();
?>
<html lang="fr">
<head>
    <link rel="icon" href="../style/img/favicon.svg">
    <meta charset="UTF-8">
    <title>Votre mail</title>
</head>
<body>

<h1>Voici le mail que vous auriez du recevoir</h1>

<img src="../style/img/logo.svg" alt="logo du site" style="width: 500px;">

<p>Bonjour <?= $user['prenom'] ?> <?= $user['nom'] ?></p>
<p>Vous avez fait une demande de réinitialisation de mot de passe.</p>
<p>Vous pouvez dès à présent changer votre mot de passe grâce à
<a href="<?= $lien ?>" target="_blank">ce lien.</a>
</p>

<br><br>
<p>Bonne fin de journée</p>
<p>Bien cordialement,</p>
<br>
<p>L'équipe de Bactépédia</p>

</body>
</html>