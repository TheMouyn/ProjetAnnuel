<?php
session_start();
?>
<nav class="menu">
    <a href="../page/accueil.php" style="display: block; margin: 0;padding: 0;width: 100%;">
        <img src="../style/img/logo.svg" alt="logo du site" style="width: 100%;">
    </a>
   <?php
   // si connecté
   if (isset($_SESSION['idUser'])) :
      // si est admin
      if ($_SESSION['estAdmin'] == 1) :
         ?>

         <?php
         if ($_SESSION['photo'] !== null) {
            $lienPhoto = '../' . $_SESSION['photo'];
            echo "<img class=\"photoProfil\" src=\"$lienPhoto\" alt='photo utilisateur'>";
         } else{
            echo "<p style='text-align: center; width: 100%; font-weight: bold;'>{$_SESSION['prenom']} {$_SESSION['nom']}</p>";
         }
         ?>

          <a href="../page/accueil.php" class="button one">
              <img src="../style/img/house.svg" alt="">
              <div class="textelien">Page d'accueil</div>
          </a>
          <a href="../page/searchSimple.php" class="button one">
              <img src="../style/img/search.svg" alt="">
              <div class="textelien">Faire une recherche</div>
          </a>
          <a href="#" class="button one">
              <img src="../style/img/account.svg" alt="">
              <div class="textelien">Mon compte</div>
          </a>
          <a href="../page/favoris.php" class="button one">
              <img src="../style/img/favoris.svg" alt="">
              <div class="textelien">Mes favoris</div>
          </a>
          <a href="#" class="button one">
              <img src="../style/img/database.svg" alt="">
              <div class="textelien">Gérer les données</div>
          </a>
          <a href="#" class="button one">
              <img src="../style/img/setting.svg" alt="">
              <div class="textelien">Paramètres</div>
          </a>
          <a href="../page/disconect.php" class="button one">
              <img src="../style/img/logout.svg" alt="">
              <div class="textelien">Déconnexion</div>
          </a>

      <?php
         // si est admin
      endif;
      ?>

      <?php
      // si on est connecté en tant qu'utilisateur mais pas admin
      if ($_SESSION['estAdmin'] == 0):
         ?>
         <?php
         if ($_SESSION['photo'] !== null) {
            $lienPhoto = '../' . $_SESSION['photo'];
            echo "<img class=\"photoProfil\" src=\"$lienPhoto\" alt='photo utilisateur'>";
         } else{
            echo "<p style='text-align: center; width: 100%; font-weight: bold;'>{$_SESSION['prenom']} {$_SESSION['nom']}</p>";
         }
         ?>
          <a href="../page/accueil.php" class="button one">
              <img src="../style/img/house.svg" alt="">
              <div class="textelien">Page d'accueil</div>
          </a>
          <a href="../page/searchSimple.php" class="button one">
              <img src="../style/img/search.svg" alt="">
              <div class="textelien">Faire une recherche</div>
          </a>
          <a href="#" class="button one">
              <img src="../style/img/account.svg" alt="">
              <div class="textelien">Mon compte</div>
          </a>
          <a href="../page/favoris.php" class="button one">
              <img src="../style/img/favoris.svg" alt="">
              <div class="textelien">Mes favoris</div>
          </a>
          <a href="../page/disconect.php" class="button one">
              <img src="../style/img/logout.svg" alt="">
              <div class="textelien">Déconnexion</div>
          </a>

      <?php
         // si on est connecté en tant qu'utilisateur mais pas admin
      endif;
      ?>


   <?php
   // si on n'est pas connecté
   else:
      ?>
       <a href="../page/accueil.php" class="button one">
           <img src="../style/img/house.svg" alt="">
           <div class="textelien">Page d'accueil</div>
       </a>
       <a href="../page/searchSimple.php" class="button one">
           <img src="../style/img/search.svg" alt="">
           <div class="textelien">Faire une recherche</div>
       </a>
       <a href="../page/login.php" class="button one">
           <img src="../style/img/login.svg" alt="">
           <div class="textelien">Connexion</div>
       </a>


   <?php
      // si on n'est pas connecté
   endif;
   ?>

</nav>

<?php
session_write_close();
?>
