<?php
$titreOnglet = "Bactépédia - Mes favoris";
$titrePage = "Page d'Accueil - Mes favoris";
require_once '../elements/header.php';
require_once '../elements/nav.php';
require_once '../function/function.php';

// permet la redirection si on n'est pas connecté
session_start();
if (!isset($_SESSION['idUser'])) {
   header('location:login.php');
}

// suppression en BDD du favoris et redirection sur la même page
if (isset($_GET['toDel'])){
    $toDel = (int) $_GET['toDel'];
    suprFavoris($_SESSION['idUser'], $toDel);
    header('Location:favoris.php');
    die();
}

?>
<div class="contenu">

    <table style="margin-left: 150px;">
       <?php
       $listeFavoris = favorisUser($_SESSION['idUser']);


       foreach ($listeFavoris as $favoris) {
          if ($favoris['visible_bacterie'] == 1) {
             $lienBac = "bacIndiv.php?" . $favoris['id_bacterie'];
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

</div>

<?php
require_once '../elements/footer.php';
?>
