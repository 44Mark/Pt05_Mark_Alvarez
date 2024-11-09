<?php

require(__DIR__ . '/../Model/connexio.php');

// Funció per verificar si el correu ja existeix a la BD
function correuExisteix($correu) {
    global $connexio;
    
    $sql = "SELECT COUNT(*) FROM usuaris WHERE correu = :correu";
    $stmt = $connexio->prepare($sql);
    $stmt->bindParam(':correu', $correu);
    $stmt->execute();
    
    return $stmt->fetchColumn() > 0;
    var_dump($stmt->fetchColumn());
}

// Funció per obtenir el correu de l'usuari
function obtenirUsuari($correu) {
    global $connexio;
    
    $sql = "SELECT * FROM usuaris WHERE correu = :correu";
    $stmt = $connexio->prepare($sql);
    $stmt->bindParam(':correu', $correu);
    $stmt->execute();
    
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Funció per afegir un nou usuari a la base de dades
function afegirUsuari($nom, $correu, $contrasenya_hashed) {
    global $connexio;

    $sql = "INSERT INTO usuaris (nom, correu, contrasenya) VALUES (:nom, :correu, :contrasenya)";
    $stmt = $connexio->prepare($sql);
    
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':correu', $correu);
    $stmt->bindParam(':contrasenya', $contrasenya_hashed);
   
    $stmt->execute();
}

// Funció per actualitzar la contrasenya d'un usuari a la base de dades
function actualitzarContrasenya($correu, $nova_hashed) {
    global $connexio;

    $sql = "UPDATE usuaris SET contrasenya = :nova_contrasenya WHERE correu = :correu";
    $stmt = $connexio->prepare($sql);
    
    $stmt->bindParam(':nova_contrasenya', $nova_hashed);
    $stmt->bindParam(':correu', $correu);

    return $stmt->execute();
}

// Funció per actualitzar el nom d'un usuari a la base de dades
function actualitzarNomUsuari($correu, $nouNom) {
    global $connexio;

    $sql = "UPDATE usuaris SET nom = :nou_nom WHERE correu = :correu";
    $stmt = $connexio->prepare($sql);
    
    $stmt->bindParam(':nou_nom', $nouNom);
    $stmt->bindParam(':correu', $correu);

    return $stmt->execute();
}

// Funció per actualitzar la foto d'un usuari a la base de dades
function actualitzarFotoUsuari($correu, $rutaFoto) {
    global $connexio;

    $sql = "UPDATE usuaris SET foto = :ruta_foto WHERE correu = :correu";
    $stmt = $connexio->prepare($sql);
    
    $stmt->bindParam(':ruta_foto', $rutaFoto);
    $stmt->bindParam(':correu', $correu);

    return $stmt->execute();
}
?>