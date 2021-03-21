<!-- Groupe N°032 -  Orlane GUILLET, Maxime ONILLON, Aline REBOUT, Achil MICHEL-->
<?php /** @noinspection DuplicatedCode */
require_once '../function/miseEnPage.php';
require_once '../function/function.php';
require_once '../function/connect.php';
session_start();

if (isset($_GET['genre'])){
    $genreUser = $_GET['genre'] ?? null;
    $especeUser = $_GET['espece'] ?? null;
    $gramUser = $_GET['gram'] ?? null;
    $formeUser = $_GET['form'] ?? null;
    $formeUser = $_GET['form'] ?? null;
    $milieuUser = $_GET['milieu'] ?? null;
    $resistanceUser = $_GET['antibiotique'] ?? null;
    $zoneCorpsUser = $_GET['zoneCorps'] ?? null;
    $symptomeUser = $_GET['symptome'] ?? null;
    $maladieUser = $_GET['maladie'] ?? null;


    // recherche dans bdd avec genre et espèce
    $bdd = connect();
    $simple = $bdd->prepare('SELECT id_bacterie FROM bcp__bacterie WHERE genre_bacterie LIKE :genre AND espece_bacterie LIKE :espece AND gram_bacterie LIKE :gram AND nom_forme LIKE :forme;');
    $simple->execute([
        'genre' => '%' . $genreUser . '%',
        'espece' => '%' . $especeUser . '%',
        'gram' => '%' . $gramUser . '%',
        'forme' => '%' . $formeUser . '%'
    ]);
    $resultSimple = $simple->fetchAll(PDO::FETCH_ASSOC);

    // liste des bactéries qui correspondent au genre espece gram et forme
    $listeBacterieMatch = [];
    foreach ($resultSimple as $ligne){
        $listeBacterieMatch[] = $ligne['id_bacterie'];
    }


    // traitement du milieu
    if (isset($milieuUser)){
        foreach ($milieuUser as $ligne) {
            $queryMilieu = $bdd->prepare('SELECT id_bacterie FROM bcp__bacterie JOIN bcp__pousse USING (id_bacterie) JOIN bcp__milieu USING (id_milieu) WHERE nature_milieu = :nomMilieu;');
            $queryMilieu->execute([
                'nomMilieu' => $ligne
            ]);
            $resultMilieu = $queryMilieu->fetchAll(PDO::FETCH_ASSOC);

            // permet de garder un tableau avec une seule profondeur
            $listeMilieu = [];
            foreach ($resultMilieu as $item){
                $listeMilieu[] = $item['id_bacterie'];
            }

            // on garde uniquement la liste des bactéries qui match avec les 4 premier critère + les milieux
            $listeBacterieMatch = gardeListeMatch($listeBacterieMatch, $listeMilieu);
        }
    }


    // traitement de la résistance
    if (isset($resistanceUser)){
        foreach ($resistanceUser as $ligne) {
            $queryResistance = $bdd->prepare('SELECT id_bacterie FROM bcp__bacterie JOIN bcp__resistance USING (id_bacterie) WHERE nom_antibiotique = :nomAntibiotique;');
            $queryResistance->execute([
                'nomAntibiotique' => $ligne
            ]);
            $resultResistance = $queryResistance->fetchAll(PDO::FETCH_ASSOC);


            // permet de garder un tableau avec une seule profondeur
            $listeResistance = [];
            foreach ($resultResistance as $item){
                $listeResistance[] = $item['id_bacterie'];
            }

            // on garde uniquement la liste des bactéries qui match avec les 4 premier critère + milieu +Resistance
            $listeBacterieMatch = gardeListeMatch($listeBacterieMatch, $listeResistance);
        }
    }


    // traitement des zones corps
    if (isset($zoneCorpsUser)){
        foreach ($zoneCorpsUser as $ligne) {
            $queryZoneCorps = $bdd->prepare('SELECT id_bacterie FROM bcp__bacterie JOIN bcp__atteint USING (id_bacterie) WHERE nom_zoneCorps = :nomZoneCorps;');
            $queryZoneCorps->execute([
                'nomZoneCorps' => $ligne
            ]);
            $resultZoneCorps = $queryZoneCorps->fetchAll(PDO::FETCH_ASSOC);


            // permet de garder un tableau avec une seule profondeur
            $listeZoneCorps = [];
            foreach ($resultZoneCorps as $item){
                $listeZoneCorps[] = $item['id_bacterie'];
            }

            // on garde uniquement la liste des bactéries qui match avec les 4 premier critère + milieu +Resistance
            $listeBacterieMatch = gardeListeMatch($listeBacterieMatch, $listeZoneCorps);
        }
    }

    // traitement des symptômes
    if (isset($symptomeUser)){
        foreach ($symptomeUser as $ligne) {
            $querySymptome = $bdd->prepare('SELECT id_bacterie FROM bcp__bacterie JOIN bcp__provoquesymptome USING (id_bacterie) WHERE nom_symptome = :nomSymptome;');
            $querySymptome->execute([
                'nomSymptome' => $ligne
            ]);
            $resultSymptome = $querySymptome->fetchAll(PDO::FETCH_ASSOC);


            // permet de garder un tableau avec une seule profondeur
            $listeSymptome = [];
            foreach ($resultSymptome as $item){
                $listeSymptome[] = $item['id_bacterie'];
            }

            // on garde uniquement la liste des bactéries qui match avec les 4 premier critère + milieu +Resistance
            $listeBacterieMatch = gardeListeMatch($listeBacterieMatch, $listeSymptome);
        }
    }

    // traitement des maladies
    if (isset($maladieUser)){
        foreach ($maladieUser as $ligne) {
            $queryMaladie = $bdd->prepare('SELECT id_bacterie FROM bcp__bacterie JOIN bcp__provoquemaladie USING (id_bacterie) WHERE nom_maladie = :nomMaladie;');
            $queryMaladie->execute([
                'nomMaladie' => $ligne
            ]);
            $resultMaladie = $queryMaladie->fetchAll(PDO::FETCH_ASSOC);


            // permet de garder un tableau avec une seule profondeur
            $listeMaladie = [];
            foreach ($resultMaladie as $item){
                $listeMaladie[] = $item['id_bacterie'];
            }

            // on garde uniquement la liste des bactéries qui match avec les 4 premier critère + milieu +Resistance
            $listeBacterieMatch = gardeListeMatch($listeBacterieMatch, $listeMaladie);
        }
    }

    // on génère un tableau avec toutes les informations des bactéries basé sur la liste des id
    $tabResultat = [];
    foreach ($listeBacterieMatch as $idBac){
        $infos = uneBacterie($idBac);
        $tabResultat[] = $infos[0];
    }

    // on stock les informations de la recherche dans la session au cas où il y a plus de 10 résultats
    $_SESSION['recherche'] = $tabResultat;

    if (empty($listeBacterieMatch)){
        $errorMsg = "Votre recherche est infructeuse";
    }


}


