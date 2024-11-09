<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['correu'])) {
    $articles = obtenirArticlesUsuari($_SESSION['correu']);
} else {
    $articles = obtenirArticles();
}

// 7 articles per pagina
$articlesPerPage = 4;

// Pàgina per defecte la 1
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Calcular el offset (Operació per saber a aprtir de quin article mostrar)
$offset = ($page - 1) * $articlesPerPage;

// Obtenir el total d'articles
$totalArticles = $totalArticles = (empty($articles)) ?  1 : count($articles);

// Calcular el número total de páginas
$totalPages = ceil($totalArticles / $articlesPerPage);

// Verificar si la página solicitada es mayor que el número total de páginas
if ($page > $totalPages) {
    // Redirigir a la primera página
    header("Location: ./index.php?page=1");
    exit();
}

// Obtenir els articles a mostrar
$articlesToShow = array_slice($articles, $offset, $articlesPerPage);
?>