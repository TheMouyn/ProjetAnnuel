<!-- Groupe N°032 -  Orlane GUILLET, Maxime ONILLON, Aline REBOUT, Achil MICHEL-->
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

function maladies():array {
    // renvoi toute la liste toutes les maladies stockées en bdd
    $bdd = connect();
    $query = $bdd->prepare('SELECT * FROM bcp__maladie');
    $query->execute();
    return ($query->fetchAll(PDO::FETCH_COLUMN));
}

function listeBacterie():array {
    // renvoi toute la liste toutes les bactéries stockées en bdd
    $bdd = connect();
    $query = $bdd->prepare('SELECT * FROM bcp__bacterie');
    $query->execute();
    return ($query->fetchAll(PDO::FETCH_ASSOC));
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

function resistancePourUneBacterie($idBac):array {
   // récupère les résistances de bactérie si il y en a
   $bdd = connect();
   $query = $bdd->prepare('SELECT nom_antibiotique FROM bcp__resistance WHERE id_bacterie = :idBac;');
   $query->execute([
      'idBac' => $idBac
   ]);
   return ($query->fetchAll(PDO::FETCH_ASSOC));
}

function articlePourUneBacterie($idBac):array {
   // récupère les articles où la bactérie est citée
   $bdd = connect();
   $query = $bdd->prepare('SELECT * FROM bcp__article WHERE id_bacterie = :idBac ORDER BY datePublication_article DESC;');
   $query->execute([
      'idBac' => $idBac
   ]);
   return ($query->fetchAll(PDO::FETCH_ASSOC));
}


function unMilieu($id):array {
   // donne les informations d'un milieu grace à son id
   $bdd = connect();
   $query = $bdd->prepare('SELECT * FROM bcp__milieu WHERE id_milieu = :id');
   $query->execute([
      'id' => $id
   ]);
   return ($query->fetchAll(PDO::FETCH_ASSOC));

}

function bacteriePourUnMilieu($idMilieu):array {
   // récupère les milieux où pousse la bactérie
   $bdd = connect();
   $query = $bdd->prepare('SELECT id_bacterie, genre_bacterie, espece_bacterie, serovar_bacterie, visible_bacterie FROM bcp__bacterie JOIN bcp__pousse USING(id_bacterie) WHERE id_milieu= :idMilieu;');
   $query->execute([
      'idMilieu' => $idMilieu
   ]);
   return ($query->fetchAll(PDO::FETCH_ASSOC));
}

function userExiste($mailUser){
   // mail existe dans la bdd : revois null ou le tableau avec les informations
   $bdd = connect();
   $query = $bdd->prepare('SELECT * FROM bcp__user WHERE email_user = :mailUser LIMIT 1;');
   $query->execute([
      'mailUser' => $mailUser
   ]);
   $resultat = $query->fetchAll(PDO::FETCH_ASSOC);

   if (!empty($resultat[0])){
      return $resultat;
   } else {
      return null;
   }


}

function userIdExiste($idUser){
    // id existe dans la bdd : revois null ou le tableau avec les informations
    $bdd = connect();
    $query = $bdd->prepare('SELECT * FROM bcp__user WHERE id_user = :idUser LIMIT 1;');
    $query->execute([
        'idUser' => $idUser
    ]);
    $resultat = $query->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($resultat[0])){
        return $resultat;
    } else {
        return null;
    }
}

function favorisUser($idUser):array {
   // récupère les favoris d'un utilisateur qui sont visibles
   $bdd = connect();
   $query = $bdd->prepare('SELECT id_bacterie, genre_bacterie, espece_bacterie, serovar_bacterie, LienInterneImage_bacterie, visible_bacterie FROM bcp__bacterie JOIN bcp__favoris USING(id_bacterie) WHERE id_user = :idUser AND visible_bacterie=1 ORDER BY genre_bacterie ASC;;');
   $query->execute([
      'idUser' => $idUser
   ]);
   return ($query->fetchAll(PDO::FETCH_ASSOC));
}

