<?php /** @noinspection DuplicatedCode */
require_once '../function/function.php';
require_once '../function/miseEnPage.php';

session_start();

// on vérifie que l'utilisateur est bien admin
if ($_SESSION['estAdmin'] == 0) {
    // redirige vers l'accueil
    header('Location:accueil.php');
    die();
}
// si on est bien admin
$idBac = $_GET['idBac'] ?? null;
$bacBDD = uneBacterie($idBac);

if (!isset($bacBDD[0])) {
    header('Location:errorBacIndiv.php');
    die();
}

if (isset($idBac)) {

    $bacterie = [
        'id' => $bacBDD[0]['id_bacterie'],
        'genre' => $bacBDD[0]['genre_bacterie'],
        'espece' => $bacBDD[0]['espece_bacterie'],
        'serotype' => $bacBDD[0]['serovar_bacterie'],
        'photo' => $bacBDD[0]['LienInterneImage_bacterie'],
    ];


    // traitement de l'image
    if (isset($_FILES['photo']) and ($_FILES['photo']['error'] == 0)) {

        $nomFichier = $_FILES['photo']['name'];
        $typeFichier = $_FILES['photo']['type'];

        // on vérifie l'extension du fichier
        $extension = pathinfo($nomFichier, PATHINFO_EXTENSION);
        if ($extension !== 'jpg' AND $extension !== 'jpeg' AND $extension !== 'png') {
            $errorMsg = "Le fichier n'est pas dans une extension autorisé";
        }

        // on vérifie le type MIME du fichier
        if ($typeFichier == 'image/jpeg' OR $typeFichier == 'image/png' OR $typeFichier == 'image/jpeg') {
            // On supprime le fichier si il existe
            if($bacterie['photo'] !== null){
                $lienFichier = "../" . $bacterie['photo'];
                unlink($lienFichier);
            }
            // on déplace le fichier dans le dossier des photoBacterie
            // on créer le nom de fichier en lien avec l'id bacterie
            $nomFichier = 'photoBacterie' . $bacterie['id'] . '.' . $extension;

            move_uploaded_file($_FILES['photo']["tmp_name"], '../upload/photoBacterie/' . $nomFichier);
            $successMsg = "La photo sera mise à jour dans quelques instants.";
            ajoutphotoBacterieBDD($bacterie['id'], 'upload/photoBacterie/' . $nomFichier);


        } else {
            $errorMsg = "L'encodage du fichier n'est pas bon";
        }


    }


}


session_write_close();
$titreOnglet = "Bactépédia - Edition bactérie";
$titrePage = "Changer la photo d'une bactérie";
require_once '../elements/header.php';
require_once '../elements/nav.php';

?>
<div class="contenu">
    <?php
    // Affiche un message d'erreur si il est défini
    if (isset($errorMsg)) {
        echo message($errorMsg, "msg-error");
    } elseif (isset($successMsg)){
        echo message($successMsg, 'msg-success');
    }
    ?>


    <h3 style="margin: 30px 200px;"><?= $bacterie['genre'] ?> <?= $bacterie['espece'] ?> <?= $bacterie['serotype'] ?></h3>
    <div style="display:flex;">
        <img style="height: 200px;" src="../<?= $bacterie['photo'] ?>" alt="Photo de la bactérie">
        <form action="" method="post" enctype="multipart/form-data" style="margin: 0 20px;">
            <fieldset>
                <legend> Ajouter une nouvelle photo au format .jpg, .jpeg, .png : </legend>
                <input type="file" name="photo">
                <input type="submit" value="Enregistrer">
            </fieldset>
        </form>
    </div>




</div>

<?php
require_once '../elements/footer.php';
?>