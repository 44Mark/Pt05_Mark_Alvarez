<?php
// Model per fer totes les funcions relacionades amb els llibres
require __DIR__ . '/../Model/connexio.php';

// Funció per fer un select de tots els articles al menu per a qualsevol usuari
function obtenirArticles() {
    global $connexio;

    $stmt = $connexio->prepare("SELECT * FROM taula_articles");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Funció per fer un select del articles que ha creat l'usuari pel seu correu
function obtenirArticlesUsuari($correuUsuari) {
    global $connexio;

    // Obtenir els articles pel correu de l'usuari
    $stmt = $connexio->prepare("SELECT * FROM taula_articles WHERE correu_usuari = :correuUsuari");
    $stmt->bindParam(':correuUsuari', $correuUsuari);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Funció per fer un insert de llibres per l'id de l'usuari
function insertLlibre($isbn, $titol, $cos, $correuUsuari) {
    global $connexio;

    $stmt = $connexio->prepare("INSERT INTO taula_articles (isbn, titol, cos, correu_usuari) VALUES (:isbn, :titol, :cos, :correuUsuari)");
    $stmt->bindParam(':isbn', $isbn);
    $stmt->bindParam(':titol', $titol);
    $stmt->bindParam(':cos', $cos);
    $stmt->bindParam(':correuUsuari', $correuUsuari);
    $stmt->execute();
}

// Funció per eliminar el llibre per l'isbn
function eliminarLlibre($isbn) {
    global $connexio;

    $stmt = $connexio->prepare("DELETE FROM taula_articles WHERE isbn = :isbn");
    $stmt->bindParam(':isbn', $isbn);
    $stmt->execute();
}

// Funció per comprovar si ja hi ha un llibre amb aquest isbn
function comprovarLlibre($isbn) {
    global $connexio;

    $stmt = $connexio->prepare("SELECT * FROM taula_articles WHERE isbn = :isbn");
    $stmt->bindParam(':isbn', $isbn);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Funció per obtenir un llibre per l'isbn
function obtenirLlibre($isbn) {
    global $connexio;

    $stmt = $connexio->prepare("SELECT * FROM taula_articles WHERE isbn = :isbn");
    $stmt->bindParam(':isbn', $isbn);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Funció per actualitzar un llibre
function actualitzarLlibre($isbn, $titol, $cos) {
    global $connexio;

    $stmt = $connexio->prepare("UPDATE taula_articles SET titol = :titol, cos = :cos WHERE isbn = :isbn");
    $stmt->bindParam(':isbn', $isbn);
    $stmt->bindParam(':titol', $titol);
    $stmt->bindParam(':cos', $cos);
    $stmt->execute();
}

// Funció per obtenir els llibres ordenats ascendentment
function obtenirArticlesAsc($correu = null) {
    global $connexio;
    
    if ($correu) {
        $stmt = $connexio->prepare("SELECT * FROM taula_articles WHERE correu_usuari = :correu ORDER BY titol ASC");
        $stmt->bindParam(':correu', $correu);
    } else {
        $stmt = $connexio->prepare("SELECT * FROM taula_articles ORDER BY titol ASC");
    }
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Funció per obtenir els llibres ordenats descendentment
function obtenirArticlesDesc($correu = null) {
    global $connexio;
    
    if ($correu) {
        $stmt = $connexio->prepare("SELECT * FROM taula_articles WHERE correu_usuari = :correu ORDER BY titol DESC");
        $stmt->bindParam(':correu', $correu);
    } else {
        $stmt = $connexio->prepare("SELECT * FROM taula_articles ORDER BY titol DESC");
    }
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?> 