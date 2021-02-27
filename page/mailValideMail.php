<?php
require_once '../function/function.php';
require_once '../function/miseEnPage.php';

session_start();
if (isset($_SESSION['mailCreaUser'])) {
    $mailUser = $_SESSION['mailCreaUser'];
    $infoUser = userExiste($mailUser);
    $user = [
        'id' => $infoUser[0]['id_user'],
        'nom' => $infoUser[0]['nom_user'],
        'prenom' => $infoUser[0]['prenom_user'],
        'ddn' => $infoUser[0]['ddn_user'],
        'mail' => $infoUser[0]['email_user'],
        'estPro' => $infoUser[0]['estProfessionnel_user'],
        'etude' => $infoUser[0]['nom_typeEtude'],
        'justif' => $infoUser[0]['lienInterneJustificatif_user']
    ];
    $lien = "valideMail.php?idUser={$user['id']}";
} else {
    header('Location:accueil.php');
    die();
}

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
<p>
    Vous vous êtes inscrit sur le site Bactépédia en tant
    <?php
    if ($user['estPro'] == 1){
        echo 'professionnel';
    } else {
        echo 'utilisateur';
    }
    ?>
    .
</p>
<p>Nous vous en remercions. Afin de vous connecter, il faut valider votre adresse email via
<a href="<?= $lien ?>">ce lien.</a>
</p>

<br><br>
<p>Bonne fin de journée</p>
<p>Bien cordialement,</p>
<br>
<p>L'équipe de Bactépédia</p>

</body>
</html>