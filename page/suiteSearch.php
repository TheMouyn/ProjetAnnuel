<?php /** @noinspection DuplicatedCode */
require_once '../function/function.php';
require_once '../function/miseEnPage.php';
session_start();

if (!isset($_SESSION['recherche'], $_GET['niveau'])){
    header('Location:searchSimple.php');
    die();
}

$tabResultat = $_SESSION['recherche'];
$niveauInf = $_GET['niveau'];



session_write_close();
$titreOnglet = "Bactépédia - Recherche";
$titrePage = "Faire une recherche";
require_once '../elements/header.php';
require_once '../elements/nav.php';

?>
<div class="contenu">

    <div style="margin-left: 150px">
        <table>
            <?php
            if (!empty($tabResultat)) {
                $nbResultat = $niveauInf;
                foreach ($tabResultat as $ligne) {
                    $nbResultat++;
                    if ($nbResultat > $niveauInf AND $nbResultat <= $niveauInf+10) {
                        if ($ligne['visible_bacterie'] == 1) {
                            if ($ligne['gram_bacterie'] == "Positif") {
                                $color = "color: darkviolet;";
                            } elseif ($ligne['gram_bacterie'] == "Negatif") {
                                $color = "color: deeppink;";
                            } else {
                                $color = "color: black;";
                            }
                            $image = null;
                            if ($ligne['LienInterneImage_bacterie'] !== null) {
                                $image = "<img src=\"../{$ligne['LienInterneImage_bacterie']}\" alt=\"\" style=\"height: 100px;\">";
                            }

                            // permet d'ajouter 1 au nombre de recherche
                            ajoutRecherche($ligne['id_bacterie']);


                            echo <<<HTML
   
                            <tr>
                                
                                    <td>
                                        <a href="bacIndiv.php?idBac={$ligne['id_bacterie']}"  style="text-decoration: none;">
                                            $image
                                        </a>
                                    </td>
                                    <td>
                                        <a href="bacIndiv.php?idBac={$ligne['id_bacterie']}"  style="text-decoration: none;">
                                            <p style="$color; margin-left: 30px;">{$ligne['genre_bacterie']} {$ligne['espece_bacterie']} {$ligne['serovar_bacterie']}</p>
                                        </a>
                                    </td>
                                </a>
                            </tr>

HTML;
                        }
                    }
                }
            }
            ?>
        </table>
        <?php
        if(!empty($tabResultat)){
            if (count($tabResultat) > $niveauInf+10) {
                $niveauSupp = $niveauInf +10;
            echo "<a href=\"suiteSearch.php?niveau=$niveauSupp\" style=\"float: right\"><img src=\"../style/img/next.svg\" alt=\"Fleche vers droite\" style=\"width: 75px; margin: 20px;\"></a>";
            }
            if ($niveauInf > 20){
                $niveauPred = $niveauInf -10;
                echo "<a href=\"suiteSearch.php?niveau=$niveauPred\" style=\"float: right\"><img src=\"../style/img/next.svg\" alt=\"Fleche vers droite\" style=\"width: 75px; margin: 20px;  -webkit-transform: scaleX(-1); transform: scaleX(-1);\"></a>";
            }
        }
        ?>
    </div>






</div>

<?php
require_once '../elements/footer.php';
?>