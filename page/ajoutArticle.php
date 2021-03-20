<?php
require_once '../function/function.php';
require_once '../function/miseEnPage.php';
session_start();

// on vérifie que l'utilisateur est bien admin
if ($_SESSION['estAdmin'] == 0) {
    // redirige vers l'accueil
    header('Location:accueil.php');
    die();
}

//Récupération de informations du formulaire d'ajout d'article
$titre_article = $_POST["titre_article"] ?? null;
$auteur_article = $_POST["auteur_article"] ?? null;
$extrait_article = $_POST["extrait_article"] ?? null;
$LienSource_article = $_POST["LienSource_article"] ?? null;
$datePublication_article = $_POST["datePublication_article"] ?? null;
$id_bacterie = $_POST["id_bacterie"] ?? null;

if (isset($titre_article, $auteur_article, $extrait_article, $LienSource_article, $datePublication_article, $id_bacterie)) {
    //verification que l'id de la bactérie existe bien sinon affichage d'un message d'erreur
    if (bacterieIdExiste($id_bacterie) == null) {
        $errorMsg = "Ce numéro de bactérie n'existe pas";
    } else {
// ajout en base de donnée
        $bdd = connect();
        $ajout = $bdd->prepare('INSERT INTO bcp__article(titre_article, auteur_article, extrait_article, LienSource_article, datePublication_article, id_bacterie) VALUES (:titre, :auteur, :extrait, :LienSource, :datePublication, :id_b)');
        $ajout->execute([
            'titre' => $titre_article,
            'auteur' => $auteur_article,
            'extrait' => $extrait_article,
            'LienSource' => $LienSource_article,
            'datePublication' => $datePublication_article,
            'id_b' => $id_bacterie
        ]);
        $successMsg = "L'article a bien été ajouté.";
    }
}

session_write_close();

$titreOnglet = "Bactépédia - Gestion de données";
$titrePage = "Ajouter un article";
require_once '../elements/header.php';
require_once '../elements/nav.php';
?>

<div class="contenu">


    <?php
    // Affiche un message d'erreur si il est défini
    if (isset($errorMsg)) {
        echo message($errorMsg, "msg-error");
    } elseif (isset($successMsg)) {
        echo message($successMsg, 'msg-success');
    }
    ?>
    <form action="" method="POST">
        <table>
            <tr>
                <td>
                    <label for="titre_article">Titre de l'article : </label>
                </td>
                <td>
                    <input style="height: 24px; width: 100%; margin: 5px;" type="text" name="titre_article" placeholder="Exemple: Le choléra."
                           required>
                </td>
            </tr>

            <tr>
                <td>
                    <label for="auteur_article">Source ou auteur(s) de l'article : </label>
                </td>
                <td>
                    <input style="height: 24px; width: 100%; margin: 5px;" type="text" name="auteur_article" placeholder="Exemple: Institut Pasteur"
                           required>
                </td>
            </tr>

            <tr>
                <td>
                    <label for="extrait_article">Extrait de l'article : </label>
                </td>
                <td>
                    <textarea style="margin: 5px; width: 100%;" name="extrait_article" id="extrait_article" cols="70" rows="10"
                              placeholder="Exemple: Le choléra est une maladie diarrhéique épidémique, strictement humaine, due à des bactéries appartenant aux sérogroupes O1 et O139 de l’espèce Vibrio cholerae. Ce bacille fût initialement observé par Pacini en 1854 puis isolé en 1883 par Robert Koch en Inde. La bactérie V. cholerae sérogroupe O1, biotype El Tor, est répandue sur toute la planète, qui subit actuellement la septième pandémie de choléra. L’Organisation mondiale de la santé estime à près de 3 millions le nombre de cas et à plus de 95 000 le nombre de décès dus à cette maladie chaque année dans le monde. Toutes les régions du monde déclarent des cas de choléra, l’Afrique est le continent le plus touché et concentre plus de 50% des cas. Le taux global de létalité a été de 1,8%, en 2016, mais a dépassé les 6% parmi les groupes vulnérables résidant dans des zones à haut risque."
                              required></textarea>
                </td>
            </tr>

            <tr>
                <td>
                    <label for="LienSource_article">Lien de l'article : </label>
                </td>
                <td>
                    <input style="height: 24px; margin: 5px; width: 100%;" type="text" name="LienSource_article"
                           placeholder="Exemple: https://www.pasteur.fr/fr/centre-medical/fiches-maladies/cholera"
                           required>
                </td>
            </tr>

            <tr>
                <td>
                    <label for="datePublication_article"> Date de publication de l'article : </label>
                </td>
                <td>
                    <input style="height: 24px; margin: 5px; width: 100%;" name="datePublication_article" type="date"
                           id="datePublication_article" required>
                </td>
            </tr>

            <tr>
                <td>
                    <label for="id_bacterie"> Bactérie mentionnée: </label>
                </td>
                <td>
                    <select style="height: 24px; margin: 5px; width: 100%;" name="id_bacterie" id="id_bacterie">
                        <option value="" selected disabled hidden>Non sélectionné</option>
                        <?php
                        foreach (listeBacterie() as $ligne){
                            echo "<option value='{$ligne['id_bacterie']}'>{$ligne['genre_bacterie']} {$ligne['espece_bacterie']} {$ligne['serovar_bacterie']}</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <button style="display: flex; width: 100%; justify-content: center; align-items: center; margin: 5px;"
                            type="submit"><img style="height: 20px" src="../style/img/plus.svg" alt="">
                        <div style="padding-left: 10px;">Ajouter l'article</div>
                    </button>
                </td>
            </tr>
        </table>
    </form>

</div>

<?php
require_once '../elements/footer.php';
?>
