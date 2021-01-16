<?php
function connect(){

   $sql_hostname="localhost"; //Nom de l'hote
   $sql_dbname="bactepedia"; //Nom de la base de données a laquelle vous souhaitez vous connecter
   $sql_user="root"; //Nom de l'utilisateur pour se connecter a la base de données
   $sql_mdp=""; //Mot de passe de l'utilisateur

   return new PDO("mysql:host=$sql_hostname;dbname=$sql_dbname;charset=utf8", "$sql_user", "$sql_mdp");

}


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

