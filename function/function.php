<?php
require_once 'connect.php';

function formesBacterie():array {
   $bdd=connect();
   $query = $bdd->prepare('SELECT * FROM bcp__forme');
   $query->execute();

   return ($query->fetchAll(PDO::FETCH_COLUMN));
}

function antibiotiquesBacterie():array {
   $bdd = connect();
   $query = $bdd->prepare('SELECT * FROM bcp__antibiotique');
   $query->execute();
   return ($query->fetchAll(PDO::FETCH_COLUMN));
}

function milieuxBacterie():array {
   $bdd = connect();
   $query = $bdd->prepare('SELECT nature_milieu FROM bcp__milieu');
   $query->execute();
   return ($query->fetchAll(PDO::FETCH_COLUMN));
}

function zonesCorps():array {
   $bdd = connect();
   $query = $bdd->prepare('SELECT nom_zoneCorps FROM bcp__zonecorps');
   $query->execute();
   return ($query->fetchAll(PDO::FETCH_COLUMN));
}

function symptomes():array {
   $bdd = connect();
   $query = $bdd->prepare('SELECT nom_symptome FROM bcp__symptome');
   $query->execute();
   return ($query->fetchAll(PDO::FETCH_COLUMN));
}

function articleDESC10():array {
   $bdd = connect();
   $query = $bdd->prepare('SELECT * FROM bcp__article ORDER BY datePublication_article DESC LIMIT 10');
   $query->execute();
   return ($query->fetchAll(PDO::FETCH_ASSOC));
}
function articleDESCall():array {
   $bdd = connect();
   $query = $bdd->prepare('SELECT * FROM bcp__article ORDER BY datePublication_article DESC');
   $query->execute();
   return ($query->fetchAll(PDO::FETCH_ASSOC));
}

function nbArtcile():int {
   $bdd = connect();
   $query = $bdd->prepare('SELECT COUNT(*) FROM bcp__article');
   $query->execute();
   $result = $query->fetchAll(PDO::FETCH_COLUMN);
   return ($result[0]);
}


function uneBacterie($id):array {
   $bdd = connect();
   $query = $bdd->prepare('SELECT * FROM bcp__bacterie WHERE id_bacterie = :id');
   $query->execute([
      'id' => $id
   ]);
   return ($query->fetchAll(PDO::FETCH_ASSOC));

}

function milieuPourUneBacterie($idBac):array {
   // récupère le milieu où pousse la bactérie
   $bdd = connect();
   $query = $bdd->prepare('SELECT id_milieu, nature_milieu FROM bcp__milieu JOIN bcp__pousse USING(id_milieu) WHERE id_bacterie= :idBac');
   $query->execute([
      'idBac' => $idBac
   ]);
   return ($query->fetchAll(PDO::FETCH_ASSOC));
}