function typesEtude():array {
   // renvoi tous les types d'étude de la base de donnée
   $bdd=connect();
   $query = $bdd->prepare('SELECT * FROM bcp__typeetude');
   $query->execute();

   return ($query->fetchAll(PDO::FETCH_COLUMN));

}

function supprFavoris($idUser, $idBac){
    // permet de supprimer un favoris grâce à un id bactérie et un id user
    $bdd = connect();
    $query = $bdd->prepare('DELETE FROM bcp__favoris WHERE id_user = :idUser AND id_bacterie = :idBac;');
    $query->execute([
        'idUser' => $idUser,
        'idBac' => $idBac
    ]);
}

function estFavoris($idUser, $idBac){
    // permet savoir si une bactérie est dans les favoris d'un utilisateur
    $bdd = connect();
    $query = $bdd->prepare('SELECT * FROM bcp__favoris WHERE id_user = :idUser AND id_bacterie = :idBac;');
    $query->execute([
        'idUser' => $idUser,
        'idBac' => $idBac
    ]);

    if(empty($query->fetchAll())){
        return false;
    } else {
        return true;
    }
}

function addFavoris($idUser, $idBac){
    // permet d'ajouter un favoris grâce à un id bactérie et un id user
    $bdd = connect();
    $query = $bdd->prepare('INSERT INTO bcp__favoris(id_bacterie, id_user) VALUES (:idBac, :idUser);');
    $query->execute([
        'idUser' => $idUser,
        'idBac' => $idBac
    ]);
}

function aSavoirUser($idUser):array {
    // récupère les a savoir d'un utilisateur qui sont visibles
    $bdd = connect();
    $query = $bdd->prepare('SELECT id_bacterie, genre_bacterie, espece_bacterie, serovar_bacterie, LienInterneImage_bacterie, visible_bacterie, connu_aSavoir FROM bcp__bacterie JOIN bcp__asavoir USING(id_bacterie) WHERE id_user = :idUser AND visible_bacterie=1 ORDER BY genre_bacterie ASC;;');
    $query->execute([
        'idUser' => $idUser
    ]);
    return ($query->fetchAll(PDO::FETCH_ASSOC));
}

function addASavoir($idUser, $idBac){
    // permet de supprimer une bactérie à savoir  grâce à un id bactérie et un id user
    $bdd = connect();
    $query = $bdd->prepare('INSERT INTO bcp__asavoir(id_bacterie, id_user, connu_aSavoir) VALUES (:idBac, :idUser, 0);');
    $query->execute([
        'idUser' => $idUser,
        'idBac' => $idBac
    ]);
}


function supprASavoir($idUser, $idBac){
    // permet de supprimer une bactérie à savoir  grâce à un id bactérie et un id user
    $bdd = connect();
    $query = $bdd->prepare('DELETE FROM bcp__asavoir WHERE id_user = :idUser AND id_bacterie = :idBac LIMIT 1;');
    $query->execute([
        'idUser' => $idUser,
        'idBac' => $idBac
    ]);
}

function switchASavoir($idUser, $idBac){
    // permet de modifier l'état connu d'une bactérie à savoir grâce à un id bactérie et un id user
    $bdd = connect();
    $query = $bdd->prepare('UPDATE bcp__asavoir SET connu_aSavoir = !connu_aSavoir WHERE id_user = :idUser AND id_bacterie = :idBac LIMIT 1;');
    $query->execute([
        'idUser' => $idUser,
        'idBac' => $idBac
    ]);
}


function estASavoir($idUser, $idBac){
    // permet savoir si une bactérie est dans les a savoir d'un utilisateur return 0 si pas dans la table 1 si oui mais connu = 0 et 2 si oui et connu = 1
    $bdd = connect();
    $query = $bdd->prepare('SELECT * FROM bcp__asavoir WHERE id_user = :idUser AND id_bacterie = :idBac;');
    $query->execute([
        'idUser' => $idUser,
        'idBac' => $idBac
    ]);

    $reponse = $query->fetchAll();

    if(empty($reponse)){
        return 0;
    } elseif ($reponse[0]['connu_aSavoir'] == 0) {
        return 1;
    } elseif ($reponse[0]['connu_aSavoir'] == 1){
        return 2;
    }
}

