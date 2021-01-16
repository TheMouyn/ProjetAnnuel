<?php
$to = 'monillon@outlook.fr';
$objet = 'Ceci est un test';
$message = 'Ceci est un super message de folie pour tester les mail et voir si cela fonctionne correctement';


mail($to, $objet, $message);

