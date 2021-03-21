<!-- Groupe N°032 -  Orlane GUILLET, Maxime ONILLON, Aline REBOUT, Achil MICHEL-->
<?php
function connect(){

$sql_hostname="localhost"; //Nom de l'hote
$sql_dbname="bactepedia"; //Nom de la base de données a laquelle vous souhaitez vous connecter
$sql_user="root"; //Nom de l'utilisateur pour se connecter a la base de données
$sql_mdp=""; //Mot de passe de l'utilisateur

return new PDO("mysql:host=$sql_hostname;dbname=$sql_dbname;charset=utf8", "$sql_user", "$sql_mdp");

}