function ajoutJustifBDD($mailUser, $lien){
    // permet d'ajouter le lien vers un justificatif
    $bdd = connect();
    $query = $bdd->prepare('UPDATE bcp__user SET lienInterneJustificatif_user = :lien, justificatifValide_user = 0 WHERE email_user = :mailUser;');
    $query->execute([
        'lien' => $lien,
        'mailUser' => $mailUser
    ]);
}

function openNewTab($lien){
    return <<<HTML
    <script type="text/javascript">
        window.open('$lien', '_blank');
    </script>
HTML;
}

function switchValideMail($idUser){
    // permet de modifier l'état de mail validé d'un utilisateur
    $bdd = connect();
    $query = $bdd->prepare('UPDATE bcp__user SET emailValide_user = 1 WHERE id_user = :idUser;');
    $query->execute([
        'idUser' => $idUser,
    ]);

}

function updatePassword($password, $idUser){
    // permet de modifier le mot de passe de l'utilisateur avec son id
    $bdd = connect();
    $query = $bdd->prepare('UPDATE bcp__user SET password_user = :mdp WHERE id_user = :idUser LIMIT 1;');
    $query->execute([
        'idUser' => $idUser,
        'mdp' => $password
    ]);

}


function ajoutConsultation($idBac){
    // permet d'ajouter un au nombre de fois où la bactérie est consultée
    $bdd = connect();
    $query = $bdd->prepare('UPDATE bcp__bacterie SET nbConsultation_bacterie = nbConsultation_bacterie+1 WHERE id_bacterie = :idBac;');
    $query->execute([
        'idBac' => $idBac
    ]);

}

function ajoutRecherche($idBac){
    // permet d'ajouter un au nombre de fois où la bactérie est recherchée
    $bdd = connect();
    $query = $bdd->prepare('UPDATE bcp__bacterie SET nbRecherche_bacterie = nbRecherche_bacterie+1 WHERE id_bacterie = :idBac;');
    $query->execute([
        'idBac' => $idBac
    ]);

}


function rechercheUnMotBacterie($recherche){
    // permet de rechercher dans la BDD et dans les deux tables (genre et espèce)
    $bdd = connect();
    $reponse = [];
    $queryGenre = $bdd->prepare('SELECT * FROM bcp__bacterie WHERE genre_bacterie LIKE :nomGenre;');
    $queryGenre->execute([
        'nomGenre' => '%' . $recherche . '%'
    ]);
    $reponseGenre = $queryGenre->fetchAll(PDO::FETCH_ASSOC);
    if (!empty($reponseGenre)){
        $reponse[] = $reponseGenre;
    }

    $queryEspece = $bdd->prepare('SELECT * FROM bcp__bacterie WHERE espece_bacterie LIKE :nomEspece;');
    $queryEspece->execute([
        'nomEspece' => '%' . $recherche . '%'
    ]);
    $reponseEspece = $queryEspece->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($reponseEspece)){
        $reponse[] = $reponseEspece;
    }

    return $reponse;

}


