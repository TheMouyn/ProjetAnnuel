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
    $query = $bdd->prepare('UPDATE bcp__user SET justificatifValide_user = 1 WHERE id_user = :id;');
    $query->execute([
        'id' => $justifAValider
    ]);
    header('Location:adminPage.php');
    die();
}




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





</div>

<?php
require_once '../elements/footer.php';
?>