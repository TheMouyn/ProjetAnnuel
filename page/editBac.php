<!-- Groupe N°032 -  Orlane GUILLET, Maxime ONILLON, Aline REBOUT, Achil MICHEL-->
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
        'gram' => $bacBDD[0]['gram_bacterie'],
        'forme' => $bacBDD[0]['nom_forme'],
        'nbConsultation' => $bacBDD[0]['nbConsultation_bacterie'],
        'nbModification' => $bacBDD[0]['nbModification_bacterie'],
        'nbRecherche' => $bacBDD[0]['nbRecherche_bacterie'],
        'dateDerniereModif' => enDateHeure($bacBDD[0]['dateModif_bacterie']),
        'temperature' => $bacBDD[0]['temperatureOptimale_bacterie'],
        'prophylaxie' => $bacBDD[0]['prophylaxie_bacterie'],
        'photo' => $bacBDD[0]['LienInterneImage_bacterie'],
        'visible' => $bacBDD[0]['visible_bacterie']
    ];


    // Mise à jour de la base de donnée à partir des informations du formulaire
    // Permet de vérifier que le formulaire a bien été envoyé
    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        $newBacterie =[
            'id' => $bacterie['id'],
            'genre' => $_POST['genre'] ?? null,
            'espece' => $_POST['espece'] ?? null,
            'serotype' => $_POST['serotype'] ?? null,
            'gram' => $_POST['gram'] ?? null,
            'forme' => $_POST['forme'] ?? null,
            'dateDerniereModif' => date('Y-m-d H:i:s'),
            'temperature' => $_POST['temperature'] ?? null,
            'prophylaxie' => $_POST['prophylaxie'] ?? null,
            'visible' => $_POST['visible'] ?? null
        ];

        // modification du gram
        if($newBacterie['gram'] == "Non applicable"){
            $newBacterie['gram'] = "NA";
        }

        // modification du visible
        if($newBacterie['visible'] == "ouiVisible"){
            $newBacterie['visible'] = 1;
        } else {
            $newBacterie['visible'] = 0;
        }

        // vérification serovar si non null
        if (empty($newBacterie['serotype'])){
            $newBacterie['serotype'] = null;
        }

        // vérification prophylaxie si non null
        if (empty($newBacterie['prophylaxie'])){
            $newBacterie['prophylaxie'] = null;
        }


        // vérification des éléments nécessaires
        if (!isset($newBacterie['genre'], $newBacterie['espece'], $newBacterie['gram'], $newBacterie['forme'])){
            $errorMsg = "Veuillez remplir les champs obligatoires";

        } else {
            $bdd = connect();
            $majBac = $bdd->prepare('UPDATE bcp__bacterie SET genre_bacterie = :genre, espece_bacterie = :espece, serovar_bacterie = :serotype, gram_bacterie = :gram, nom_forme = :forme, dateModif_bacterie = :dateMaj, temperatureOptimale_bacterie = :temp, prophylaxie_bacterie = :prophylaxie, visible_bacterie = :boolVisible WHERE id_bacterie = :idBac;');
            $majBac->execute([
                'genre' => ucfirst(strtolower($newBacterie['genre'])),
                'espece' => strtolower($newBacterie['espece']),
                'serotype' => $newBacterie['serotype'],
                'gram' => $newBacterie['gram'],
                'forme' => $newBacterie['forme'],
                'dateMaj' => $newBacterie['dateDerniereModif'],
                'temp' => $newBacterie['temperature'],
                'prophylaxie' => $newBacterie['prophylaxie'],
                'boolVisible' => $newBacterie['visible'],
                'idBac' => $newBacterie['id']
            ]);


            // update de la date des milieux
            $delPousse = $bdd->prepare('DELETE FROM bcp__pousse WHERE id_bacterie = :idBac;');
            $delPousse->execute([
                'idBac' => $newBacterie['id']
            ]);
            if (isset($_POST['milieu'])){
                $newMilieux = $_POST['milieu'];
                foreach ($newMilieux as $milieu){
                    $addMilieu = $bdd->prepare('INSERT INTO bcp__pousse VALUES (:idBac, (SELECT id_milieu FROM bcp__milieu WHERE nature_milieu = :nomMilieu));');
                    $addMilieu->execute([
                        'idBac' => $newBacterie['id'],
                        'nomMilieu' => $milieu
                    ]);
                }
            }


            // update des résistances aux antibiotiques
            $delReistance = $bdd->prepare('DELETE FROM bcp__resistance WHERE id_bacterie = :idBac;');
            $delReistance->execute([
                'idBac' => $newBacterie['id']
            ]);
            if (isset($_POST['antibiotique'])){
                $newResistances = $_POST['antibiotique'];
                foreach ($newResistances as $resistance){
                    $addResistance = $bdd->prepare('INSERT INTO bcp__resistance VALUES (:idBac, :nomAntibio);');
                    $addResistance->execute([
                        'idBac' => $newBacterie['id'],
                        'nomAntibio' => $resistance
                    ]);
                }

            }

            // update des zone corps
            $delZone = $bdd->prepare('DELETE FROM bcp__atteint WHERE id_bacterie = :idBac;');
            $delZone->execute([
                'idBac' => $newBacterie['id']
            ]);
            if (isset($_POST['zoneCorps'])){
                $newZones = $_POST['zoneCorps'];
                foreach ($newZones as $zone){
                    $addZone = $bdd->prepare('INSERT INTO bcp__atteint VALUES (:idBac, :nomZone);');
                    $addZone->execute([
                        'idBac' => $newBacterie['id'],
                        'nomZone' => $zone
                    ]);
                }

            }

            // update des symptômes
            $delSymptome = $bdd->prepare('DELETE FROM bcp__provoquesymptome WHERE id_bacterie = :idBac;');
            $delSymptome->execute([
                'idBac' => $newBacterie['id']
            ]);
            if (isset($_POST['symptome'])){
                $newSymptomes = $_POST['symptome'];
                foreach ($newSymptomes as $symptome){
                    $addZone = $bdd->prepare('INSERT INTO bcp__provoquesymptome VALUES (:idBac, :nomSymptome);');
                    $addZone->execute([
                        'idBac' => $newBacterie['id'],
                        'nomSymptome' => $symptome
                    ]);
                }

            }

            // update des maladie
            $delMaladie = $bdd->prepare('DELETE FROM bcp__provoquemaladie WHERE id_bacterie = :idBac;');
            $delMaladie->execute([
                'idBac' => $newBacterie['id']
            ]);
            if (isset($_POST['maladie'])){
                $newMaladies = $_POST['maladie'];
                foreach ($newMaladies as $maladie){
                    $addMaladie = $bdd->prepare('INSERT INTO bcp__provoquemaladie VALUES (:idBac, :nomMaladie);');
                    $addMaladie->execute([
                        'idBac' => $newBacterie['id'],
                        'nomMaladie' => $maladie
                    ]);
                }

            }

            // plus 1 au nombre de modification des bactérie pour l'utulisateur
            ajoutNbModif($_SESSION['idUser']);

            header('Location:bacIndiv.php?idBac='.$newBacterie['id']);
            die();

        }
    }
}

