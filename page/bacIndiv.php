<?php
// TODO: Système de gestion bactérie
// TODO : Mise en place du système de gestion bactérie visible ou non
$bacterie = [
   'id' => 1,
   'genre' => 'Escherichia',
   'espece' => 'coli',
   'serotype' => null,
   'gram' => 'Negatif',
   'temperature' => 37
];


$nomBac = $bacterie['genre'] . ' ' . $bacterie['espece'];

$titreOnglet = "Bactépédia - $nomBac";
$titrePage = "$nomBac";
require_once '../elements/header.php';
require_once '../elements/nav.php';

?>
<div class="contenu">
    <img class="imgBacIndiv" src="../upload/photoBacterie/escherichia_coli.jpg" alt="Photo microscope escherichia coli">

    <p>Nom genre : <?= $bacterie['genre'] ?></p>
    <p>Nom espèce : <?= $bacterie['espece'] ?></p>
   <?php
   if ($bacterie['serotype'] !== null){
       echo "<p>Sérotype : {$bacterie['serotype']}</p>";
   }
   ?>

    <p>Gram : <span style="<?php if ($bacterie['gram'] === 'Positif'){echo 'color: darkviolet;';}else{echo 'color: deeppink;';} ?>"><?= $bacterie['gram']?> </span></p>

    <p>Température optimale de culture : <?= $bacterie['temperature'] ?></p>




</div>
<?php
require_once '../elements/footer.php';
?>
