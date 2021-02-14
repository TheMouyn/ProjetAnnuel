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
                <td>
                    <a href="$lienBac">
                        <p> {$favoris['genre_bacterie']} {$favoris['espece_bacterie']} {$favoris['serovar_bacterie']}</p>
                    </a>
                </td>
                <td>
                    <a href="$lienBac">
                        <img style="height: 100px;" src="../{$favoris['LienInterneImage_bacterie']}" alt="photo de la bacterie">
                    </a>
                </td>
            </tr>
HTML;
          }

       }


       ?>


</div>

<?php
require_once '../elements/footer.php';
?>
