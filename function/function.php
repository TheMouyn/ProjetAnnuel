<?php
require_once 'connect.php';

function formesBacterie():array {
   // renvoi toute la liste des formes de bactérie stocké en bdd
   $bdd=connect();
   $query = $bdd->prepare('SELECT * FROM bcp__forme');
   $query->execute();

   return ($query->fetchAll(PDO::FETCH_COLUMN));
}

function antibiotiquesBacterie():array {
   // renvoi toute la liste des antibiotiques stocké en bdd
   $bdd = connect();
   $query = $bdd->prepare('SELECT * FROM bcp__antibiotique');
   $query->execute();
   return ($query->fetchAll(PDO::FETCH_COLUMN));
}

function milieuxBacterie():array {
   // renvoi toute la liste des milieux stocké en bdd
   $bdd = connect();
   $query = $bdd->prepare('SELECT nature_milieu FROM bcp__milieu');
   $query->execute();
   return ($query->fetchAll(PDO::FETCH_COLUMN));
}

function zonesCorps():array {
   // renvoi toute la liste des zone corps stocké en bdd
   $bdd = connect();
   $query = $bdd->prepare('SELECT nom_zoneCorps FROM bcp__zonecorps');
   $query->execute();
   return ($query->fetchAll(PDO::FETCH_COLUMN));
}

function symptomes():array {
   // renvoi toute la liste des symptôme stocké en bdd
   $bdd = connect();
   $query = $bdd->prepare('SELECT nom_symptome FROM bcp__symptome');
   $query->execute();
   return ($query->fetchAll(PDO::FETCH_COLUMN));
}

function articleDESC10():array {
   // renvoi les 10 derniers articles par ordre décroissant de date de publication
   $bdd = connect();
   $query = $bdd->prepare('SELECT * FROM bcp__article ORDER BY datePublication_article DESC LIMIT 10');
   $query->execute();
   return ($query->fetchAll(PDO::FETCH_ASSOC));
}
function articleDESCall():array {
   // renvoi tous les articles par ordre décroissant de date publication
   $bdd = connect();
   $query = $bdd->prepare('SELECT * FROM bcp__article ORDER BY datePublication_article DESC');
   $query->execute();
   return ($query->fetchAll(PDO::FETCH_ASSOC));
}

function nbArtcile():int {
   // renvoi le nombre d'article total
   $bdd = connect();
   $query = $bdd->prepare('SELECT COUNT(*) FROM bcp__article');
   $query->execute();
   $result = $query->fetchAll(PDO::FETCH_COLUMN);
   return ($result[0]);
}


function uneBacterie($id):array {
   // donne les informations d'une bactérie avec son id
   $bdd = connect();
   $query = $bdd->prepare('SELECT * FROM bcp__bacterie WHERE id_bacterie = :id');
   $query->execute([
      'id' => $id
   ]);
   return ($query->fetchAll(PDO::FETCH_ASSOC));

}

function milieuPourUneBacterie($idBac):array {
   // récupère les milieux où pousse la bactérie
   $bdd = connect();
   $query = $bdd->prepare('SELECT id_milieu, nature_milieu FROM bcp__milieu JOIN bcp__pousse USING(id_milieu) WHERE id_bacterie= :idBac');
   $query->execute([
      'idBac' => $idBac
   ]);
   return ($query->fetchAll(PDO::FETCH_ASSOC));
}

function maladiePourUneBacterie($idBac):array {
   // récupère les maladies que peut provoquer la bactérie
   $bdd = connect();
   $query = $bdd->prepare('SELECT nom_maladie FROM bcp__provoquemaladie WHERE id_bacterie = :idBac;');
   $query->execute([
      'idBac' => $idBac
   ]);
   return ($query->fetchAll(PDO::FETCH_ASSOC));
}


function symptomePourUneBacterie($idBac):array {
   // récupère les symptômes que peut provoquer la bactérie
   $bdd = connect();
   $query = $bdd->prepare('SELECT nom_symptome FROM bcp__provoquesymptome WHERE id_bacterie = :idBac;');
   $query->execute([
      'idBac' => $idBac
   ]);
   return ($query->fetchAll(PDO::FETCH_ASSOC));
}

function zoneCorpsPourUneBacterie($idBac):array {
   // récupère les zones corps qui peuvent être atteint pas la bactérie
   $bdd = connect();
   $query = $bdd->prepare('SELECT nom_zoneCorps FROM bcp__atteint WHERE id_bacterie = :idBac;');
   $query->execute([
      'idBac' => $idBac
   ]);
   return ($query->fetchAll(PDO::FETCH_ASSOC));
}