session_write_close();
$titreOnglet = "Bactépédia - Recherche";
$titrePage = "Faire une recherche";
require_once '../elements/header.php';
require_once '../elements/nav.php';


?>
<div class="contenu">

    <div class="titreform">
        <a href="searchSimple.php" class="titreindividuel"><span class="sousmenu">Recherche simple</span></a>
        <a href="searchAvancee.php" class="titreindividuel active"><span
                    class="sousmenu active">Recherche avancée</span></a>
    </div>


    <form action="" method="get" class="formulaire">
        <input class="form-item" type="text" name="genre" placeholder="Nom de genre">
        <input class="form-item" type="text" name="espece" placeholder="Nom d'espèce">

        <div class="form-groupe-item">
            <div>
                <label for="gram">Type de Gram :</label>
                <select name="gram" id="gram" style="margin: 0px 10px; height: 24px;">
                    <option value="" selected disabled hidden>Non sélectionné</option>
                    <option value="Positif" style="color: darkviolet;">Positif</option>
                    <option value="Negatif" style="color: deeppink;">Négatif</option>
                    <option value="NA">Non applicable</option>
                </select>
            </div>

            <div>
                <label for="forme">Forme de la bactérie :</label>
                <select name="forme" id="forme" style="margin: 0px 10px; height: 24px;">
                    <option value="" selected disabled hidden>Non sélectionné</option>
                    <?php
                    foreach (formesBacterie() as $forme) {
                        echo "<option value=\"$forme\">$forme</option>";
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="form-groupe-checkbox">
            <div>
                <fieldset class="groupe-checkbox">
                    <legend>Sur quel milieu pousse la bactérie :</legend>

                    <?php
                    foreach (milieuxBacterie() as $milieu) {

                        echo "
                        <div>
                           <input type=\"checkbox\" name='milieu[]' value=\"$milieu\" id=\"$milieu\">
                           <label for=\"$milieu\">$milieu</label>
                       </div>
                       ";
                    }
                    ?>

                </fieldset>
            </div>

            <div>
                <fieldset class="groupe-checkbox">
                    <legend>Quel sont les résistances de la bactérie :</legend>

                    <?php
                    foreach (antibiotiquesBacterie() as $antibiotique) {

                        echo "
                        <div>
                           <input type=\"checkbox\" name='antibiotique[]' value=\"$antibiotique\" id=\"$antibiotique\">
                           <label for=\"$antibiotique\">$antibiotique</label>
                       </div>
                       ";
                    }
                    ?>

                </fieldset>
            </div>

            <div>
                <fieldset class="groupe-checkbox">
                    <legend>Quel sont les zones du corps touchées :</legend>

                    <?php
                    foreach (zonesCorps() as $zoneCorps) {

                        echo "
                        <div>
                           <input type=\"checkbox\" name='zoneCorps[]' value=\"$zoneCorps\" id=\"$zoneCorps\">
                           <label for=\"$zoneCorps\">$zoneCorps</label>
                       </div>
                       ";
                    }
                    ?>

                </fieldset>
            </div>

            <div>
                <fieldset class="groupe-checkbox">
                    <legend>Quel sont les symptômes :</legend>

                    <?php
                    foreach (symptomes() as $symptome) {

                        echo "
                        <div>
                           <input type=\"checkbox\" name='symptome[]' value=\"$symptome\" id=\"$symptome\">
                           <label for=\"$symptome\">$symptome</label>
                       </div>
                       ";
                    }
                    ?>

                </fieldset>
            </div>

            <div>
                <fieldset class="groupe-checkbox">
                    <legend>Quelle sont les maladies</legend>
                    <?php
                    foreach (maladies() as $maladie) {
                        echo "
                        <div>
                           <input type=\"checkbox\" name='maladie[]' value=\"$maladie\" id=\"$maladie\">
                           <label for=\"$maladie\">$maladie</label>
                       </div>
                       ";
                    }
                    ?>
                </fieldset>
            </div>

        </div>

            <!-- menu drop down avec checkbox-->

            <button style="display: flex; width: 40%; justify-content: center; align-items: center; margin: 5px;"
                    type="submit"><img style="height: 20px" src="../style/img/search.svg" alt="">
                <div style="padding-left: 10px;">Rechercher</div>
            </button>
            <button style="display: flex; width: 40%; justify-content: center; align-items: center; margin: 5px;"
                    type="reset"><img style="height: 20px" src="../style/img/reset.svg" alt="">
                <div style="padding-left: 10px;">Remise à zéro</div>
            </button>
    </form>


<!--Affichage des résultats-->
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

    <?php
    // Affiche un message d'erreur si il est défini
    if (isset($errorMsg)) {
        echo message($errorMsg, "msg-error");
    }
    ?>




</div>

<?php
require_once '../elements/footer.php';
?>




