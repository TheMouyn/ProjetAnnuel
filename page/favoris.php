<!-- Groupe N°032 -  Orlane GUILLET, Maxime ONILLON, Aline REBOUT, Achil MICHEL-->
<?php
require_once '../function/function.php';
require_once '../function/miseEnPage.php';

session_start();
// permet la redirection si on n'est pas connecté
if (!isset($_SESSION['idUser'])) {
    header('location:login.php');
}

// suppression en BDD du favoris et redirection sur la même page
if (isset($_GET['toDel'])) {
    $toDel = (int)$_GET['toDel'];
    supprFavoris($_SESSION['idUser'], $toDel);
    header('Location:favoris.php');
    die();
}
session_write_close();

$titreOnglet = "Bactépédia - Mes favoris";
$titrePage = "Mes favoris";
require_once '../elements/header.php';
require_once '../elements/nav.php';

?>
<div class="contenu">

    <table style="margin-left: 150px;">
        <?php
        $listeFavoris = favorisUser($_SESSION['idUser']);


        if (!empty($listeFavoris)) {
            foreach ($listeFavoris as $favoris) {
                $lienBac = "bacIndiv.php?idBac=" . $favoris['id_bacterie'];
                echo <<<HTML
            <tr>
                <td style="padding: 20px;">
                    <a href="$lienBac">
                        <p> {$favoris['genre_bacterie']} {$favoris['espece_bacterie']} {$favoris['serovar_bacterie']}</p>
                    </a>
                </td>
                <td style="padding: 10px 20px;">
                    <a href="$lienBac">
                        <img style="height: 100px;" src="../{$favoris['LienInterneImage_bacterie']}" alt="photo de la bacterie">
                    </a>
                </td>
                <td>
                    <a href="favoris.php?toDel={$favoris['id_bacterie']}">
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
    if (empty($listeFavoris)){
        echo message("Vous n'avez aucunes bactéries en favoris", 'msg-error');
    }
    ?>

</div>

<?php
require_once '../elements/footer.php';
?>
