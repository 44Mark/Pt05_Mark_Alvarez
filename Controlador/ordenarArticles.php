<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once('./Model/llibres.php');

// Establecer el orden por defecto si no está definido
if (!isset($_SESSION['orden'])) {
    $_SESSION['orden'] = 'asc';
}

// Obtener los artículos según el usuario autenticado o no
$correu = isset($_SESSION['correu']) ? $_SESSION['correu'] : null;

if ($_SESSION['orden'] == 'asc') {
    $articles = obtenirArticlesAsc($correu);
} else {
    $articles = obtenirArticlesDesc($correu);
}
    

require_once('./Controlador/controlPaginacio.php');
?>