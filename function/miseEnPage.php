<?php
// permet de changer le format de la date sotcke en bdd en format français
function enDate($date):string{
   return (date('d/m/Y', strtotime($date)));
}

function enDateHeure($dateHeure):string{
   // permet de changer le format de la date sotcke en bdd en format français avec heure
   return (date('d/m/Y G:i', strtotime($dateHeure)));
}


function message($message, $type):string{
// Fonction pour afficher un message d'erreur ou de success
   return <<<HTML
    <div style="width: 100%; display: flex; justify-content: center;">
        <p class="$type"> $message </p>
    </div>
HTML;

}