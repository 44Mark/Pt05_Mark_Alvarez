<?php
// Controlador dedicat a gestionar l apaginació de la llista de llibres per GET i tambe el filtre de la cerca
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once('./Model/llibres.php');

// Verificar si $articles ya está definido
if (!isset($articles)) {
    // Obtener los artículos según el usuario autenticado o no
    if (isset($_SESSION['correu'])) {
        $articles = obtenirArticlesUsuari($_SESSION['correu']);
    } else {
        $articles = obtenirArticles();
    }
}

// Filtrar els articles pel valor de cerca per GET
if (isset($_GET['search'])) {
    $searchTerm = htmlspecialchars($_GET['search']);
    $articles = array_filter($articles, function($art) use ($searchTerm) {
        return stripos($art['titol'], $searchTerm) !== false;
    });
}

// Establir el nombre d'articles per pàgina
$articlesPerPage = isset($_SESSION['num_escollit']) ? (int)$_SESSION['num_escollit'] : 6;

// Página per defecto la 1
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Calcular l'offset (desplaçament per obtenir els articles a mostrar)
$offset = ($page - 1) * $articlesPerPage;

// Obtenir el total d'articles
$totalArticles = (empty($articles)) ? 1 : count($articles);

// Calcular el numero total de pagines
$totalPages = ceil($totalArticles / $articlesPerPage);

// Verificar si la pagina solicitada es mes gran que el total de pagines
if ($page > $totalPages) {
    // Redirigir a la primera página
    header("Location: /inici?page=1" . (isset($searchTerm) ? "&search=" . urlencode($searchTerm) : ""));
    exit();
}

// Obtenim els articles a mostrar
$articlesToShow = array_slice($articles, $offset, $articlesPerPage);
?>