<?php
require_once '../function/function.php';
require_once '../function/miseEnPage.php';

session_start();
// permet la redirection si on n'est pas connecté
if (!isset($_SESSION['idUser'])) {
    header('location:login.php');
}

// suppression en BDD du a savoir et redirection sur la même page
if (isset($_GET['toDel'])) {
    $toDel = (int)$_GET['toDel'];
    supprASavoir($_SESSION['idUser'], $toDel);
    header('Location:aSavoir.php');
    die();
}

// permet de changer d'état le boolean connnu
if (isset($_GET['switch'])) {
    $toDel = (int)$_GET['switch'];
    switchASavoir($_SESSION['idUser'], $toDel);
    header('Location:aSavoir.php');
    die();
}

session_write_close();

$titreOnglet = "Bactépédia - Mes favoris";
$titrePage = "Mes bactéries à savoir";
require_once '../elements/header.php';
require_once '../elements/nav.php';

?>
<div class="contenu">

    <table style="margin-left: 150px;">
        <?php
        $listeASavoir = aSavoirUser($_SESSION['idUser']);


        if (!empty($listeASavoir)) {
            foreach ($listeASavoir as $aSavoir) {
                $lienBac = "bacIndiv.php?idBac=" . $aSavoir['id_bacterie'];
                if ($aSavoir['connu_aSavoir'] == 0) {
                    $imageCoeur = '<img src="../style/img/coeurVide.svg" alt="logo coeur vide" style="width: 30px;">';
                } else {
                    $imageCoeur = '<img src="../style/img/coeurRouge.svg" alt="logo coeur vide" style="width: 30px;">';
                }

                echo <<<HTML
            <tr>
                <td style="padding: 20px;">
                    <a href="$lienBac">
                        <p> {$aSavoir['genre_bacterie']} {$aSavoir['espece_bacterie']} {$aSavoir['serovar_bacterie']}</p>
                    </a>
                </td>
                <td style="padding: 10px 20px;">
                    <a href="$lienBac">
                        <img style="height: 100px;" src="../{$aSavoir['LienInterneImage_bacterie']}" alt="photo de la bacterie">
                    </a>
                </td>
                
                <td>
                    <a href="aSavoir.php?switch={$aSavoir['id_bacterie']}">
                        $imageCoeur
                    </a>
                </td>
                
                <td style="padding-left: 30px">
                    <a href="aSavoir.php?toDel={$aSavoir['id_bacterie']}">
                        <img src="../style/img/delete.svg" alt="logo poubelle" style="width: 30px;">
                    </a>
                </td>
            </tr>
HTML;
            }
        }


        ?>
    </table>

    <?php
    if (empty($listeASavoir)){
        echo message("Vous n'avez aucunes bactéries dans vos à savoir", 'msg-error');
    }
    ?>

</div>

<?php
require_once '../elements/footer.php';
?>