function rechercheDeuxMotsBacterie($genre, $espece){
    // permet de rechercher dans la BDD et dans les deux tables (genre et espèce) avec les deux mots
    $bdd = connect();
    $query = $bdd->prepare('SELECT * FROM bcp__bacterie WHERE genre_bacterie LIKE :nomGenre AND espece_bacterie LIKE :nomEspece;');
    $query->execute([
        'nomGenre' => '%' . $genre . '%',
        'nomEspece' => '%' . $espece . '%'
    ]);
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function ficheTechniqueMilieu($idMilieu){
    // Permet de récupérer les fiches techniques cité dans un milieu
    $bdd = connect();
    $query = $bdd->prepare('SELECT * FROM bcp__fichetechnique JOIN bcp__estmensione USING(id_ficheTechnique) WHERE id_milieu = :idMilieu;');
    $query->execute([
        'idMilieu' => $idMilieu,
    ]);
    return $query->fetchAll(PDO::FETCH_ASSOC);

}

function ajoutphotoProfilBDD($idUser, $lien){
    // permet d'ajouter le lien vers une photo
    $bdd = connect();
    $query = $bdd->prepare('UPDATE bcp__user SET lienInternePhoto_user = :lien WHERE id_user = :id;');
    $query->execute([
        'lien' => $lien,
        'id' => $idUser
    ]);
}

function ajoutphotoBacterieBDD($idBac, $lien){
    // permet d'ajouter le lien vers une photo pour une bactérie
    $bdd = connect();
    $query = $bdd->prepare('UPDATE bcp__bacterie SET LienInterneImage_bacterie = :lien WHERE id_bacterie = :id;');
    $query->execute([
        'lien' => $lien,
        'id' => $idBac
    ]);
}

function justificatifNonValide(){
    // return la liste des justificatif non validé pour les comptes admin
    $bdd = connect();
    $query = $bdd->prepare('SELECT * FROM bcp__user WHERE justificatifValide_user = 0');
    $query->execute();
    return $query->fetchAll();
}

function gardeListeMatch($recherche, $elementAConserver){
    //permet de recherche dans le tableau recherche et de conserver uniquement les element à conserver
    $temp = [];
    foreach ($recherche as $ligne){
        if (in_array($ligne, $elementAConserver)){
            $temp[] = $ligne;
        }
    }
    return $temp;
}

function ajoutNbModif($idUser){
    // Ajout un au nombre de modification de l'utilisateur
    $bdd = connect();
    $query = $bdd->prepare('UPDATE bcp__user SET NbModification_user = NbModification_user+1 WHERE id_user = :idUser;');
    $query->execute([
        'idUser' => $idUser
    ]);
}

function milieux(){
    // Renvois les id et nom de tous les milieux
    $bdd = connect();
    $query = $bdd->prepare('SELECT id_milieu, nature_milieu FROM bcp__milieu');
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function ficheTechnique(){
    // Renvois les informations de toutes les fiches techniques
    $bdd = connect();
    $query = $bdd->prepare('SELECT * FROM bcp__fichetechnique');
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function suprBac($idBac){
    // Supprime la bactérie de toutes les tables de la bdd
    // table pousse
    $bdd = connect();
    $suprPousse = $bdd->prepare('DELETE FROM bcp__pousse WHERE id_bacterie = :id');
    $suprPousse->execute([
        'id' => $idBac
    ]);

    // Table resistance
    $suprResistance = $bdd->prepare('DELETE FROM bcp__resistance WHERE id_bacterie = :id');
    $suprResistance->execute([
        'id' => $idBac
    ]);

    // Table provoque Symptome
    $suprSymptome = $bdd->prepare('DELETE FROM bcp__provoquesymptome WHERE id_bacterie = :id');
    $suprSymptome->execute([
        'id' => $idBac
    ]);

    // Table provoque maladie
    $suprMaladie = $bdd->prepare('DELETE FROM bcp__provoquemaladie WHERE id_bacterie = :id');
    $suprMaladie->execute([
        'id' => $idBac
    ]);

    // Table atteint zone corps
    $suprAtteintZoneCorps = $bdd->prepare('DELETE FROM bcp__atteint WHERE id_bacterie = :id');
    $suprAtteintZoneCorps->execute([
        'id' => $idBac
    ]);

    // Table bactérie à savoir
    $suprASavoir = $bdd->prepare('DELETE FROM bcp__asavoir WHERE id_bacterie = :id');
    $suprASavoir->execute([
        'id' => $idBac
    ]);

    // Table favoris
    $suprFavoris = $bdd->prepare('DELETE FROM bcp__favoris WHERE id_bacterie = :id');
    $suprFavoris->execute([
        'id' => $idBac
    ]);

    // Table article
    $suprArticle = $bdd->prepare('DELETE FROM bcp__article WHERE id_bacterie = :id');
    $suprArticle->execute([
        'id' => $idBac
    ]);


    $suprBac = $bdd->prepare('DELETE FROM bcp__bacterie WHERE id_bacterie = :id');
    $suprBac->execute([
        'id' => $idBac
    ]);
}
