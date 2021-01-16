<?php
$titreOnglet = "Bactépédia - Recherche";
$titrePage = "Faire une recherche";
require_once '../elements/header.php';
require_once '../elements/nav.php';

require_once '../function.php';


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

        <div class="form-groupe-item">
            <fieldset>
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

            <fieldset>
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

        <div class="form-groupe-item"">
        <fieldset>
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
        <fieldset>
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


</div>

<?php
require_once '../elements/footer.php';
?>




