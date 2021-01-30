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

function articleDESC():array {
   $bdd = connect();
   $query = $bdd->prepare('SELECT * FROM bcp__article ORDER BY datePublication_article DESC');
   $query->execute();
   return ($query->fetchAll(PDO::FETCH_ASSOC));
}

