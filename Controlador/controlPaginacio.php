<?php
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

// Filtrar artículos por título si se ha enviado una búsqueda
if (isset($_GET['search'])) {
    $searchTerm = htmlspecialchars($_GET['search']);
    $articles = array_filter($articles, function($art) use ($searchTerm) {
        return stripos($art['titol'], $searchTerm) !== false;
    });
}

// Establecer el número de artículos por página desde la sesión o usar un valor por defecto
$articlesPerPage = isset($_SESSION['num_escollit']) ? (int)$_SESSION['num_escollit'] : 6;

// Página por defecto la 1
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Calcular el offset (Operación para saber a partir de qué artículo mostrar)
$offset = ($page - 1) * $articlesPerPage;

// Obtener el total de artículos
$totalArticles = (empty($articles)) ? 1 : count($articles);

// Calcular el número total de páginas
$totalPages = ceil($totalArticles / $articlesPerPage);

// Verificar si la página solicitada es mayor que el número total de páginas
if ($page > $totalPages) {
    // Redirigir a la primera página
    header("Location: /inici?page=1" . (isset($searchTerm) ? "&search=" . urlencode($searchTerm) : ""));
    exit();
}

// Obtener los artículos a mostrar
$articlesToShow = array_slice($articles, $offset, $articlesPerPage);
?>