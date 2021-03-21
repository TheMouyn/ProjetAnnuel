<!-- Groupe N°032 -  Orlane GUILLET, Maxime ONILLON, Aline REBOUT, Achil MICHEL-->
<?php /** @noinspection DuplicatedCode */
require_once '../function/function.php';
require_once '../function/miseEnPage.php';

if (isset($_GET['recherche'])){
    // deux grands cas : 1 mot et 2 mots
    $recherche = $_GET['recherche'];
    $recherche = trim($recherche);
    if (!empty($recherche)) {
        $tabRecherche = str_word_count($recherche, 2); // permet de lister les mots dans un tableau
        $newTab = [];
        // permet de mettre les mots dans l'ordre d'indice 0, 1, 2 ...
        foreach ($tabRecherche as $mot) {
            $newTab[] = $mot;
        }
        // tableau qui stock les résultats
        $tabResultat = [];

        if (count($newTab) == 1) {
            // traitement 1 mot
            $resultat = rechercheUnMotBacterie($newTab[0]);

            if (count($resultat) == 1) {
                foreach ($resultat as $premier) {
                    foreach ($premier as $ligne) {
                        $tabResultat[] = $ligne;
                    }
                }
            }

        } else {
            // traitement deux mot
            $resultat = rechercheDeuxMotsBacterie($newTab[0], $newTab[1]);

            foreach ($resultat as $ligne){
                $tabResultat[] = $ligne;
            }
        }

        // si il y a plus de 10 résultats
        if (count($tabResultat) > 10){
            session_start();
            $_SESSION['recherche'] = $tabResultat;
            session_write_close();
        }

        if  (empty($tabResultat)){
            $errorMsg = "Votre recherche est infructueuse";
        }


    } else {
        $errorMsg = "Veuillez saisir une recherche";
    }



}



$titreOnglet = "Bactépédia - Recherche";
$titrePage = "Faire une recherche";
require_once '../elements/header.php';
require_once '../elements/nav.php';
?>
    <div class="contenu">

        <div class="titreform">
            <a href="searchSimple.php"  class="titreindividuel"><span class="sousmenu active">Recherche simple</span></a>
            <a href="searchAvancee.php" class="titreindividuel"><span class="sousmenu">Recherche avancée</span></a>
        </div>


        <form action="" method="" class="formulaire">
            <input style="display: block; width: 80%;" type="text" name="recherche" placeholder="Rechercher par nom de genre ou d'espèce" required value="<?php if (isset($recherche)){echo $recherche;} ?>">
            <button style="display: block; margin-left: 5px;" type="submit"><img style="height: 20px" src="../style/img/search.svg" alt=""></button>
        </form>

        <?php
        // Affiche un message d'erreur si il est défini
        if (isset($errorMsg)) {
            echo message($errorMsg, "msg-error");
        }
        ?>
        <div style="margin-left: 150px">
            <table>
            <?php
            if (!empty($tabResultat)) {
                $nbResultat = 0;
                foreach ($tabResultat as $ligne) {
                    $nbResultat++;
                    if ($nbResultat > 0 AND $nbResultat <= 10) {
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
            if (!empty($tabResultat) AND count($tabResultat) > 10) {
                echo "<a href=\"suiteSearch.php?niveau=10\" style=\"float: right\" title='Suivant'><img src=\"../style/img/next.svg\" alt=\"Fleche vers droite\" style=\"width: 75px; margin: 20px;\"></a>";
            }
            ?>
        </div>



    </div>
<?php
require_once '../elements/footer.php';
?>