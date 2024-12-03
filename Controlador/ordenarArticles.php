<?php
// Controlador per ordenar els articles guardant el valor en una Session per a que es mantingui en les següents pàgines
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once('./Model/llibres.php');

// Si no hi ha cap ordre guardat, es guarda com a ascendent
if (!isset($_SESSION['orden'])) {
    $_SESSION['orden'] = 'asc';
}

$correu = isset($_SESSION['correu']) ? $_SESSION['correu'] : null;

// Si li dona a A-Z la sessió serà ascendent, si li dona a Z-A serà descendent
if ($_SESSION['orden'] == 'asc') {
    $articles = obtenirArticlesAsc($correu);
} else {
    $articles = obtenirArticlesDesc($correu);
}
    
require_once('./Controlador/controlPaginacio.php');
?>