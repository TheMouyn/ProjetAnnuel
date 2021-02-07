<?php
// permet de changer le format de la date sotcke en bdd en format français
function enDate($date):string{
   return (date('d/m/Y', strtotime($date)));
}

// Fonction pour afficher un message d'erreur ou de success
function message($message, $type):string{
   return <<<HTML
    <div style="width: 100%; display: flex; justify-content: center;">
        <p class="$type"> $message </p>
    </div>
HTML;

}