session_write_close();
$titreOnglet = "Bactépédia - Modifier une bactérie";
$titrePage = "Modifier une bactérie";
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
        <p style="font-weight: bold">Modification de la bactérie numéro <?= $bacterie['id'] ?></p>
        <a style="float: right; margin: 0 50px;" href="editPicture.php?idBac=<?= $bacterie['id'] ?>">Changer la photo de la bactérie</a>
        <form action="" method="post">
            <table>
                <tr>
                    <td>
                        <label for="visible">Bactérie est elle visible : </label>
                    </td>
                    <td>
                        <?php
                        $selectVisible = "";
                        if ($bacterie['visible'] == 1){
                            $selectVisible = "checked";
                        }
                        ?>
                        <input type="checkbox" id="visible" name="visible" value="ouiVisible" <?= $selectVisible ?>>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="genre">Nom genre : </label>
                    </td>
                    <td>
                        <input type="text" id="genre" name="genre" value="<?= $bacterie['genre'] ?>" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="espece">Nom espèce : </label>
                    </td>
                    <td>
                        <input type="text" id="espece" name="espece" value="<?= $bacterie['espece'] ?>" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="serotype">Nom sérotype : </label>
                    </td>
                    <td>
                        <input type="text" id="serotype" name="serotype" value="<?= $bacterie['serotype'] ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="forme">Forme de la forme : </label>
                    </td>
                    <td>
                        <select name="forme" id="forme" style="height: 24px;">
                            <?php
                            foreach (formesBacterie() as $forme) {
                                $attribue = "";
                                if ($forme == $bacterie['forme']) {
                                    $attribue = "selected";
                                }
                                echo "<option value=\"$forme\" $attribue>$forme</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="gram">Type de Gram :</label>
                    </td>
                    <td>
                        <?php
                        $selectGramPos = "";
                        $selectGramNeg = "";
                        $selectGramNA = "";
                        if ($bacterie['gram'] == "Negatif") {
                            $selectGramNeg = "selected";
                        } elseif ($bacterie['gram'] == "Positif") {
                            $selectGramPos = "selected";
                        } elseif ($bacterie['gram'] == "NA") {
                            $selectGramNA = "selected";
                        }
                        ?>
                        <select name="gram" id="gram" style="height: 24px;">
                            <option value="Positif" <?= $selectGramPos ?> style="color: darkviolet;">Positif</option>
                            <option value="Negatif" <?= $selectGramNeg ?> style="color: deeppink;">Négatif</option>
                            <option value="NA" <?= $selectGramNA ?> >Non applicable</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="temperature">Température optimale de culture : </label>
                    </td>
                    <td>
                        <input name="temperature" type="number" id="temperature" value="<?= $bacterie['temperature'] ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="prophylaxie">Paragraphe de prophylaxie : </label>
                    </td>
                    <td>
                        <textarea name="prophylaxie" id="prophylaxie" cols="100"
                                  rows="15"><?= $bacterie['prophylaxie'] ?></textarea>
                    </td>
                </tr>
            </table>


            <!--Table de relation-->
            <div class="form-groupe-checkbox">
                <div>
                    <fieldset class="groupe-checkbox">
                        <legend>Sur quel milieu pousse la bactérie :</legend>

                        <?php
                        // permet de récupérer la liste des milieux de la bactérie, isoler uniquement la partie texte
                        $milieuBacDouble = milieuPourUneBacterie($bacterie['id']);
                        $listeMilieuBac = [];
                        foreach ($milieuBacDouble as $nomMilieu){
                            $listeMilieuBac[] = $nomMilieu['nature_milieu'];
                        }

                        foreach (milieuxBacterie() as $milieu) {
                            // si la bactérie pousse sur le milieu alors on coche la case
                            $selectMilieu = "";
                            if (in_array($milieu, $listeMilieuBac)){
                                $selectMilieu = "checked";
                            }
                            echo "
                            <div>
                               <input type=\"checkbox\" name='milieu[]' value=\"$milieu\" id=\"$milieu\" $selectMilieu>
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
                        // permet de récupérer la liste des résistances si il y a en a
                        $antibiotiqueBac = resistancePourUneBacterie($bacterie['id']);
                        $listeAntibiotiqueBac = [];
                        foreach ($antibiotiqueBac as $antibio){
                            $listeAntibiotiqueBac[] = $antibio['nom_antibiotique'];
                        }

                        foreach (antibiotiquesBacterie() as $antibiotique) {
                            // coche la case si il y a une résistance
                            $selectAntibio = "";
                            if(in_array($antibiotique, $listeAntibiotiqueBac)){
                                $selectAntibio = "checked";
                            }

                            echo "
                        <div>
                           <input type=\"checkbox\" name='antibiotique[]' value=\"$antibiotique\" id=\"$antibiotique\" $selectAntibio>
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
                        // permet de récupérer la liste des zones corps touchés si il y a en a
                        $zoneCorpsBac = zoneCorpsPourUneBacterie($bacterie['id']);

                        $listeZoneCorpsBac = [];
                        foreach ($zoneCorpsBac as $zone){
                            $listeZoneCorpsBac[] = $zone['nom_zoneCorps'];
                        }

                        foreach (zonesCorps() as $zoneCorps) {
                            $selectZoneCorps = "";
                            if(in_array($zoneCorps, $listeZoneCorpsBac)){
                                $selectZoneCorps = "checked";
                            }

                            echo "
                        <div>
                           <input type=\"checkbox\" name='zoneCorps[]' value=\"$zoneCorps\" id=\"$zoneCorps\" $selectZoneCorps>
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
                        // permet de récupérer la liste des symptômes  si il y a en a
                        $symptomeBac = symptomePourUneBacterie($bacterie['id']);

                        $listeSymptomeBac = [];
                        foreach ($symptomeBac as $symptomeUnique){
                            $listeSymptomeBac[] = $symptomeUnique['nom_symptome'];
                        }

                        foreach (symptomes() as $symptome) {
                            $selectSymptome = "";
                            if(in_array($symptome, $listeSymptomeBac)){
                                $selectSymptome = "checked";
                            }

                            echo "
                        <div>
                           <input type=\"checkbox\" name='symptome[]' value=\"$symptome\" id=\"$symptome\" $selectSymptome>
                           <label for=\"$symptome\">$symptome</label>
                       </div>
                       ";
                        }
                        ?>

                    </fieldset>
                </div>

                <div>
                    <fieldset class="groupe-checkbox">
                        <legend>Quel sont les maladies causées par cette bactérie :</legend>

                        <?php
                        // permet de récupérer la liste des maladies  si il y a en a
                        $maladieBac = maladiePourUneBacterie($bacterie['id']);

                        $listeMaladieBac = [];
                        foreach ($maladieBac as $maladieUnique){
                            $listeMaladieBac[] = $maladieUnique['nom_maladie'];
                        }


                        foreach (maladies() as $maladie) {
                            $selectMaladie = "";
                            if (in_array($maladie, $listeMaladieBac)){
                                $selectMaladie = "checked";
                            }

                            echo "
                            <div>
                               <input type=\"checkbox\" name='maladie[]' value=\"$maladie\" id=\"$maladie\" $selectMaladie>
                               <label for=\"$maladie\">$maladie</label>
                           </div>
                           ";
                        }
                        ?>
                    </fieldset>
                </div>

            </div>

            <div style="display:flex; width: 100%; justify-content: center">
                <button style="display: flex; width: 80%; justify-content: center; align-items: center; margin: 5px;"
                        type="submit"><img style="height: 20px" src="../style/img/save.svg" alt="">
                    <div style="padding-left: 10px;">Enregistrer</div>
                </button>
            </div>


        </form>


    </div>

<?php
require_once '../elements/footer.php';
?>