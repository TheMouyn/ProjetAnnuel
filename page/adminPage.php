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


// on récupère les justificatifs administrateurs non validés
$justif = justificatifNonValide();

// validation justificatif
if(isset($_GET['valid'])){
    $justifAValider = $_GET['valid'];
    $bdd = connect();
    $query = $bdd->prepare('UPDATE bcp__user SET justificatifValide_user = 1, NbModification_user = 0, NbAjout_user = 0, NbSuppression_user = 0 WHERE id_user = :id;');
    $query->execute([
        'id' => $justifAValider
    ]);
    header('Location:adminPage.php');
    die();
}

// on récupère le nombre de modif, add et del de l'admin dans la bdd
$bdd = connect();
$stat = $bdd->prepare('SELECT NbModification_user, NbSuppression_user, NbAjout_user FROM bcp__user WHERE id_user = :idUser;');
$stat->execute([
    'idUser' => $_SESSION['idUser']
]);
$resultatStat = $stat->fetchAll(PDO::FETCH_ASSOC);




session_write_close();
$titreOnglet = "Bactépédia - Gestion des données";
$titrePage = "Gestion des données";
require_once '../elements/header.php';
require_once '../elements/nav.php';

?>
<div class="contenu">

    <div>
        <h3>Validation des justificatifs administrateurs</h3>
        <table>
        <?php
        if (!empty($justif)){
            foreach ($justif as $ligne) {
                echo <<<HTML
                    <tr>
                    <td><p>{$ligne['prenom_user']} {$ligne['nom_user']}</p></td>
                    <td><p>{$ligne['nom_typeEtude']}</p></td>
                    <td><a href="../{$ligne['lienInterneJustificatif_user']}" target="_blank">Ouvrir justificatif</a></td>
                    <td><a href="adminPage.php?valid={$ligne['id_user']}" style="color: blue">Valider</a></td>
                    </tr>
HTML;
            }
        } else {
                echo message("Aucuns justificatifs administrateur à valider.", "msg-success");
            }
        ?>
        </table>
    </div>

    <div style="margin: 50px 0;">
<<<<<<< Updated upstream
        <p>Nombre de modification : <?= $resultatStat[0]['NbModification_user'] ?></p>
        <p>Nombre d'ajout : <?= $resultatStat[0]['NbAjout_user'] ?></p>
        <p>Nombre d'ajout : <?= $resultatStat[0]['NbSuppression_user'] ?></p>
    </div>

=======
        <p>Nombre de modification de bactérie : <?= $resultatStat[0]['NbModification_user'] ?></p>
        <p>Nombre d'ajout de bactérie : <?= $resultatStat[0]['NbAjout_user'] ?></p>
        <p>Nombre d'ajout de bactérie : <?= $resultatStat[0]['NbSuppression_user'] ?></p>
    </div>
>>>>>>> Stashed changes

    <div>
    <p>Pour ajouter un article : <a href="ajoutArticle.php">cliquer ici</a> </p>
    </div>



</div>

<?php
require_once '../elements/footer.php';
?>